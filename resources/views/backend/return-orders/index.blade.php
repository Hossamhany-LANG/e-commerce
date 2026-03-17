@extends('layouts.admin')
@section('title', 'Orders')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Return Orders</h6>
        </div>    
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Order Id</th>
                        <th>Client Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>return Date</th>
                        <th>Status</th>
                        <th>Details</th>
                        <th class="text-center" style="width:30px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($return_orders as $return_order)
                    <tr>
                        <td>{{$return_order->order->id}}</td>
                        <td>{{$return_order->order->first_name}} {{$return_order->order->last_name}}</td>
                        <td>{{$return_order->order->email}}</td>
                        <td>{{$return_order->order->phone}}</td>
                        <td>{{$return_order->created_at}}</td>
                        <td>
                            <form action="{{ route('update_returns_status', $return_order->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status" class="form-control form-control-sm" onchange="this.form.submit()">
                                    <option value="under review" {{ $return_order->status == 'under review' ? 'selected' : '' }}>under review</option>
                                    <option value="accepted" {{ $return_order->status == 'accepted' ? 'selected' : '' }}>accepted</option>
                                    <option value="rejected" {{ $return_order->status == 'rejected' ? 'selected' : '' }}>rejected</option>
                                    <option value="replaced" {{ $return_order->status == 'replaced' ? 'selected' : '' }}>replaced</option>
                                </select>
                            </form>
                        </td>
                        <td><a href="{{route('show_returns_details' , $return_order->id)}}"><b>show details</b></a></td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="javascript:void(0);" 
                                onclick="if(confirm('Are you sure you want to delete this order?')){document.getElementById('delete-product-{{$return_order->id}}').submit();}else{return false;}"
                                    class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                            <form action="{{route('delete_return_order' , $return_order->id)}}" method="POST" id="delete-product-{{$return_order->id}}" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center">No return orders found</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="9">
                            <div class="float-right">
                                {!! $return_orders->appends(request()->all())->links()!!}
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection