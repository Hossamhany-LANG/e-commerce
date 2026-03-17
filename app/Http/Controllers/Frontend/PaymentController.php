<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Models\Cart;

class PaymentController extends Controller
{
    public function handlePayment(Request $request){
        $order = Order::findOrFail($request->order_id);

        if ($request->payment_method == 'cod') {
            $order->update([
                'payment_method' => 'cod',
                'payment_status' => 'pending'
            ]);
            
            return redirect()->route('frontend.index')->with('success', 'Your order has been placed successfully (Cash on Delivery).');
        }

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [[
                "amount" => [
                    "currency_code" => "USD", 
                    "value" => $order->total_cost
                ]
            ]],
            "application_context" => [
                "cancel_url" => route('payment.cancel'),
                "return_url" => route('payment.success', ['order_id' => $order->id]),
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
        }

        return redirect()->back()->with('error', 'Something went wrong while connecting to PayPal.');
    }

    public function paymentSuccess(Request $request){
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $order = Order::find($request->order_id);
            
            if ($order) {
                $order->update([
                    'payment_status' => 'paid',
                    'payment_id' => $response['id']
                ]);

                Cart::where('user_id', $order->user_id)->delete();

                return redirect()->route('frontend.index')->with('success', 'Payment successful! Your cart has been cleared and your order is being processed.');
            }
        }

        return redirect()->route('frontend.index')->with('error', 'Payment process failed. Your items are still in the cart.');
    }

    public function paymentCancel(){

        return redirect()->route('frontend.index')->with('error', 'The payment process has been cancelled.');
    }
}