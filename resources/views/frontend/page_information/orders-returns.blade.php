@extends('layouts.app')
@section('title', 'My Orders & Returns')
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

    {{-- Orders Section --}}
    <h3 class="mb-4"><b>My Orders</b></h3>
    @forelse($orders as $order)
        <table class="table table-bordered mb-4">
            <tbody>
                <tr>
                    <th style="width:200px;">Order Number</th>
                    <td>{{ $order->id }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ $order->order_status }}</td>
                </tr>
                <tr>
                    <th>Order Date</th>
                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                </tr>
                <tr>
                    <th>Products</th>
                    <td>
                        @foreach($order->orderItems as $item)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <strong>{{ $item->product->name }}</strong>  
                                    <span> ({{ $item->quantity }}) </span>
                                </div>
                                @if($order->order_status == 'delivered')
                                    <a href="{{ route('returnproducts.create', ['order_id' => $order->id, 'product_id' => $item->product_id]) }}" 
                                    class="btn btn-sm btn-warning">Return Request</a>
                                @endif
                            </div>
                        @endforeach
                    </td>
                </tr>
            </tbody>
        </table>
        
    @empty
        <p>No Orders Yet</p>
    @endforelse

    {{-- Returns Section --}}
    <h3 class="mt-5 mb-4"><b>My Returns</b></h3>
    @if($returns->count() > 0)
        @foreach($returns as $return)
            <table class="table table-bordered mb-4">
                <tbody>
                    <tr>
                        <th style="width:200px;">Product</th>
                        <td>{{ $return->product->name }}</td>
                    </tr>
                    <tr>
                        <th>Quantity</th>
                        <td>{{ $return->quantity }}</td>
                    </tr>
                    <tr>
                        <th>Reason</th>
                        <td>{{ $return->reason }}</td>
                    </tr>
                    <tr>
                        <th>Return Type</th>
                        <td>{{ $return->return_type == 'replace' ? 'Replace' : 'Refund' }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ $return->status }}</td>
                    </tr>
                    @if($return->image)
                        <tr>
                            <th>Image</th>
                            <td>
                                <img src="{{$return->image}}" alt="returned product image" width="120">
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        @endforeach
    @else
        <p>No Returns Yet</p>
    @endif

</div>
@endsection
