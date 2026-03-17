@extends('layouts.admin')
@section('title', 'Return Order details')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Return Order Details</h6>
        </div>  
        <div class="ml-auto">
            <a href="{{route('show-return-orders')}}" class="btn btn-primary">
            <span class="icon text-white-50">
                <i class="fa fa-home"></i>
            </span>
            <span class="text">All Return Orders</span>
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity returned</th>
                        <th>Unit Price</th>
                        <th>Total Price</th>
                        <th>Reason</th>
                        <th>Return_Type</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$return_order->product->name}}</td>
                        <td>{{$return_order->quantity}}</td>
                        <td>${{number_format($return_order->product->price,2)}}</td>
                        <td>${{number_format($return_order->product->price*$return_order->quantity,2)}}</td>
                        <td>{{$return_order->reason}}</td>
                        <td>{{$return_order->return_type}}</td>
                        <td>
                        @if($return_order->image)
                            <img src="{{asset($return_order->image)}}" alt="Return product image" width="120">
                        @else
                            No image
                        @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection