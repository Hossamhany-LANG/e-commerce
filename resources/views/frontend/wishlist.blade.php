@extends('layouts.app')
@section('title', 'WishList')
@section('content')
		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>add to cart</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($wishlists as $wishlist)
                    @php
                        $isDiscountActive = (now()->day == 1 && $wishlist->is_promo);

                        $basePrice = $wishlist->product->price;

                        if ($isDiscountActive) { //if there is a monthly discount
                            $finalPrice = $basePrice * 0.5;
                        } elseif ($wishlist->product->discount && $wishlist->product->discount->discount > 0) {//if there is a normal discount
                            $finalPrice = $basePrice - ($wishlist->product->discount->discount/100 * $basePrice);
                        } else { //if there is no discount
                            $finalPrice = $basePrice;
                        }
                    @endphp
                    <tr>
                    <td><b>{{$wishlist->product->name}}</b></td>
                    <td>
                        @if($isDiscountActive)
                            <span class="text-danger" style="font-weight: bold;">
                                $ {{ number_format($finalPrice, 2) }}
                            </span>
                            <br>
                            <span class="badge badge-success" style="font-size: 10px;">Mega Deal 50% OFF</span>
                        @elseif($wishlist->product->discount && $wishlist->product->discount->discount > 0)
                            <span class="text-danger" style="font-weight: bold;">
                                $ {{ number_format($finalPrice, 2) }}
                            </span>
                            <br>
                            <small class="text-success">(-{{ $wishlist->product->discount->discount }}%)</small>
                        @else
                            $ {{ number_format($finalPrice, 2) }}
                        @endif
                    </td>
                    <td><img width="100" height="100" src="{{$wishlist->product->photo}}"></td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="javascript:void(0);" 
                            onclick="document.getElementById('add-to-cart-{{ $wishlist->id }}').submit();" 
                            class="btn btn-success">
                                <i class="fa fa-shopping-cart"></i> Add to Cart
                            </a>
                        </div>
                        <form action="{{ route('wishlist.moveToCart', $wishlist->id) }}" method="POST" id="add-to-cart-{{ $wishlist->id }}" class="d-none">
                            @csrf
                        </form>
                    </td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="javascript:void(0);" 
                            onclick="if(confirm('Are you sure you want to delete this product from wishlist?')){document.getElementById('delete-product-{{$wishlist->id}}').submit();}else{return false;}"
                                class="btn btn-danger">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                        <form action="{{route('wishlist_product.delete' , $wishlist->id)}}" method="POST" id="delete-product-{{$wishlist->id}}" class="d-none">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center"> No Products Found</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="9">
                            <div class="float-right">
                                {!! $wishlists->appends(request()->all())->links()!!}
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
            <div class="btn-group btn-group-sm">
                <a href="javascript:void(0);" 
                onclick="document.getElementById('move-all-to-cart').submit();" 
                class="btn btn-primary">
                    <i class="fa fa-shopping-cart"></i> Add all to cart
                </a>

                <a href="javascript:void(0);" 
                onclick="if(confirm('Are you sure you want to delete all products from wishlist?')){document.getElementById('delete-product').submit();}else{return false;}"
                class="btn btn-danger">
                    <i class="fa fa-trash"></i> Empty WishList
                </a>
            </div>

            <form action="{{ route('wishlist.moveAllToCart') }}" method="POST" id="move-all-to-cart" class="d-none">
                @csrf
            </form>

            <form action="{{ route('wishlist.delete.all') }}" method="POST" id="delete-product" class="d-none">
                @csrf
                @method('DELETE')
            </form>

			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->
@endsection

