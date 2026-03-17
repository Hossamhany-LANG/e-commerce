<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function Add_Cart(Request $request){
        
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);
        $existingCartItem = Cart::where('product_id', $request->product_id)
            ->ForCurrentUser()->first();

        if ($existingCartItem) {
            return response()->json(['message' => 'Product already added'], 409);
        }

        $product = Product::find($request->product_id);

        //The discount only applies if the add-on is from the Hot Deals page + today is day 1 of the month
        $is_valid_promo = ($request->from_hotdeals == true && now()->day == 1);
        
        Cart::create([
            'user_id' => Auth::id(),
            'user_ip' => Auth::id() ? null :request()->ip(),
            'product_id' => $request->product_id,
            'quantity' => 1,
            'price' => $product->price, 
            'is_promo' => $is_valid_promo, 
        ]);

        return response()->json(['message' => 'Product added to cart successfully!'], 200);
    }
    public function updateQuantity(Request $request) {
        $cartItem = Cart::find($request->cart_id);
        
        if ($cartItem) {
            $cartItem->update([
                'quantity' => $request->quantity
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Quantity updated'
            ]);
        }

        return response()->json(['success' => false], 404);
    }
    public function delete_Cart($id){
        Cart::where('id' , $id)->delete();
        return redirect()->back();
    }

    public function delete_all_Carts(){
        $data = Cart::ForCurrentUser();
        $data->delete();
        return redirect()->back();
    }

    public function store(Request $request){
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $exists = Cart::ForCurrentUser()->where('product_id' ,$request->product_id)->first();
        if ($exists) {
            $exists->increment('quantity');
        } else {
        Cart::create([
            'user_id'    => Auth::id(),
            'user_ip'    => request()->ip(),
            'product_id' => $request->product_id,
            'quantity'   => $request->quantity,
        ]);
        }
        return response()->json(['success' => true, 'message' => 'Product added to cart successfully!']);
    }


}
