<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Discount;
use Illuminate\Http\Request;
use App\Models\Main_Category;
use App\Models\Newsletter;
use App\Models\Order;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\OrderItem;
use App\Models\Product_Discount;
use App\Models\ProductReview;

class FrontendController extends Controller
{
    public function index(){

        $subcategories = SubCategory::with(['products' => function($query){
            $query->where('status', 1)->where('quantity', '>', 0)->latest()->take(1);}])->get();

        $bestSellingProducts = OrderItem::select('product_id', DB::raw('SUM(quantity) as total_sold'))
        ->with('product')->groupBy('product_id')
        ->orderByDesc('total_sold')->limit(10)->get();
        
        $topSellingWidgets = $bestSellingProducts->slice(0, 9);
        $bestSellingProducts1 = $bestSellingProducts;

        $discount = Product_Discount::pluck('discount')->first();
        return view('frontend.index' , compact('subcategories' , 'bestSellingProducts1' ,'topSellingWidgets' ,'discount'));
    }
    public function cart(){

        $products = Cart::ForCurrentUser()->paginate(10);
        return view('frontend.cart' , compact('products'));
    }

    public function checkout(){

        $products = Cart::ForCurrentUser()->get();
        return view('frontend.checkout' , compact('products'));
    }

    public function product($product_id){

        $product = Product::with(['subcategory', 'category'])->find($product_id);

        $subcategories = SubCategory::with(['products' => function($query){
        $query->Available()->latest()->take(4);}])->get();
        
        $Related_Products = Product::Available()->latest()->take(4)->get();
        
        $reviews = ProductReview::where('product_id' , $product_id)->paginate(3);  
        $average = ProductReview::where('product_id' , $product_id)->avg('rating');

        return view('frontend.product', compact('product' , 'reviews' , 'average' , 'subcategories' ,'Related_Products'));
    }

    public function store(Request $request){

        $query = Product::query();
        if ($request->filled('subcategories')) {
            $query->whereIn('subcategory_id', $request->subcategories); 
        }
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price); 
        } 
        if ($request->filled('max_price')) 
            { $query->where('price', '<=', $request->max_price); 
        }
        $subcategories = SubCategory::with('products')->get();
        $products = $query->paginate(12);
        $bestSellingProducts = OrderItem::select('product_id' , DB::raw('SUM(quantity) as total_sold'))
        ->with('product')->groupBy('product_id')->orderByDesc('total_sold')
        ->limit(5)->get();
        $discount = 0.30;
        return view('frontend.store' , compact('bestSellingProducts' , 'subcategories','products' ,'discount'));
    }

    public function showCategoryProducts($slug){

        $category = Main_Category::where('slug', $slug)->first();

        if (!$category) {
            abort(404);
        }

        $products = Product::Available()->get();
        return view("frontend.products.{$slug}", compact('products', 'category'));
    }

    public function productreviews(Request $request , $product_id){

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'nullable|string',
        ]);
        $user = Auth::user();
        $hasPurchasedAndReceived = Order::where('user_id' ,$user->id)->where('status' ,'delivered')
        ->whereHas('orderitems',function($query)use($product_id){
            $query->where('product_id',$product_id);
        });
        if (!$hasPurchasedAndReceived) {
        return back()->with('error', 'you have to buy and recieve this product to make a review');
        }
        $alreadyReviewed = ProductReview::where('user_id', $user->id)->where('product_id', $product_id)->exists();

        if ($alreadyReviewed) {
            return back()->with('error', 'you have already make a review for this product');
        }
        ProductReview::create([
            'user_id' => $user->id,
            'product_id' =>$product_id,
            'name' => "$user->first_name $user->last_name",
            'rating' => $request->rating,
            'email' => $user->email,
            'content' => $request->input('content') ? $request->input('content') :'',
        ]);

        return back()->with('success', 'Thanks for your rating!');
    }

    public function subscribe(Request $request){

        $request->validate(['email'=> 'required|email|unique:newsletters,email']);
        $already_subscribed = Newsletter::ForCurrentUser()->first();
        if($already_subscribed){
            return back()->with('error', 'you have already subscribed');
        }
        Newsletter::create([
            'user_id' =>Auth::id(),
            'user_ip' => Auth::id() ? null : request()->ip(),
            'email' => $request->email,
        ]);
        return back()->with('success', 'you have subscribed successfully');
    }

}
