@extends('layouts.app')
@section('title', 'computerdevices')
@section('content')
		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumb-tree">
							<li>Computers</li>
							<li>Laptops</li>
							<li>Tablets</li>
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
					
					<div class="col-md-4 col-md-push-2">
						<div  id="product-main-img">
							@foreach ($products as $product)
							<div class="product-preview">
								<img class="product-img" src="{{$product->photo}}" alt="">
							</div>
							@endforeach
						</div>
					</div>
					<!-- /Product main img -->

					<!-- Product thumb imgs -->
					<div class="col-md-2  col-md-pull-4">
						<div id="product-imgs">
							@foreach ($products as $product)
							<div class="product-preview">
								<img src="{{$product->photo}}" alt="">
							</div>
							@endforeach

						</div>
					</div>
					<!-- /Product thumb imgs -->

					<!-- Product details -->
					<div class="col-md-6">
						<div class="product-details">
							<h2 class="product-name"><a href="{{route('frontend.product' ,$products[0]->id)}}">{{$products[0]->name}}</a></h2>
                        <div>
                            <div class="product-rating">
								@php
									$avgRating = round($products[0]->productreview_avg_rating); 
								@endphp

								@for($i = 1; $i <= 5; $i++)
									@if($i <= $avgRating)
										<i class="fa fa-star"></i>
									@else
										<i class="fa fa-star-o"></i>
									@endif
								@endfor
							</div>
                            <a class="review-link" href="{{route('frontend.product' ,$products[0]->id)}}">
								{{ $products[0]->productreview_count }} Review(s) | Add your review</a>
                        </div>
							@if($products[0]->discount && $products[0]->discount->discount > 0 )
								<h3 class="product-price">${{ number_format($products[0]->price - ($products[0]->discount->discount/100 *$products[0]->price), 2) }}
									<del class="product-old-price">${{ number_format($products[0]->price, 2) }}</del>
								</h3>
							@else
								<h3 class="product-price">${{ number_format($products[0]->price, 2) }} </h3>
							@endif
								<span class="product-available">In Stock</span>
							</div>
							<p class="product-description">{{ $products[0]->description }}</p>

							<div class="add-to-cart">
								<button class="add-to-cart-btn primary-btn" data-id="{{ $products[0]->id }}">
									<i class="fa fa-shopping-cart"></i> add to cart
								</button>
							</div>
							<br>
							<ul class="product-btns">
								<li>
									<a href="#" class="add-to-wishlist btn-wishlist-custom" data-product-id="{{ $products[0]->id }}">
										<i class="fa fa-heart-o"></i> add to wishlist
									</a>
								</li>
							</ul>
							<br>
							<ul>
								<li>
									<a href="#" class="add-to-compare btn-compare-custom" data-id="{{ $products[0]->id }}">
										<i class="fa fa-exchange"></i> add to compare
									</a>
								</li>
							</ul>
						</div>
					</div>
					<!-- /Product details -->

					<!-- Product tab -->
					<div class="col-md-12">
						<div id="product-tab">
							<!-- product tab nav -->
							<ul class="tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Computers</a></li>
								<li><a data-toggle="tab" href="#tab2">Laptops</a></li>
								<li><a data-toggle="tab" href="#tab3">Tablets</a></li>
							</ul>
							<!-- /product tab nav -->

							<!-- product tab content -->
							<div class="tab-content">
								<!-- tab1  -->
								<div id="tab1" class="tab-pane fade in active">
									<div class="row">
										<div class="col-md-12">
											<div class="row">
												<!-- product -->
												@php
												$computers = App\Models\Product::where('subcategory_id' , 7)->get();	
												@endphp
												@foreach ($computers as $computer)
												<div class="col-md-4 col-xs-6">
													<div class="product">
														<div class="product-img">
															<img src="{{$computer->photo}}" alt="">
															<div class="product-label">
																@if ($computer->discount && $computer->discount->discount > 0 )
																	<span class="sale">-{{$computer->discount->discount}}%</span>
																@endif
															</div>
														</div>
														<div class="product-body">
															<p class="product-category">Computer</p>
															<h3 class="product-name"><a href="{{route('frontend.product' ,$computer->id)}}">{{$computer->name}}</a></h3>

															@if ($computer->discount && $computer->discount->discount > 0 )
																<h4 class="product-price">${{number_format($computer->price - ($computer->discount->discount/100 *$computer->price),2)}} <del class="product-old-price">${{number_format($computer->price,2)}}</del></h4>
															@else
																<h4 class="product-price">${{number_format($computer->price,2)}} </h4>
															@endif
															
															<div class="product-rating">
															</div>
															<div class="product-btns">
																<button class="add-to-wishlist product_fav" data-product-id="{{$computer->id}}">
																	<i class="fa fa-heart-o"></i>
																	<span class="tooltipp">add to wishlist</span>
																</button>
																<button class="add-to-compare" data-id="{{$computer->id}}">
																	<i class="fa fa-exchange"></i>
																	<span class="tooltipp">add to compare</span>
																</button>
																<button onclick="window.location.href='{{ route('frontend.product', $computer->id) }}'" class="quick-view">
																	<i class="fa fa-eye"></i>
																	<span class="tooltipp">quick view</span>
																</button>
															</div>
														</div>
														<div class="add-to-cart">
															<button class="add-to-cart-btn" data-id="{{$computer->id}}">
																<i class="fa fa-shopping-cart"></i> add to cart
															</button>
														</div>
													</div>
												</div>
												@endforeach
												<!-- /product -->
												<div class="clearfix visible-sm visible-xs"></div>
											</div>
										</div>
									</div>
								</div>
								<!-- /tab1  -->

								<!-- tab2  -->
								<div id="tab2" class="tab-pane fade in">
									<div class="row">
										<div class="col-md-12">
											<div class="row">

											<!-- product -->
												@php
												$laptops = App\Models\Product::where('subcategory_id' , 1)->get();	
												@endphp
												@foreach ($laptops as $laptop)
											<div class="col-md-3 col-xs-6">
												<div class="product">
													<div class="product-img">
														<img src="{{$laptop->photo}}" alt="">
														<div class="product-label">
															@if ($laptop->discount && $laptop->discount->discount > 0 )
															<span class="sale">-{{$laptop->discount->discount}}%</span>
															@endif
														</div>
													</div>
													<div class="product-body">
														<p class="product-category">Laptop</p>
														<h3 class="product-name"><a href="{{route('frontend.product' ,$laptop->id)}}">{{$laptop->name}}</a></h3>
														
														@if ($laptop->discount && $laptop->discount->discount > 0 )
															<h4 class="product-price">${{number_format($laptop->price - ($laptop->discount->discount/100 *$laptop->price),2,'.')}} <del class="product-old-price">${{number_format($laptop->price,2,'.')}}</del></h4>
														@else
															<h4 class="product-price">${{number_format($laptop->price,2,'.')}} </h4>
														@endif

														<div class="product-rating">
														</div>
														<div class="product-btns">
															<button class="add-to-wishlist product_fav" data-product-id="{{$laptop->id}}">
																<i class="fa fa-heart-o"></i>
																<span class="tooltipp">add to wishlist</span>
															</button>
															<button class="add-to-compare" data-id="{{$laptop->id}}">
																<i class="fa fa-exchange"></i>
																<span class="tooltipp">add to compare</span>
															</button>
															<button onclick="window.location.href='{{ route('frontend.product', $laptop->id) }}'" class="quick-view">
																<i class="fa fa-eye"></i>
																<span class="tooltipp">quick view</span>
															</button>
														</div>
													</div>
													<div class="add-to-cart">
														<button class="add-to-cart-btn" data-id="{{$laptop->id}}">
															<i class="fa fa-shopping-cart"></i> add to cart
														</button>
													</div>
												</div>
											</div>
											@endforeach
											<!-- /product -->
											<div class="clearfix visible-sm visible-xs"></div>
										</div>
										</div>
									</div>
								</div>
								<!-- /tab2  -->


								<!-- tab3  -->
								<div id="tab3" class="tab-pane fade in">
									<div class="row">
										<div class="col-md-12">
											<div class="row">

											<!-- product -->
												@php
												$tablets = App\Models\Product::where('subcategory_id' , 8)->get();	
												@endphp
												@foreach ($tablets as $tablet)
												<div class="col-md-3 col-xs-6">
													<div class="product">
														<div class="product-img">
															<img src="{{$tablet->photo}}" alt="">
															<div class="product-label">
																@if ($tablet->discount && $tablet->discount->discount > 0 )
																<span class="sale">-{{$tablet->discount->discount}}%</span>
																@endif
															</div>
														</div>
														<div class="product-body">
															<p class="product-category">Tablets</p>
															<h3 class="product-name"><a href="{{route('frontend.product' ,$tablet->id)}}">{{$tablet->name}}</a></h3>

															@if ($tablet->discount && $tablet->discount->discount > 0 )
																<h4 class="product-price">${{number_format($tablet->price - ($tablet->discount->discount/100 *$tablet->price),2,'.')}} <del class="product-old-price">${{number_format($tablet->price,2,'.')}}</del></h4>
															@else
																<h4 class="product-price">${{number_format($tablet->price,2,'.')}} </h4>
															@endif

															<div class="product-rating">
															</div>
															<div class="product-btns">
																<button class="add-to-wishlist product_fav" data-product-id="{{$tablet->id}}">
																	<i class="fa fa-heart-o"></i>
																	<span class="tooltipp">add to wishlist</span>
																</button>
																<button class="add-to-compare" data-id="{{$tablet->id}}">
																	<i class="fa fa-exchange"></i>
																	<span class="tooltipp">add to compare</span>
																</button>
																<button onclick="window.location.href='{{ route('frontend.product', $tablet->id) }}'" class="quick-view">
																	<i class="fa fa-eye"></i>
																	<span class="tooltipp">quick view</span>
																</button>
															</div>
														</div>
														<div class="add-to-cart">
															<button class="add-to-cart-btn" data-id="{{$tablet->id}}">
																<i class="fa fa-shopping-cart"></i> add to cart
															</button>
														</div>
													</div>
												</div>
												@endforeach
											<!-- /product -->
											<div class="clearfix visible-sm visible-xs"></div>
										</div>
										</div>
									</div>
								</div>
								<!-- /tab3  -->
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

					@foreach ($subcategories as $subcategory)
					@if($subcategory->products->count())
					<div class="col-md-3 col-xs-6">
						<div class="product">
							<div class="product-img">
								<img src="{{$subcategory->products->first()->photo}}" alt="">
								<div class="product-label">
									@if ($subcategory->products->first()->discount && $subcategory->products->first()->discount->discount > 0 )
										<span class="sale">-{{$subcategory->products->first()->discount->discount}}%</span>
									@endif
								</div>
							</div>
								<div class="product-body">
								<p class="product-category">{{$subcategory->name}}</p>
								<h3 class="product-name"><a href="{{route('frontend.product' ,$subcategory->products->first()->id)}}">{{$subcategory->products->first()->name}}</a></h3>
								@if ($subcategory->products->first()->discount && $subcategory->products->first()->discount->discount > 0)
									<h4 class="product-price">${{number_format($subcategory->products->first()->price - ($subcategory->products->first()->discount->discount/100 * $subcategory->products->first()->price),2)}}<del class="product-old-price">${{number_format($subcategory->products->first()->price,2)}}</del></h4>
								@else
									<h4 class="product-price">${{number_format($subcategory->products->first()->price,2)}}</h4>
								@endif
								<div class="product-rating">
								</div>
								<div class="product-btns">
									<button class="add-to-wishlist product_fav" data-product-id="{{$subcategory->products->first()->id}}">
										<i class="fa fa-heart-o"></i>
										<span class="tooltipp">add to wishlist</span>
									</button>
									<button class="add-to-compare" data-id="{{$subcategory->products->first()->id}}">
										<i class="fa fa-exchange"></i>
										<span class="tooltipp">add to compare</span>
									</button>
									<button onclick="window.location.href='{{ route('frontend.product', $subcategory->products->first()->id) }}'" class="quick-view">
										<i class="fa fa-eye"></i>
										<span class="tooltipp">quick view</span>
									</button>
								</div>
							</div>
							<div class="add-to-cart">
								<button class="add-to-cart-btn" data-id="{{$subcategory->products->first()->id}}">
									<i class="fa fa-shopping-cart"></i> add to cart
								</button>
							</div>
						</div>
					</div>
					@endif
					@endforeach
					<!-- /product -->
					<div class="clearfix visible-sm visible-xs"></div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /Section -->
@endsection		
@section('scripts')
	<script>
            @isset($products)
                var allProducts = @json($products);
            @else
                var allProducts = []; 
            @endisset

            @isset($discount)
                var globalDiscount = {{ $discount }};
            @else
                var globalDiscount = 0;
            @endisset

            $(document).ready(function() {
                $('#product-main-img').on('afterChange', function(event, slick, currentSlide) {
                    var product = allProducts[currentSlide];
                    if (!product) return;

                    $('.product-name').text(product.name);
                    $('.product-description').text(product.description || 'No description available');
                    
                    var currentPrice = parseFloat(product.price).toFixed(2);
                    var oldPrice = (parseFloat(product.price) + (parseFloat(product.price) * globalDiscount)).toFixed(2);
                    $('.product-price').html('$' + currentPrice + ' <del class="product-old-price">$' + oldPrice + '</del>');
                    
                    $('.add-to-cart-btn').first().attr('data-id', product.id);
                    $('.add-to-wishlist').first().attr('data-product-id', product.id);
                });
            });
        </script>
@endsection