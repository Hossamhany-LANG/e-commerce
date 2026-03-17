@extends('layouts.app')
@section('title', 'HomeElectronics')
@section('content')
		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumb-tree">
							<li>TV</li>
							<li>Radio</li>
							<li>AirConditioner</li>
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
						<div id="product-main-img">
							@foreach ($products as $product)
							<div class="product-preview">
								<img src="{{$product->photo}}" alt="">
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
								<li class="active"><a data-toggle="tab" href="#tab1">TV</a></li>
								<li><a data-toggle="tab" href="#tab2">Radio</a></li>
								<li><a data-toggle="tab" href="#tab3">AirConditioner</a></li>
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
												$tvs = App\Models\Product::where('subcategory_id' , 14)->get();	
												@endphp
												@foreach ($tvs as $tv)
												<div class="col-md-4 col-xs-6">
													<div class="product">
														<div class="product-img">
																<img src="{{$tv->photo}}" alt="">
															<div class="product-label">
																@if ($tv->discount && $tv->discount->discount > 0 )
																	<span class="sale">-{{$tv->discount->discount}}%</span>
																@endif
															</div>
														</div>
														<div class="product-body">
															<p class="product-category">TV</p>
															<h3 class="product-name"><a href="{{route('frontend.product' ,$tv->id)}}">{{$tv->name}}</a></h3>
															@if ($tv->discount && $tv->discount->discount > 0 )
																<h4 class="product-price">${{number_format($tv->price - ($tv->discount->discount/100 *$tv->price),2)}} <del class="product-old-price">${{number_format($tv->price,2)}}</del></h4>
															@else
																<h4 class="product-price">${{number_format($tv->price,2)}} </h4>
															@endif															
															<div class="product-rating">
															</div>
															<div class="product-btns">
																<button class="add-to-wishlist product_fav" data-product-id="{{$tv->id}}">
																	<i class="fa fa-heart-o"></i>
																	<span class="tooltipp">add to wishlist</span>
																</button>
																<button class="add-to-compare" data-id="{{$tv->id}}">
																	<i class="fa fa-exchange"></i>
																	<span class="tooltipp">add to compare</span>
																</button>
																<button onclick="window.location.href='{{ route('frontend.product', $tv->id) }}'" class="quick-view">
																	<i class="fa fa-eye"></i>
																	<span class="tooltipp">quick view</span>
																</button>
															</div>
														</div>
														<div class="add-to-cart">
															<button class="add-to-cart-btn" data-id="{{$tv->id}}">
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
												$radios = App\Models\Product::where('subcategory_id' , 15)->get();	
												@endphp
												@foreach ($radios as $radio)
											<div class="col-md-3 col-xs-6">
												<div class="product">
													<div class="product-img">
														<img src="{{$radio->photo}}" alt="">
														<div class="product-label">
															@if ($radio->discount && $radio->discount->discount > 0 )
																<span class="sale">-{{$radio->discount->discount}}%</span>
															@endif
														</div>
													</div>
													<div class="product-body">
														<p class="product-category">Radio</p>
														<h3 class="product-name"><a href="{{route('frontend.product' ,$radio->id)}}">{{$radio->name}}</a></h3>
														@if ($radio->discount && $radio->discount->discount > 0 )
															<h4 class="product-price">${{number_format($radio->price - ($radio->discount->discount/100 *$radio->price),2)}} <del class="product-old-price">${{number_format($radio->price,2)}}</del></h4>
														@else
															<h4 class="product-price">${{number_format($radio->price,2)}} </h4>
														@endif														
														<div class="product-rating">
														</div>
														<div class="product-btns">
															<button class="add-to-wishlist product_fav" data-product-id="{{$radio->id}}">
																<i class="fa fa-heart-o"></i>
																<span class="tooltipp">add to wishlist</span>
															</button>
															<button class="add-to-compare" data-id="{{$radio->id}}">
																<i class="fa fa-exchange"></i>
																<span class="tooltipp">add to compare</span>
															</button>
															<button onclick="window.location.href='{{ route('frontend.product', $radio->id) }}'" class="quick-view">
																<i class="fa fa-eye"></i>
																<span class="tooltipp">quick view</span>
															</button>
														</div>
													</div>
													<div class="add-to-cart">
														<button class="add-to-cart-btn" data-id="{{$radio->id}}">
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
												$airconditioners = App\Models\Product::where('subcategory_id' , 16)->get();	
												@endphp
												@foreach ($airconditioners as $airconditioner)
												<div class="col-md-3 col-xs-6">
													<div class="product">
														<div class="product-img">
																<img src="{{$airconditioner->photo}}" alt="">
															<div class="product-label">
																@if ($airconditioner->discount && $airconditioner->discount->discount > 0 )
																	<span class="sale">-{{$airconditioner->discount->discount}}%</span>
																@endif
															</div>
														</div>
														<div class="product-body">
															<p class="product-category">AirConditioner</p>
															<h3 class="product-name"><a href="{{route('frontend.product' ,$airconditioner->id)}}">{{$airconditioner->name}}</a></h3>
															
															@if ($airconditioner->discount && $airconditioner->discount->discount > 0 )
																<h4 class="product-price">${{number_format($airconditioner->price - ($airconditioner->discount->discount/100 *$airconditioner->price),2)}} <del class="product-old-price">${{number_format($airconditioner->price,2)}}</del></h4>
															@else
																<h4 class="product-price">${{number_format($airconditioner->price,2)}} </h4>
															@endif		

															<div class="product-rating">
															</div>
															<div class="product-btns">
																<button class="add-to-wishlist product_fav" data-product-id="{{$airconditioner->id}}">
																	<i class="fa fa-heart-o"></i>
																	<span class="tooltipp">add to wishlist</span>
																</button>
																<button class="add-to-compare" data-id="{{$airconditioner->id}}">
																	<i class="fa fa-exchange"></i>
																	<span class="tooltipp">add to compare</span>
																</button>
																<button onclick="window.location.href='{{ route('frontend.product', $airconditioner->id) }}'" class="quick-view">
																	<i class="fa fa-eye"></i>
																	<span class="tooltipp">quick view</span>
																</button>
															</div>
														</div>
														<div class="add-to-cart">
															<button class="add-to-cart-btn" data-id="{{$airconditioner->id}}">
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
