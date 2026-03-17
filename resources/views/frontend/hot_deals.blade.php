@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center"><b>🔥 Hot Deals - 50% OFF 🔥</b></h2>
    <div class="row">
        @forelse($products as $product)
            <div class="col-md-4 mb-4">
                <div class="product-img">
                    <img src="{{ $product->photo }}" class="card-img-top" alt="{{ $product->name }}">

                    <div class="card-body text-center">
                        <h5 class="card-title">
                            <a href="{{ route('frontend.product', $product->id) }}">{{ $product->name }}</a>
                        </h5>
                        <p class="text-muted">{{ $product->subcategory->name ?? 'N/A' }}</p>

                        <p><b>desc :</b> {{ Str::limit($product->description, 80) }}</p>
                        <p><b>price : </b>
                            <span class="text-muted" style="text-decoration: line-through;">{{number_format($product->price,2)}} EGP</span>
                            <span class="text-danger fw-bold">
                                {{number_format($product->discounted_price ,2)}} EGP
                            </span>
                        </p>

                        <div class="d-flex justify-content-center gap-2">
                            <button class="btn btn-outline-danger product-fav" data-product-id="{{ $product->id }}">
                                <i class="fa fa-heart"></i>
                            </button>

                            <button class="btn btn-outline-primary add-to-cart" data-product-id="{{ $product->id }}">
                                <i class="fa fa-shopping-cart"></i> Add to Cart
                            </button>

                            <a href="{{ route('frontend.product', $product->id) }}" class="btn btn-outline-secondary">
                                <i class="fa fa-eye"></i> View Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">No products available</p>
        @endforelse
    </div>
</div>
@endsection
@section('scripts')
<script>
$(document).ready(function(){
    // إضافة للمفضلة
    $('.product-fav').click(function(e){
        e.preventDefault();
        let productId = $(this).data('product-id');

        $.ajax({
            method: 'POST',
            url: '/add_wishlist/' + productId,
            data: { _token: '{{ csrf_token() }}',
            product_id: productId,
            from_hotdeals: true },
            success: function(response) {
                Swal.fire('Success', response.message, 'success');
            },
            error: function(xhr) {
                Swal.fire('Info', xhr.responseJSON.message || 'Already in wishlist', 'info');
            }
        });
    });

    // إضافة للسلة
    $('.add-to-cart').click(function(e){
        e.preventDefault();
        let productId = $(this).data('product-id');

        $.ajax({
            method: 'POST',
            url: '/cart/add',
            data: { 
                _token: '{{ csrf_token() }}',
                product_id: productId,
                from_hotdeals: true // Hot Dealsفلاج يوضح إن المنتج جاي من صفحة 
            },
            success: function(response) {
                Swal.fire('Success', response.message, 'success');
            },
            error: function(xhr) {
                Swal.fire('Error', xhr.responseJSON.message || 'Could not add to cart', 'error');
            }
        });


    });
});
</script>
@endsection