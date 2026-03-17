@extends('layouts.app')
@section('title', 'Checkout')
@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="section">
    <div class="container">
        <form action="{{route('placeorder')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-7">
                    <div class="billing-details">
                        <div class="section-title">
                            <h3 class="title"><b>Billing address</b></h3>
                        </div>
                        <div class="form-group">
                            <input class="input" type="text" name="first_name" placeholder="First Name" required>
                        </div>
                        <div class="form-group">
                            <input class="input" type="text" name="last_name" placeholder="Last Name" required>
                        </div>
                        <div class="form-group">
                            <input class="input" type="email" name="email" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <input class="input" type="text" name="address" placeholder="Address" required>
                        </div>
                        <div class="form-group">
                            <input class="input" type="text" name="city" placeholder="City" required>
                        </div>
                        <div class="form-group">
                            <input class="input" type="text" name="country" placeholder="Country" required>
                        </div>
                        <div class="form-group">
                            <input class="input" type="tel" name="phone" placeholder="Telephone" required>
                        </div>
                        
                        <div class="form-group">
                            <div class="input-checkbox">
                                <input type="checkbox" id="create-account">
                                <label for="create-account">
                                    <span></span>
                                    Create Account?
                                </label>
                                <div class="caption">
                                    <p>Fill in the password below to create your account.</p>
                                    <input class="input" type="password" name="password" placeholder="Enter Your Password">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="order-notes">
                        <textarea class="input" name="review" placeholder="Order Notes (Optional)"></textarea>
                    </div>
                </div>

                <div class="col-md-5 order-details">
                    <div class="section-title text-center">
                        <h3 class="title"><b>Your Orders</b></h3>
                    </div>
                    <div class="order-summary">
                        <div class="order-col">
                            <div><strong>PRODUCT</strong></div>
                            <div><strong>TOTAL</strong></div>
                        </div>
                        
                        <div class="order-products">
                            @php $calculatedTotal = 0; @endphp 
                            
                            @foreach ($products as $product)
                                @php
                                    $isDiscountActive = (now()->day == 1 && $product->product->is_promo);
                                    $basePrice = $product->product->price;

                                    if ($isDiscountActive) {
                                        $finalPrice = $basePrice * 0.5;
                                    } elseif ($product->product->discount && $product->product->discount->discount > 0) {
                                        $finalPrice = $basePrice - ($product->product->discount->discount/100 * $basePrice);
                                    } else {
                                        $finalPrice = $basePrice;
                                    }

                                    $itemTotal = $finalPrice * $product->quantity;
                                    $calculatedTotal += $itemTotal;
                                @endphp
                                
                                <div class="order-col">
                                    <div>
                                        {{ $product->quantity }}x {{ $product->product->name }}
                                        @if($isDiscountActive)
                                            <br><small class="text-success" style="font-size: 11px;">(Mega Deal 50% OFF)</small>
                                        @elseif($product->product->discount && $product->product->discount->discount > 0)
                                            <br><small class="text-success" style="font-size: 11px;">(-{{ $product->product->discount->discount }}%)</small>
                                        @endif
                                    </div>
                                    <div>
                                        ${{ number_format($itemTotal, 2) }} 
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="order-col">
                            <div>Shipping</div>
                            <div><strong>FREE</strong></div>
                        </div>
                        <hr>
                        <div class="order-col">
                            <div><strong>TOTAL</strong></div>
                            <div>
                                <strong class="order-total" style="color: #D10024; font-size: 20px;">
                                    ${{ number_format($calculatedTotal, 2) }} 
                                </strong>
                            </div>
                        </div>
                    </div>

                    <div class="payment-method">
                        <div class="input-radio">
                            <input type="radio" name="payment_method" id="payment-1" value="cod" checked>
                            <label for="payment-1">
                                <span></span>
                                Cash on Delivery (COD)
                            </label>
                            <div class="caption">
                                <p>Pay with cash upon delivery to your doorstep.</p>
                            </div>
                        </div>
                        <div class="input-radio">
                            <input type="radio" name="payment_method" id="payment-2" value="paypal">
                            <label for="payment-2">
                                <span></span>
                                Paypal System
                            </label>
                            <div class="caption">
                                <p>Secure payment via PayPal (Amounts will be converted to USD).</p>
                            </div>
                        </div>
                    </div>

                    <div class="input-checkbox">
                        <input type="checkbox" id="terms" required>
                        <label for="terms">
                            <span></span>
                            I've read and accept the <a href="#">terms & conditions</a>
                        </label>
                    </div>
                    <button type="submit" class="primary-btn order-submit" style="width: 100%;">Place order</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection