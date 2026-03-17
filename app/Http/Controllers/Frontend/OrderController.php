<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Requests\Frontend\OrderRequest;
use App\Models\Cart;
use App\Models\ContactUs;
use App\Models\Discount;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Product_Discount;
use App\Models\ReturnOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function placeorder(OrderRequest $request) {

        $cartitems = Cart::ForCurrentUser()->with('product')->get();
        if ($cartitems->count() < 1) {
            return redirect()->route('frontend.index')->with('error', 'There are no orders');
        }
        DB::beginTransaction();

        try {
            $calculatedTotal = 0;
            foreach ($cartitems as $item) {
                $isDiscountActive = (now()->day == 1 && $item->product->is_promo);
                $currentPrice = $isDiscountActive ? ($item->product->price * 0.5) : $item->product->price;
                $calculatedTotal += $currentPrice * $item->quantity;
            }

            $order = Order::create([
                'user_id'    => Auth::id(),
                'user_ip'    => request()->ip(),
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'email'      => $request->email,
                'address'    => $request->address,
                'city'       => $request->city,
                'country'    => $request->country,
                'phone'      => $request->phone,
                'review'     => $request->review,
                'order_date' => now(),
                'total_cost' => $calculatedTotal, 
            ]);

            foreach ($cartitems as $item) {
                $isDiscountActive = (now()->day == 1 && $item->is_promo);
                $finalUnitPrice = $isDiscountActive ? ($item->product->price * 0.5) : $item->product->price;

                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item->product_id,
                    'quantity'   => $item->quantity,
                    'unit_price' => $finalUnitPrice, 
                ]);
            }

            Notification::create([
                'type'       => 'order',
                'related_id' => $order->id,
                'title'      => 'New Order Placed',
                'body'       => 'Order Number: ' . $order->id . ' - Total: ' . number_format($order->total_cost, 2) . ' EGP',
                'is_read'    => false,
            ]);

            DB::commit();
            if ($request->payment_method == 'cod') {
                $cartitems->each->delete();
                return app(PaymentController::class)->handlePayment(new Request([
                    'order_id' => $order->id,
                    'payment_method' => 'cod'
                ]));
            }
            return app(PaymentController::class)->handlePayment(new Request([
                'order_id' => $order->id,
                'payment_method' => 'paypal'
            ]));
        } catch (\Exception $ex) {
            DB::rollBack();
            return $ex;
            return redirect()->route('frontend.checkout')->with('error', 'An error occurred while placing your order: ');
        }
    }

    public function showorders(){
        $orders = Order::paginate(10);
        return view('backend.orders.index' ,compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->order_status = $request->order_status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully');
    }


    public function show_order_details($id){
        $order = Order::with('orderitems.product')->find($id);
        if(!$order){
            return redirect()->back()->with('error', 'order not found');
        }
        Notification::where('type' , 'order')->where('related_id' , $id)->update(['is_read' =>true]);
        return view('backend.orders.order_details' , compact('order'));
    }

    public function deleteorder($id){
        $order = Order::find($id);
        if(!$order){
            return redirect()->back()->with('error', 'order not found');
        }
        $order->delete();
        Notification::where('type' , 'order')->where('related_id' , $id)->delete();
        return redirect()->route('backend.orders.index')->with('success', 'Order deleted successfully');
    }
    
    public function show_return_orders(){
        $return_orders = ReturnOrder::with('order')->paginate(10);
        return view('backend.return-orders.index' ,compact('return_orders'));
    }

    public function update_returns_status(Request $request ,$id){
        $return_orders = ReturnOrder::findorfail($id);
        $return_orders->status = $request->status;
        $return_orders->save();

        return redirect()->back()->with('success', 'Return order status updated successfully');
    }

    public function show_returns_details($id){
        $return_order = ReturnOrder::with('order.orderitems.product')->find($id);
        if(!$return_order){
            return redirect()->back()->with('error', 'Return order not found');
        }
        return view('backend.return-orders.return_order_details' , compact('return_order'));
    }

    public function delete_return_order($id){
        $return_order = ReturnOrder::find($id);
        if(!$return_order){
            return redirect()->back()->with('error', 'Return order not found');
        }
        if ($return_order->image) {
        Storage::disk('public')->delete($return_order->image);
        }
        $return_order->delete();
        return redirect()->view('backend.return-orders.index')->with('success', 'Order deleted successfully');
    }

    public function show_all_clients_messages(){
        $messages = ContactUs::paginate(10);
        return view('backend.clients-messages.index' ,compact('messages'));
    }
    
    public function delete_client_messages($id){
        $message = ContactUs::find($id);
        if(!$message){
            return redirect()->back()->with('error', 'Message not found');
        }
        $message->delete();
        Notification::where('type' , 'message')->where('related_id' , $id)->delete();
        return redirect()->route('show-all-clients-messages')->with('success', 'Message deleted successfully');
    }

    public function show_client_message($id){
        $message = ContactUs::find($id);
        if(!$message){
            return redirect()->back()->with('error', 'Message not found');
        }
        Notification::where('type' , 'message')->where('related_id' , $id)->update(['is_read' =>true]);
        return view('backend.clients-messages.show' , compact('message'));
    }

    public function hide_order_notification(){
        Notification::where('type' , 'order')->delete();
        return redirect()->back();
    }
}
