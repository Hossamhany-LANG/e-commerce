@extends('layouts.app')
@section('title', "{$product->name}")
@section('content')
		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumb-tree">
							<li class="active">{{$product->category->name}}</li>
							<li class="active">{{$product->subcategory->name}}</li>
						</ul>
					</div>
				</div>
				<!-- /row -->
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
					<!-- Product main img -->
					<div class="col-md-6">
						<div id="product-main-img">
							<div class="product-preview">
								<img src="{{$product->photo}}"alt="{{$product->name}}">
							</div>
						</div>
					</div>
					<!-- /Product main img -->

					<!-- Product details -->
					<div class="col-md-6">
						<div class="product-details">
							<h2 class="product-name">{{$product->name}}</h2>
							<div>
								@if ($product->discount && $product->discount->discount > 0)
									<h3 class="product-price">${{number_format($product->price - ($product->discount->discount/100 * $product->price) , 2)}}<del class="product-old-price">${{number_format($product->price,2)}}</del></h3>
								@else
									<h3 class="product-price">${{number_format($product->price , 2)}}</h3>
								@endif
							</div>

							<div class="add-to-cart">
								<div class="qty-label">
									Quantity
									<div class="input-number">
										<input type="number" id="product-qty" value="1" min="1">
										<span class="qty-up">+</span>
										<span class="qty-down">-</span>
									</div>
								</div>
								<br>
								<br>
								<button class="single-product-add-to-cart" data-product-id="{{ $product->id }}">
									<i class="fa fa-shopping-cart"></i> add to cart
								</button>
								<br>
								<br>
								<button class="add-to-wishlist btn-wishlist-custom" data-product-id="{{$product->id}}">
								<i class="fa fa-heart-o"></i>
								<span class="tooltipp">add to wishlist</span>
							</button>
							<br>
							<br>
							<button class="add-to-compare btn-compare-custom" data-id="{{$product->id}}">
								<i class="fa fa-exchange"></i>
								<span class="tooltipp">add to compare</span>
							</button>
							</div>
							<ul class="product-links">
								<li><b>Category :</b></li>
								<li><b>{{$product->category->name}}</b></li>
							</ul>
							<ul class="product-links">
								<li><b>SubCategory :</b></li>
								<li><b>{{$product->subcategory->name}}</b></li>
							</ul>
						</div>
					</div>
					<!-- /Product details -->

					<!-- Product tab -->
					<div class="col-md-12">
						<div id="product-tab">
							<!-- product tab nav -->
							<ul class="tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
								<li><a data-toggle="tab" href="#tab2">Reviews</a></li>
							</ul>
							<!-- /product tab nav -->

							<!-- product tab content -->
							<div class="tab-content">
								<!-- tab1  -->
								<div id="tab1" class="tab-pane fade in active">
									<div class="row">
										<div class="col-md-12">
											<p>{{$product->description}}</p>
										</div>
									</div>
								</div>
								<!-- /tab1  -->
								
								<!-- tab2  -->
								<div id="tab2" class="tab-pane fade in">
									<div class="row">
										<!-- Rating -->
										<div class="col-md-3">
											<div id="rating">
												<div class="rating-avg">
													<span>{{number_format($average , 1)}}</span>
													<div class="rating-stars">
														@for ($i = 1; $i <= 5; $i++)
															<i class="fa {{ $i <= round($average) ? 'fa-star' : 'fa-star-o' }}"></i>
														@endfor
													</div>
												</div>
												<ul class="rating">
													@foreach ($reviews as $review)
													<li>
														<span class="sum"><b>{{$review->rating}}</b></span>
														<div class="rating-stars">
															@for ($i = 1; $i <= 5; $i++)
																<i class="fa {{ $i <= $review->rating ? 'fa-star' : 'fa-star-o' }}"></i>
															@endfor
														</div>
														
													</li>
													@endforeach
												</ul>
											</div>
										</div>
										<!-- /Rating -->

										<!-- Reviews -->
										<div class="col-md-6">
											<div id="reviews">
												<ul class="reviews">
													@foreach ($reviews as $review)
													<li>
														<div class="review-heading">
															<h5 class="name">{{$review->name}}</h5>
															<p class="date">{{$review->created_at}}</p>
														<div class="review-rating">
															@for ($i = 1; $i <= 5; $i++)
																<i class="fa {{ $i <= $review->rating ? 'fa-star' : 'fa-star-o' }}"></i>
															@endfor
														</div>

														</div>
														<div class="review-body">
															<p>{{$review->content}}</p>
														</div>
													</li>
													@endforeach
												</ul>
												<div class="text-center">
													{{ $reviews->links() }}
												</div>

											</div>
										</div>
										<!-- /Reviews -->

										<!-- Review Form -->
										<div class="col-md-3">
											<div id="review-form">
												<form class="review-form" action="{{route('products.productreviews' , $product->id)}}" method="POST">
													@csrf
													<input class="input" type="text" placeholder="Your Name" name="name" required>
													<input class="input" type="email" placeholder="Your Email" name="email" required>
													<textarea class="input" placeholder="Your Review" name="content"></textarea>
													<div class="input-rating">
														<span>Your Rating: </span>
														<div class="stars">
															<input id="star5" name="rating" value="5" type="radio" required><label for="star5"></label>
															<input id="star4" name="rating" value="4" type="radio" required><label for="star4"></label>
															<input id="star3" name="rating" value="3" type="radio" required><label for="star3"></label>
															<input id="star2" name="rating" value="2" type="radio" required><label for="star2"></label>
															<input id="star1" name="rating" value="1" type="radio" required><label for="star1"></label>
														</div>
													</div>
													<button class="primary-btn">Submit</button>
												</form>
											</div>
										</div>
										<!-- /Review Form -->
									</div>
								</div>
								<!-- /tab2  -->
							</div>
							<!-- /product tab content  -->
						</div>
					</div>
					<!-- /product tab -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- Section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<div class="col-md-12">
						<div class="section-title text-center">
							<h3 class="title"><b>Related Products</b></h3>
						</div>
					</div>
					@foreach ($Related_Products as $Related_Product)
					@if($Related_Product->count())	
					<!-- product -->
					<div class="col-md-3 col-xs-6">
						<div class="product">
							<div class="product-img">
								<img src="{{$Related_Product->photo}}" alt="">
								<div class="product-label">
									@if ($Related_Product->discount && $Related_Product->discount->discount > 0)
									<span class="sale">-{{$Related_Product->discount->discount}}%</span>
									@endif
								</div>
							</div>
							<div class="product-body">
								<p class="product-category">{{$Related_Product->subcategory->name}}</p>
								<h3 class="product-name"><a href="{{route('frontend.product',$Related_Product->id)}}">{{$Related_Product->name}}</a></h3>
								@if ($Related_Product->discount && $Related_Product->discount->discount > 0)
									<h4 class="product-price">${{number_format($Related_Product->price - ($Related_Product->price * $Related_Product->discount->discount/100),2)}}<del class="product-old-price">${{number_format($Related_Product->price,2)}}</del></h4>
								@else
									<h4 class="product-price">${{number_format($Related_Product->price)}}</h4>
								@endif
								<div class="product-rating">
								</div>
								<div class="product-btns">
									<button class="add-to-wishlist product_fav" data-product-id="{{$Related_Product->id}}">
										<i class="fa fa-heart-o"></i>
										<span class="tooltipp">add to wishlist</span>
									</button>
									<button class="add-to-compare" data-id="{{$Related_Product->id}}">
										<i class="fa fa-exchange"></i>
										<span class="tooltipp">add to compare</span>
									</button>
									<button onclick="window.location.href='{{ route('frontend.product', $Related_Product->id) }}'" class="quick-view">
										<i class="fa fa-eye"></i>
										<span class="tooltipp">quick view</span>
									</button>
								</div>
							</div>
							<div class="add-to-cart">
								<button class="add-to-cart-btn" data-id="{{$Related_Product->id}}">
									<i class="fa fa-shopping-cart"></i> add to cart
								</button>
							</div>
						</div>
					</div>
					<!-- /product -->
					@endif
					@endforeach
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /Section -->
@endsection		
@section('scripts')
@section('scripts')
<script>
$(document).ready(function() {
    // نستخدم الكلاس الجديد لمنع التداخل مع كود الـ Layout
    $(document).on('click', '.single-product-add-to-cart', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation(); // أهم سطر: يمنع تنفيذ أي كود آخر مرتبط بنفس الضغطة

        let button = $(this);
        let productId = button.data('product-id');
        let quantity = $('#product-qty').val() || 1;

        $.ajax({
            url: "{{ route('cart.store') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                product_id: productId,
                quantity: quantity
            },
            beforeSend: function() {
                button.prop('disabled', true);
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message,
                        position: 'center',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    
                    // إذا كان لديك فانكشن لتحديث عداد السلة في الهيدر استدعها هنا
                    // if(typeof updateCartHeader === 'function') updateCartHeader();
                }
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: xhr.responseJSON?.message || "Something went wrong!",
                });
            },
            complete: function() {
                button.prop('disabled', false);
            }
        });
    });
});
</script>
@endsection

@endsection
