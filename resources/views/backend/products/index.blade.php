@extends('layouts.admin')
@section('title', 'Products')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Products</h6>
            <div class="ml-auto">
                <a href="{{route('admin.products.create')}}" class="btn btn-primary">
                <span class="icon text-white-50">
                    <i class="fa fa-plus"></i>
                </span>
                <span class="text">Add New Product</span>
                </a>
            </div>
        </div>    
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Subcategory</th>
                        <th>category</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Price After Discount</th>
                        <th>Quantity</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Image</th>
                        <th class="text-center" style="width:30px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                    <tr>
                        <td>{{$product->name}}</td>
                        <td>{{$product->subcategory->name}}</td>
                        <td>{{$product->category->name}}</td>
                        <td>EGP {{number_format($product->price,2)}}</td>
                        <td>
                            @if($product->discount && $product->discount->discount > 0)
                                {{ $product->discount->discount }}%
                            @else
                                No Discount
                            @endif
                        </td>
                        <td>
                            @if($product->discount)
                                EGP {{number_format($product->price - ($product->price *$product->discount->discount/100 ),2)}}
                            @else
                                EGP {{number_format($product->price,2)}}
                            @endif
                        </td>
                        <td>{{$product->quantity}}</td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->getActive()}}</td>
                        <td><img width="100" height="100" src="{{$product->photo}}"></td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{route('admin.products.changestatus' , $product->id)}}" class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1">
                                    @if ($product->status == 0)
                                    Enable
                                    @else
                                    Disable    
                                    @endif
                                </a>
                                <a href="{{ route('admin.products.discount', $product->id , $product->subcategory->id) }}" class="btn btn-warning">
                                    </i> Set Discount
                                </a>
                                <a href="{{route('admin.products.edit' , $product->id)}}" class="btn btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:void(0);" 
                                onclick="if(confirm('Are you sure you want to delete this record?')){document.getElementById('delete-product-{{$product->id}}').submit();}else{return false;}"
                                    class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                            <form action="{{route('admin.products.destroy' , $product->id)}}" method="POST" id="delete-product-{{$product->id}}" class="d-none">
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
                                {!! $products->appends(request()->all())->links()!!}
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('admin.allproducts.discount') }}" class="btn btn-warning">
                                </i> Set Discount For All Products
                            </a>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection