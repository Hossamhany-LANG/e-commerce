@extends('layouts.admin')
@section('title', 'Orders')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Orders</h6>
        </div> 
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Order Id</th>
                        <th>Client Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Order Date</th>
                        <th>Total Price</th>
                        <th>Order Status</th>
                        <th>Details</th>
                        <th class="text-center" style="width:30px;">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->first_name}} {{$order->last_name}}</td>
                        <td>{{$order->email}}</td>
                        <td>{{$order->phone}}</td>
                        <td>{{$order->created_at}}</td>
                        <td>${{number_format($order->total_cost,2)}}</td>
                        <td>
                            <form action="{{ route('update_order_status', $order->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="order_status" class="form-control form-control-sm" onchange="this.form.submit()">
                                    <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="shipped" {{ $order->order_status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                    <option value="delivered" {{ $order->order_status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </form>
                        </td>
                        <td><a href="{{route('show_order_details' , $order->id)}}"><b>show details</b></a></td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="javascript:void(0);" 
                                onclick="if(confirm('Are you sure you want to delete this order?')){document.getElementById('delete-product-{{$order->id}}').submit();}else{return false;}"
                                    class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                            <form action="{{route('deleteorder' , $order->id)}}" method="POST" id="delete-product-{{$order->id}}" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center"> No Products Found</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="9">
                            <div class="float-right">
                                {!! $orders->appends(request()->all())->links()!!}
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection