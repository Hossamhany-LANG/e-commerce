<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\InformationRequest;
use App\Models\AboutUs;
use App\Models\ContactUs;
use App\Models\Notification;
use App\Models\Order;
use App\Models\ReturnOrder;
use Illuminate\Http\Request;
use App\UploadImagesTrait;
use Illuminate\Support\Facades\Auth;

class InformationController extends Controller
{
    use UploadImagesTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $information = AboutUs::first();
        return view('backend.about-us.index' , compact('information'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.about-us.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InformationRequest $request)
    {
        try{
            $file_path = '';
            if($request->hasFile('image') && $request->file('image')->isValid()){
                $file_path = $this->uploadimage('informations' , $request->image);
            } else {
                return redirect()->route('admin.vendors.index')->with(['error' => 'Uploaded file is invalid or missing!']);
            }
            AboutUs::create([
                'pagename' => $request->pagename,
                'phone' => $request->phone,
                'email' => $request->email,
                'description' => $request->description,
                'address' => $request->address,
                'image' => $file_path,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram,
                'linkedin' => $request->linkedin,
            ]);
            return redirect()->route('admin.about-us.index')->with(['success' => 'Informations added successfully']);
        }catch(\Exception $ex){
            return redirect()->route('admin.about-us.index')->with(['error' => 'there is a problem, please try later']);
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
    public function edit($id)
    {
        $information = AboutUs::find($id);
        if(!$information){
            return redirect()->back()->with('error', 'this item not found');
        }else{
            return view('backend.about-us.edit' ,compact('information'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $information = AboutUs::find($id);
        if(!$information){
            return redirect()->back()->with('error', 'this item not found');
        }else{
            $file_path = $information->image;
            if($request->hasFile('image')){
                if($request->file('image')->isValid()){
                    $file_path = $this->uploadimage('informations' , $request->image);
                }else{
                    return redirect()->route('admin.about-us.index')->with(['error' => 'Uploaded file is invalid!']);
                }
            }
            $information->update([
                'pagename' => $request->pagename,
                'phone' => $request->phone,
                'email' => $request->email,
                'description' => $request->description,
                'address' => $request->address,
                'image' => $file_path,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram,
                'linkedin' => $request->linkedin,                
            ]);
            return view('backend.about-us.index' ,compact('information'));
        }        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $information = AboutUs::find($id);
        if(!$information){
            return redirect()->back()->with('error', 'this item not found');
        }
        unlink($information->image);
        $information->delete();
            return redirect()->route('admin.about-us.index')->with(['success' => 'Informations deleted successfully']);
    }

    public function aboutus(){
        $information = AboutUs::first();
        return view('frontend.page_information.about-us' , compact('information'));
    }
    
    public function contactus(){
        $information = AboutUs::first();
        return view('frontend.page_information.contact-us' , compact('information'));
    }

    public function storecontactus(Request $request){
        $request->validate([
            'subject' => 'string|max:255',
            'message' => 'required|string',
        ]);
        $message = ContactUs::create([
            'name' => Auth::user()->username,
            'email' => Auth::user()->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);
        Notification::create([
            'type' => 'message',
            'related_id' => $message->id,
            'title' => 'New Contact Message',
            'body' => $message->subject,
            'is_read' => false,
        ]);

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }

    public function privacy_policy(){
        $information = AboutUs::first();
        return view('frontend.page_information.privacy-policy' , compact('information'));
    }

    public function orders_and_returns()
    {
        if (Auth::check()) {
            $orders = Order::with('orderItems.product')->where('user_id', Auth::id())->get();

            $returns = ReturnOrder::with('product', 'order')
                ->whereHas('order', function ($q) {
                    $q->where('user_id', Auth::id());}) ->get();
        } else {
            $orders = Order::with('orderItems.product')->where('user_ip', request()->ip())->get();

            $returns = ReturnOrder::with('product', 'order')
                ->whereHas('order', function ($q) {
                    $q->where('user_ip', request()->ip());}) ->get();
        }

        return view('frontend.page_information.orders-returns', compact('orders', 'returns'));
    }

    public function returnproducts($order_id, $product_id){
        $order = Order::where('id', $order_id)->ForCurrentUser()->first();
        if (!$order) {
            return redirect()->back()->with('error', 'Order not found or you do not have permission to return this product.');
        }

        $product = $order->orderItems()->where('product_id', $product_id)->first();
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found in this order.');
        }
        return view('frontend.page_information.return-product' , compact('order', 'product'));
    }

    public function store_return_products(Request $request){
        $request->validate([
            'quantity' => 'required|min:1|integer',
            'reason' => 'required|string',
            'image' => 'mimes:jpg,png,jpeg',
            'return_type' => 'required|in:replace,refund',
        ]);
        $product = ReturnOrder::where('order_id', $request->order_id)->where('product_id', $request->product_id)->first();
        if($product){
            return redirect()->route('orders_and_returns')->with('error', "you have already {$request->return_type} it!");
        }
        $file_path = null;
            if($request->hasFile('image')){
                if($request->file('image')->isValid()){
                    $file_path = $this->uploadimage('returnproducts' , $request->image);
                }else{
                    return redirect()->route('frontend.page_information.return-product')
                    ->with(['error' => 'Uploaded file is invalid!']);
                }
            }
        ReturnOrder::create([
            'order_id' =>$request->order_id,
            'product_id' =>$request->product_id,
            'quantity' =>$request->quantity,
            'reason' =>$request->reason,
            'image' =>$file_path,
            'return_type' =>$request->return_type
        ]);
        return redirect()->route('orders_and_returns')->with('success', 'Your request has been sent successfully!');
    }

    public function terms_and_conditions(){
        $information = AboutUs::first();
        return view('frontend.page_information.terms-and-conditions' , compact('information'));
    }

    public function help(){
        $information = AboutUs::first();
        return view('frontend.page_information.help' , compact('information'));
    }
}
