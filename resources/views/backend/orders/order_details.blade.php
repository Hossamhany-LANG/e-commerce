@extends('layouts.admin')
@section('title', 'Order details')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Order Details</h6>
        </div>    
        <div class="ml-auto">
            <a href="{{route('showorders')}}" class="btn btn-primary">
            <span class="icon text-white-50">
                <i class="fa fa-home"></i>
            </span>
            <span class="text">All Orders</span>
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Products</th>
                        <th>Quantity</th>
                        <th>price</th>
                        <th>address</th>
                        <th>payment_method</th>
                        <th>client notes</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($order->orderitems as $item)
                    <tr>
                        <td>{{$item->product->name}}</td>
                        <td>{{$item->quantity}}</td>
                        <td>${{number_format($item->unit_price,2)}}</td>
                        <td>{{$order->address}}</td>
                        <td>{{$order->payment_method}}</td>
                        <td>{{$order->review}}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center"> No orders Found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection