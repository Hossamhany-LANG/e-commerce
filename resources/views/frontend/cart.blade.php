@extends('layouts.app')
@section('title', 'Cart')
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
                        <th>quantity</th>
                        <th>Total Price</th>
                        <th>Image</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                    <tr>
                        <td><b>{{$product->product->name}}</b></td>
                        @php
                            $isDiscountActive = (now()->day == 1 && $product->is_promo);

                            $basePrice = $product->product->price;

                            if ($isDiscountActive) { //if there is a monthly discount
                                $finalPrice = $basePrice * 0.5;
                            } elseif ($product->product->discount && $product->product->discount->discount > 0) {//if there is a normal discount
                                $finalPrice = $basePrice - ($product->product->discount->discount/100 * $basePrice);
                            } else { //if there is no discount
                                $finalPrice = $basePrice;
                            }
                        @endphp

                        <td>
                            @if($isDiscountActive)
                                <span class="text-danger">${{ number_format($finalPrice, 2) }}</span>
                                <br><small class="label label-success">Mega Deal Applied</small>
                            @elseif($product->product->discount && $product->product->discount->discount > 0)
                                ${{ number_format($finalPrice, 2) }}
                                <small class="text-success">(-{{ $product->product->discount->discount }}%)</small>
                            @else
                                ${{ number_format($finalPrice, 2) }}
                            @endif
                        </td>

                        <td>
                            <div class="cart-qty-controls" style="display: flex; align-items: center; gap: 5px;">
                                <button type="button" class="update-qty-btn minus" data-id="{{ $product->id }}">-</button>
                                
                                <input type="number" 
                                    id="qty-{{ $product->id }}" 
                                    value="{{ $product->quantity }}" 
                                    class="cart-qty-input" 
                                    readonly 
                                    style="width: 50px; text-align: center; border: 1px solid #ddd;">
                                
                                <button type="button" class="update-qty-btn plus" data-id="{{ $product->id }}">+</button>
                            </div>
                        </td>

                        <td>
                            <strong>${{ number_format($finalPrice * $product->quantity, 2) }}</strong>
                        </td>

                        <td><img width="100" height="100" src="{{$product->product->photo}}" class="img-thumbnail"></td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="javascript:void(0);" 
                                    onclick="if(confirm('Are you sure?')){document.getElementById('delete-product-{{$product->id}}').submit();}"
                                    class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                            <form action="{{route('cart.delete' , $product->id)}}" method="POST" id="delete-product-{{$product->id}}" class="d-none">
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
                    </tr>
                </tfoot>
            </table>
        </div>
            <div class="btn-group btn-group-sm">
                <a href="{{route('frontend.checkout')}}" class="btn btn-primary">
                    <i">Checkout</i>
                </a>
                <a href="javascript:void(0);" 
                onclick="if(confirm('Are you sure you want to delete all products?')){document.getElementById('delete-product').submit();}else{return false;}"
                    class="btn btn-danger">
                    <i>Empty Cart</i>
                </a>
            </div>
            <form action="{{route('cart.delete.all')}}" method="POST" id="delete-product" class="d-none">
                @csrf
                @method('DELETE')
            </form>
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('.update-qty-btn').on('click', function() {
        let button = $(this);
        let cartId = button.data('id');
        let input = $('#qty-' + cartId);
        let currentQty = parseInt(input.val());
        let newQty = button.hasClass('plus') ? currentQty + 1 : currentQty - 1;

        if (newQty < 1) return; // منع الكمية من أن تكون أقل من 1

        $.ajax({
            url: "{{ route('cart.update') }}", // سننشئ هذا المسار الآن
            method: "PATCH",
            data: {
                _token: "{{ csrf_token() }}",
                cart_id: cartId,
                quantity: newQty
            },
            beforeSend: function() {
                button.prop('disabled', true);
            },
            success: function(response) {
                if (response.success) {
                    input.val(newQty);
                    // تحديث إجمالي سعر المنتج في الصف (Row)
                    // افترضنا أن خلية السعر الإجمالي لها class اسمه product-total-price
                    location.reload(); // أسهل طريقة لتحديث كل الحسابات والخصومات في الصفحة
                }
            },
            error: function() {
                alert('حدث خطأ أثناء تحديث الكمية');
            },
            complete: function() {
                button.prop('disabled', false);
            }
        });
    });
});
</script>

<style>
    .update-qty-btn {
        background: #D10024;
        color: white;
        border: none;
        width: 25px;
        height: 25px;
        cursor: pointer;
        border-radius: 4px;
    }
    .update-qty-btn:disabled { background: #ccc; }
</style>
@endsection