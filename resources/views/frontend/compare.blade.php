@extends('layouts.app')
@section('title', 'Comparison')
@section('content')
<div class="container my-5">
    <div class="section-title">
        <h3 class="title"><b>Product Comparison</b></h3>
    </div>

    @if($comparisons->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead>
                    <tr class="bg-light">
                        <th style="width: 20%;">Features</th>
                        @foreach($comparisons as $comparison)
                            <th>
                                <div class="compare-item">
                                    <img src="{{ asset($comparison->product->photo) }}" class="img-fluid mb-2" style="max-height: 150px;" alt="{{ $comparison->product->name }}">
                                    <h5>{{ $comparison->product->name }}</h5>
                                    
                                    <form action="{{ route('compare.remove', $comparison->id) }}" method="POST" class="mt-2">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fa fa-trash"></i> Remove
                                        </button>
                                    </form>
                                </div>
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="fw-bold">Price</td>
                        @foreach($comparisons as $comparison)
                            @php
                                $isDiscountActive = (now()->day == 1 && $comparison->product->is_promo);
                                $basePrice = $comparison->product->price;

                                if ($isDiscountActive) {
                                    $finalPrice = $basePrice * 0.5;
                                } elseif ($comparison->product->discount && $comparison->product->discount->discount > 0) {
                                    $finalPrice = $basePrice - ($comparison->product->discount->discount/100 * $basePrice);
                                } else {
                                    $finalPrice = $basePrice;
                                }
                            @endphp

                            <td class="text-primary fw-bold">
                                ${{ number_format($finalPrice, 2) }}
                                @if($isDiscountActive)
                                    <br><small class="text-success">(Mega Deal 50% OFF)</small>
                                @elseif($comparison->product->discount && $comparison->product->discount->discount > 0)
                                    <br><small class="text-success">(-{{ $comparison->product->discount->discount }}%)</small>
                                @endif
                            </td>
                        @endforeach
                    </tr>

                    <tr>
                        <td class="fw-bold">Description</td>
                        @foreach($comparisons as $comparison)
                            <td><small class="text-muted">{{ $comparison->product->description }}</small></td>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="fw-bold">Action</td>
                        @foreach($comparisons as $comparison)
                            <td>
                                <button class="add-to-cart-btn btn btn-danger btn-sm" data-id="{{ $comparison->product->id }}">
                                    <i class="fa fa-shopping-cart"></i> Add to Cart
                                </button>
                            </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-5">
            <i class="fa fa-exchange fa-4x mb-3 text-muted"></i>
            <h4>Your comparison list is empty!</h4>
            <p>Go back to shop and add some products to compare.</p>
            <a href="{{ url('/') }}" class="btn btn-danger">Back to Shopping</a>
        </div>
    @endif
</div>
@endsection