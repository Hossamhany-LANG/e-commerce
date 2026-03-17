@extends('layouts.app')
@section('title', 'Return Product')
@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-error">
        {{ session('error') }}
    </div>
@endif
<div class="container">
    <h3 class="mb-4">Return Product</h3>

    {{-- order details --}}
    <table class="table table-bordered mb-4">
        <tbody>
            <tr>
                <th style="width:200px;">Order Number</th>
                <td>{{ $order->id }}</td>
            </tr>
            <tr>
                <th>Order Date</th>
                <td>{{ $order->created_at->format('Y-m-d') }}</td>
            </tr>
            <tr>
                <th>Product</th>
                <td>{{ $product->product->name }}</td>
            </tr>
            <tr>
                <th>Quantity Ordered</th>
                <td>{{ $product->quantity }}</td>
            </tr>
        </tbody>
    </table>

    {{-- return request form --}}
    <form action="{{ route('returnproducts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="order_id" value="{{ $order->id }}">
        <input type="hidden" name="product_id" value="{{ $product->product_id }}">

        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity to Return</label>
            <input type="number" name="quantity" id="quantity" class="form-control" 
                min="1" max="{{ $product->quantity }}" required>
        </div>

        <div class="mb-3">
            <label for="reason" class="form-label">Reason</label>
            <textarea name="reason" id="reason" class="form-control" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Upload Product Image (optional)</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
        </div>

        <div class="mb-3">
            <label for="return_type" class="form-label">Return Type</label>
            <select name="return_type" id="return_type" class="form-control">
                <option value="replace">Replace</option>
                <option value="refund">Refund</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit Return Request</button>
    </form>
</div>
@endsection
