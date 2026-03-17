@extends('layouts.app')
@section('title', 'Terms & Conditions')

@section('content')
<div class="container my-5">
    <h2 class="mb-4 text-center font-weight-bold display-4 text-primary"><b>Terms & Conditions</b></h2>
    <p>-Welcome to <b>{{$information->pagename}}</b>. By accessing or using our website, you agree to comply with the following Terms & Conditions. Please read them carefully:</p>
    <br>
    <h4 class="mb-4 font-weight-bold display-4 text-primary"><b>1. Use of Website</b></h4>
    <p>You agree not to misuse our services, attempt unauthorized access, or engage in harmful activities.</p>
    <br>
    <h4 class="mb-4 font-weight-bold display-4 text-primary"><b>2. Orders and Payments</b></h4>
    <p>All orders are subject to availability and acceptance. Prices may change without prior notice. Payments must be completed through approved methods.</p>
    <br>    
    <h4 class="mb-4 font-weight-bold display-4 text-primary"><b>3. Shipping and Delivery</b></h4>
    <p>Delivery times are estimates and may vary. We are not responsible for delays caused by third-party carriers.</p>
    <br>
    <h4 class="mb-4 font-weight-bold display-4 text-primary"><b>4. Returns and Refunds</b></h4>
    <p>Products may be returned within 10 days subject to our Return Policy. Items must be unused and in original packaging.</p>
    <br>
    <h4 class="mb-4 font-weight-bold display-4 text-primary"><b>5. Intellectual Property</b></h4>
    <p>All content on this website is the property of <b>{{$information->pagename}}</b>. Unauthorized use is prohibited.</p>
    <br>
    <h4 class="mb-4 font-weight-bold display-4 text-primary"><b>6. Limitation of Liability</b></h4>
    <p>We are not liable for indirect or consequential damages arising from the use of our services.</p>
    <br>
    <h4 class="mb-4 font-weight-bold display-4 text-primary"><b>7. Changes to Terms</b></h4>
    <p>We may update these Terms & Conditions at any time. Continued use of our services constitutes acceptance of the updated terms.</p>
    <br>
    <h4 class="mb-4 font-weight-bold display-4 text-primary"><b>8. Governing Law</b></h4>
    <p>These Terms & Conditions are governed by the laws of Egypt.</p>
</div>
@endsection
