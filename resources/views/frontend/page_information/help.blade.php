@extends('layouts.app')

@section('title', 'Help')

@section('content')
<div class="container my-5">
    <h2 class="mb-4 text-center font-weight-bold display-4 text-primary"><b>Help & Support</b></h2>

    <div class="card shadow-sm p-4 text-left">
        <h3 class="mb-4 font-weight-bold text-primary"><b>Getting Started</b></h3>
        <p>
            Welcome to <strong>{{ $information->pagename }}</strong>. This Help page is designed to guide you through using our website and services effectively.
        </p>

        <h3 class="mb-4 font-weight-bold text-primary"><b>Common Questions</b></h3>
        <ul>
            <li><strong>How do I create an account?</strong> Click on the "Sign Up" button and fill in your details.</li>
            <li><strong>How can I place an order?</strong> Browse products, add them to your cart, and proceed to checkout.</li>
            <li><strong>Can I track my order?</strong> Yes, you can track your order status from your account dashboard.</li>
            <li><strong>What payment methods are accepted?</strong> We accept credit cards, debit cards, and online payment gateways.</li>
        </ul>

        <h3 class="mb-4 font-weight-bold text-primary"><b>Returns & Refunds</b></h3>
        <p>
            If you need to return a product, please visit our <a href="{{ route('privacy_policy') }}">Returns Policy</a> page for detailed instructions.
        </p>

        <h3 class="mb-4 font-weight-bold text-primary"><b>Technical Support</b></h3>
        <p>
            If you encounter any technical issues, please clear your browser cache or try a different browser. If the problem persists, contact our support team.
        </p>

        <h3 class="mb-4 font-weight-bold text-primary"><b>Contact Us</b></h3>
        <p>
            For further assistance, you can reach us at: <br>
            📧 Email: <strong>{{ $information->email }}</strong><br>
            📞 Phone: <strong>{{ $information->phone }}</strong>
        </p>
    </div>
</div>
@endsection
