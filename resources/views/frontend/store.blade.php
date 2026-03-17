@extends('layouts.app')
@section('title', 'Shop')
@section('content')
		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- ASIDE -->
					<div id="aside" class="col-md-3">
						<!-- aside Widget -->
						<form method="GET" action="{{ route('frontend.store') }}">
							<div class="aside">
								<h3 class="aside-title"><b>Categories</b></h3>
								<div class="checkbox-filter">
									@foreach($subcategories as $subcategory)
										<div class="input-checkbox ms-3">
											<input type="checkbox" name="subcategories[]" value="{{ $subcategory->id }}" id="subcategory-{{ $subcategory->id }}"
												{{ in_array($subcategory->id, request('subcategories', [])) ? 'checked' : '' }}>
											<label for="subcategory-{{ $subcategory->id }}">
												<span></span>
												{{ $subcategory->name }}
												<small>({{ $subcategory->products->count() }})</small>
											</label>
										</div>
									@endforeach
								</div>
							</div>

							<div class="aside">
								<h3 class="aside-title"><b>Price</b></h3>
								<div class="price-filter">
									<div class="input-number price-min">
										<input id="price-min" type="number" name="min_price" value="{{ request('min_price') }}">
										<span class="qty-up">+</span>
										<span class="qty-down">-</span>
									</div>
									<span>-</span>
									<div class="input-number price-max">
										<input id="price-max" type="number" name="max_price" value="{{ request('max_price') }}">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
									</div>
								</div>
							</div>

							<div class="aside mt-3">
								<button type="submit" class="btn btn-primary w-100">Apply Filters</button>
							</div>
						</form>

						<!-- /aside Widget -->

						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title"><b>Top selling</b></h3>
							@forelse ($bestSellingProducts as $bestSellingProduct)
							@php
								$basePrice = $bestSellingProduct->product->price;
								if ($bestSellingProduct->product->discount && $bestSellingProduct->product->discount->discount > 0) {
									$finalPrice = $basePrice - ($bestSellingProduct->product->discount->discount/100 * $basePrice);
								} else {
									$finalPrice = $basePrice;
								}
							@endphp
								<div class="product-widget">
								<div class="product-img">
									<img src="{{asset($bestSellingProduct->product->photo)}}" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">{{$bestSellingProduct->product->subcategory->name}}</p>
									<h3 class="product-name"><a href="{{ route('frontend.product', $bestSellingProduct->product->id) }}">{{$bestSellingProduct->product->name}}</a></h3>
									<h4 class="product-price">$ {{number_format($finalPrice ,2)}}
								</div>
							</div>
							@empty
								No Products Sold Yet
							@endforelse
						</div>
						<!-- /aside Widget -->
					</div>
					<!-- /ASIDE -->

					<!-- STORE -->
					<div id="store" class="col-md-9">

						<!-- store products -->
						<div class="row">
							@forelse($products as $product)
							@php
								$basePrice = $product->price;
								if ($product->discount && $product->discount->discount > 0) {
									$finalPrice = $basePrice - ($product->discount->discount/100 * $basePrice);
								} else {
									$finalPrice = $basePrice;
								}
							@endphp
								<div class="col-md-4 col-xs-6">
									<div class="product">
										<div class="product-img">
											<img src="{{ $product->photo }}" alt="{{ $product->name }}">
											<div class="product-label">
												@if($product->discount && $product->discount->discount > 0)
													<span class="sale">-{{ $product->discount->discount }}%</span>
												@endif
											</div>
										</div>
										<div class="product-body">
											<p class="product-category">{{ $product->subcategory->name }}</p>
											<h3 class="product-name">
												<a href="{{ route('frontend.product', $product->id) }}">{{ $product->name }}</a>
											</h3>
											<h4 class="product-price">
												{{ number_format($finalPrice, 2) }} EGP
											</h4>
											<div class="product-rating">
											</div>
											<div class="product-btns">
												<button class="add-to-wishlist product_fav" data-product-id="{{$product->id}}">
													<i class="fa fa-heart-o"></i>
													<span class="tooltipp">add to wishlist</span>
												</button>
												<button class="add-to-compare" data-id="{{$product->id}}">
													<i class="fa fa-exchange"></i>
													<span class="tooltipp">add to compare</span>
												</button>
												<button onclick="window.location.href='{{ route('frontend.product', $product->id) }}'" class="quick-view">
													<i class="fa fa-eye"></i>
													<span class="tooltipp">quick view</span>
												</button>
											</div>
										</div>
										<div class="add-to-cart">
											<button class="add-to-cart-btn" data-id="{{$product->id}}">
												<i class="fa fa-shopping-cart"></i> add to cart
											</button>
										</div>
									</div>
								</div>
							@empty
								<p>No products found</p>
							@endforelse
						</div>

						<!-- Pagination -->
						<div class="store-filter clearfix">
							<span class="store-qty">
								Showing {{ $products->firstItem() }}-{{ $products->lastItem() }} of {{ $products->total() }} products
							</span>
							{{ $products->links('pagination::bootstrap-4') }}
						</div>
						<!-- /store bottom filter -->
					</div>
					<!-- /STORE -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
@endsection