<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function add_wishlist(Request $request,$id){

        $existing_product = WishList::where('product_id' , $id)->ForCurrentUser()->first();

        if($existing_product){
            return response()->json(['message' => 'Product already added to favourite'], 409);
        }
        $product = Product::findOrFail($id);
        $isFromHotDeals = $request->boolean('from_hotdeals');
        $unitPrice = $isFromHotDeals ? $product->price * 0.5 : $product->price;
        WishList::create([
            'user_id' =>Auth::id(),
            'user_ip' =>Auth::id() ? null : request()->ip(),
            'product_id' => $product->id,
            'price' => $unitPrice,
            'is_discounted'=> $isFromHotDeals,
        ]);

        return response()->json(['message' => 'Product added to favourite successfully'], 200);
    }
    
    public function wishlist(){

        $wishlists = WishList::ForCurrentUser()->paginate(10);
        return view('frontend.wishlist' , compact('wishlists'));
    }
    
    public function moveToCart(Request $request, $id) {

        $wishlist = WishList::with('product')->find($id); 

        if (!$wishlist) {
            return redirect()->back()->with('error', 'Wishlist item not found');
        }
        $exists = Cart::where('user_id', Auth::id())->where('product_id', $wishlist->product_id)->first();

        if ($exists) {
            $exists->increment('quantity');
        } else {
            Cart::create([
                'user_id'    => Auth::id(),
                'user_ip'    => $request->ip(),
                'quantity'   => 1,
                'product_id' => $wishlist->product_id,
                'price' => (now()->day == 1 && $wishlist->product->is_promo) ?
                ($wishlist->product->price * 0.5) : $wishlist->product->price,
            ]);
        }
        $wishlist->delete();
        return redirect()->route('frontend.cart')->with('success', 'Product moved to cart successfully');
    }

    public function delete_wishlist_product($id){

        $wishlists = WishList::find($id);
        if(!$wishlists){
            return redirect()->back()->with('error', 'Wishlist item not found');
        }
        $wishlists->delete();
        return redirect()->back()->with('success', 'Product removed from wishlist successfully');
    }

    public function delete_all_wishlist_products(){

        WishList::ForCurrentUser()->delete();
        return redirect()->back()->with('success', 'All products removed from wishlist successfully');
    }
    
    public function moveAllToCart(){
        
        $wishlists = WishList::ForCurrentUser()->get();
        foreach($wishlists as $wishlist){
            Cart::firstOrCreate([
                'user_id' => Auth::id(),
                'user_ip' => request()->ip(),
                'quantity' => 1,
                'product_id' => $wishlist->product_id,
            ]);
            $wishlist->delete();
        }
        return redirect()->route('frontend.cart')->with('success', 'All products moved to cart successfully');
    }
}
