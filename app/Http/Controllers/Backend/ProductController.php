<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductRequest;
use App\Models\Main_Category;
use App\Models\Product;
use App\Models\Product_Discount;
use App\Models\ProductReview;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\UploadImagesTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use UploadImagesTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $products = Product::paginate(10);
        return view('Backend.products.index' , compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        $categories = Main_Category::where('translation_of' , 0)->active()->get();
        $subcategories = SubCategory::where('active' , 1)->get();
        return view('backend.products.create' , compact('categories' , 'subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request){
        try{
            $file_path = '';
            if($request->hasFile('photo') && $request->file('photo')->isValid()){
                $file_path = $this->uploadimage('products' , $request->photo);
            } else {
                return redirect()->route('admin.vendors.index')->with(['error' => 'Uploaded file is invalid or missing!']);
            }

            Product::create([
                'name' => $request->name,
                'slug' => $request->name,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'description' => $request->description,
                'status' => $request->status,
                'photo' => $file_path,
            ]);
            return redirect()->route('admin.products.index')->with(['success' => 'the producrt added successfully']);
        }catch(\Exception $ex){
            return redirect()->route('admin.products.index')->with(['error' => 'there is a problem, please try later']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try{
            $product = Product::find($id);
            if(!isset($product)){
                return redirect()->route('admin.products.index')->with(['error' => 'this product not found']);
            }
            $categories = Main_Category::where('translation_of' , 0)->active()->get();

            return view('backend.products.edit' , compact('product' , 'categories'));
        }catch(\Exception $ex){
            return redirect()->route('admin.products.index')->with(['error' => 'there is a problem, please try later']);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        try{
            $product = Product::find($id);
            if(!$product){
                return redirect()->route('admin.products.index')->with(['error' => 'this product not found']);
            }

            $file_path = $product->photo; 

            if ($request->hasFile('photo')) {
                if ($request->file('photo')->isValid()) {
                    $file_path = $this->uploadimage('products', $request->photo);
                } else {
                    return redirect()->route('admin.products.index')->with(['error' => 'Uploaded file is invalid!']);
                }
            }
            $product->update([
                'name' => $request->name,
                'slug' => $request->name,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'description' => $request->description,
                'status' => $request->status,
                'photo' => $file_path,
            ]);
            return redirect()->route('admin.products.index')->with(['success' => 'the producrt added successfully']);
        }catch(\Exception $ex){
            return redirect()->route('admin.products.index')->with(['error' => 'there is a problem, please try later']);
        }    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $product = Product::find($id);
            
            if(!$product){
                return redirect()->route('admin.products.index')->with(['error' => 'this product is not found']);
            }

            $photo = Str::after($product->photo , 'assets/');
            $photo_path = public_path('assets/' . $photo);
            if(file_exists($photo_path)){
                unlink($photo_path);
            }
            $product->delete();
            return redirect()->route('admin.products.index')->with(['success' => 'the product deleted successfully']);
        }catch(\Exception $ex){
            return redirect()->route('admin.products.index')->with(['error' => 'there is a problem, please try later']);
        }
    }

    public function getSubcategories($id){
        $subcategories = SubCategory::where('category_id', $id)->where('active', 1)->get();
        return response()->json($subcategories);
    }
    
    public function changestatus($id)
    {
        $product = Product::find($id);
        if(!$product){
            return redirect()->route('admin.products.index')->with(['error' => 'this product not found']);
        }
        $product->status = !$product->status;
        $product->save();
        return redirect()->route('admin.products.index')->with(['success' => 'the product status changed successfully']);
    }
    
    public function hotdeals(){
        if (now()->day !== 1) {
        return response("You will not be able to access this page until the first day of next month.", 403);
        }
        $products = Product::where('status' , 1)->get()->map(function($product) {
            $product->discounted_price = $product->price * 0.5;
            return $product;
        });

        return view('frontend.hot_deals', compact('products'));
    }

    public function discount($id){
        $product = Product::findOrFail($id);
        return view('backend.discount.index', compact('product'));
    }

    public function updateDiscount(Request $request, $id){
        $product = Product::findOrFail($id);

        Product_Discount::updateOrCreate(
            ['product_id' => $product->id],
            ['discount' => $request->discount]
        );

        return redirect()->route('admin.products.index')->with('success', 'Discount updated successfully');
    }

    public function discount_all(){
        return view('backend.discount.all_products');
    }

    public function updateDiscount_forall(Request $request){
        $products = Product::all();
        foreach ($products as $product) {
            Product_Discount::updateOrCreate(
            ['product_id' => $product->id],
            ['discount' => $request->discount]
        );
        }
        return redirect()->route('admin.products.index')->with('success', 'Discount updated successfully');
    }

}
