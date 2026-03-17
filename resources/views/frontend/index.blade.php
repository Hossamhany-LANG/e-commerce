@extends('layouts.app')
@section('title', 'TechZone')
@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- shop -->
					@php
    					$laptopSubcategory = $subcategories->firstWhere('id', 1);
					@endphp
					<div class="col-md-4 col-xs-6">
						<div class="shop">
								<img src="{{ $laptopSubcategory->products->first()->photo }}" alt="">
							<div class="shop-body">
								<h3>Laptop<br>Collection</h3>
								<a href="{{route('frontend.computerdevices')}}" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- /shop -->

					<!-- shop -->
					@php
    					$accessoriesSubcategory = $subcategories->firstWhere('id', 18);
					@endphp
					<div class="col-md-4 col-xs-6">
						<div class="shop">
								<img src="{{ $accessoriesSubcategory->products->first()->photo }}" alt="">
							<div class="shop-body">
								<h3>Accessories<br>Collection</h3>
								<a href="{{route('frontend.accessories')}}" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- /shop -->

					<!-- shop -->
					@php
    					$cameraSubcategory = $subcategories->firstWhere('id', 12);
					@endphp
					<div class="col-md-4 col-xs-6">
						<div class="shop">
								<img src="{{ $cameraSubcategory->products->first()->photo }}" alt="">
							<div class="shop-body">
								<h3>Cameras<br>Collection</h3>
								<a href="{{route('frontend.cameras')}}" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- /shop -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title"><b>New Products</b></h3>
							<div class="section-nav">
								<ul class="section-tab-nav tab-nav">
									<li class="active"><a  href="{{ route('frontend.computerdevices') }}">Laptops</a></li>
									<li><a href="{{route('frontend.smartphones')}}">Smartphones</a></li>
									<li><a href="{{route('frontend.cameras')}}">Cameras</a></li>
									<li><a href="{{route('frontend.accessories')}}">Accessories</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab1" class="tab-pane active">
									<div class="products-slick" data-nav="#slick-nav-1">
										<!-- product -->
										@foreach ($subcategories as $subcategory)
										@if($subcategory->products->count())
										<div class="product">
											<div class="product-img">
												<img src="{{$subcategory->products->first()->photo}}" alt="">
												<div class="product-label">
													<span class="sale">-{{$discount}}%</span>
													<span class="new">NEW</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category">{{$subcategory->name}}</p>
												<h3 class="product-name"><a href="{{route('frontend.product',$subcategory->products->first()->id)}}">{{$subcategory->products->first()->name}}</a></h3>
												<h4 class="product-price">${{number_format($subcategory->products->first()->price - ($discount/100 * $subcategory->products->first()->price),2)}} <del class="product-old-price">${{number_format($subcategory->products->first()->price,2)}}</del></h4>
												<hr>
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
										@endif
										@endforeach
										<!-- /product -->

									</div>
									<div id="slick-nav-1" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- HOT DEAL SECTION -->
		<div id="hot-deal" class="section">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="hot-deal">
							<ul class="hot-deal-countdown">
								<li>
									<div>
										<h3 id="days">00</h3>
										<span>Days</span>
									</div>
								</li>
								<li>
									<div>
										<h3 id="hours">00</h3>
										<span>Hours</span>
									</div>
								</li>
								<li>
									<div>
										<h3 id="minutes">00</h3>
										<span>Mins</span>
									</div>
								</li>
								<li>
									<div>
										<h3 id="seconds">00</h3>
										<span>Secs</span>
									</div>
								</li>
							</ul>

							<h2 id="deal-title" class="text-uppercase" style="color: rgb(255, 81, 0); font-weight: bold;">
								Monthly Mega Deal
							</h2>

							<p id="deal-text">Next month's first day will be full of gifts</p>
							<a id="deal-btn" class="primary-btn cta-btn" href="{{route('hot.deals')}}" style="display:none;">
								Click here to get 50% off all products
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- /HOT DEAL SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title"><b>Top selling</b></h3>
							<div class="section-nav">
								<ul class="section-tab-nav tab-nav">
									<li class="active"><a href="{{ route('frontend.computerdevices') }}">Laptops</a></li>
									<li><a href="{{ route('frontend.smartphones') }}">Smartphones</a></li>
									<li><a href="{{ route('frontend.cameras') }}">Cameras</a></li>
									<li><a href="{{ route('frontend.accessories') }}">Accessories</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab2" class="tab-pane fade in active">
									<div class="products-slick" data-nav="#slick-nav-2">
										<!-- product -->
										@foreach($bestSellingProducts1 as $item)
										<div class="product">
											<div class="product-img">
												<img src="{{ asset($item->product->photo) }}" alt="">
												<div class="product-label">
													<span class="sale">-{{$discount}}%</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category">{{ $item->product->subcategory->name }}</p>
												<h3 class="product-name"><a href="{{route('frontend.product',$item->product->id)}}">{{ $item->product->name }}</a></h3>
												<h4 class="product-price">${{ number_format($item->product->price - ($discount/100 * $item->product->price), 2) }}<del class="product-old-price">${{ number_format($item->product->price, 2) }}</del></h4>
												<p><b>Sales Volume : {{ $item->total_sold }}</b></p>
												<hr>
												<div class="product-btns">
													<button class="add-to-wishlist product_fav" data-product-id="{{$item->product->id}}">
														<i class="fa fa-heart-o"></i>
														<span class="tooltipp">add to wishlist</span>
													</button>
													<button class="add-to-compare" data-id="{{$item->product->id}}">
														<i class="fa fa-exchange"></i>
														<span class="tooltipp">add to compare</span>
													</button>
													<button onclick="window.location.href='{{ route('frontend.product', $item->product->id) }}'" class="quick-view">
														<i class="fa fa-eye"></i>
														<span class="tooltipp">quick view</span>
													</button>
												</div>
											</div>
											<div class="add-to-cart">
												<button class="add-to-cart-btn" data-id="{{$item->product->id}}">
													<i class="fa fa-shopping-cart"></i> add to cart
												</button>
											</div>
										</div>
										@endforeach
										<!-- /product -->
									</div>
									<div id="slick-nav-2" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- /Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">Top selling</h4>
							<div class="section-nav">
								<div id="slick-nav-3" class="products-slick-nav"></div>
							</div>
						</div>

						<div class="products-widget-slick" data-nav="#slick-nav-3">
							@foreach($topSellingWidgets->chunk(3) as $chunk)
								<div>
									@foreach($chunk as $item)
										<div class="product-widget">
											<div class="product-img">
												<img src="{{ asset($item->product->photo) }}" alt="">
											</div>
											<div class="product-body">
												<p class="product-category">{{ $item->product->subcategory->name }}</p>
												<h3 class="product-name"><a href="{{ route('frontend.product', $item->product->id) }}">{{ $item->product->name }}</a></h3>
												<h4 class="product-price">${{ number_format($item->product->price - ($discount/100 * $item->product->price), 2) }}<del class="product-old-price">${{ number_format($item->product->price, 2) }}</del></h4>
											</div>
										</div>
									@endforeach
								</div>
							@endforeach
						</div>
					</div>

					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">Top selling</h4>
							<div class="section-nav">
								<div id="slick-nav-4" class="products-slick-nav"></div>
							</div>
						</div>

						<div class="products-widget-slick" data-nav="#slick-nav-4">
							@foreach($topSellingWidgets->chunk(3) as $chunk)
								<div>
									@foreach($chunk as $item)
										<div class="product-widget">
											<div class="product-img">
												<img src="{{ asset($item->product->photo) }}" alt="">
											</div>
											<div class="product-body">
												<p class="product-category">{{ $item->product->subcategory->name }}</p>
												<h3 class="product-name"><a href="{{ route('frontend.product', $item->product->id) }}">{{ $item->product->name }}</a></h3>
												<h4 class="product-price">${{ number_format($item->product->price - ($discount/100 * $item->product->price), 2) }}<del class="product-old-price">${{ number_format($item->product->price, 2) }}</del></h4>
											</div>
										</div>
									@endforeach
								</div>
							@endforeach
						</div>
					</div>

					<div class="clearfix visible-sm visible-xs"></div>

					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">Top selling</h4>
							<div class="section-nav">
								<div id="slick-nav-5" class="products-slick-nav"></div>
							</div>
						</div>

						<div class="products-widget-slick" data-nav="#slick-nav-5">
							@foreach($topSellingWidgets->chunk(3) as $chunk)
								<div>
									@foreach($chunk as $item)
										<div class="product-widget">
											<div class="product-img">
												<img src="{{ asset($item->product->photo) }}" alt="">
											</div>
											<div class="product-body">
												<p class="product-category">{{ $item->product->subcategory->name }}</p>
												<h3 class="product-name"><a href="{{ route('frontend.product', $item->product->id) }}">{{ $item->product->name }}</a></h3>
												<h4 class="product-price">${{ number_format($item->product->price - ($discount/100 * $item->product->price), 2) }}<del class="product-old-price">${{ number_format($item->product->price, 2) }}</del></h4>
											</div>
										</div>
									@endforeach
								</div>
							@endforeach
						</div>
					</div>
				</div>

				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
@endsection

@section('scripts')
<script>
	function getNextMonthStart() {
		const now = new Date();
		const nextMonth = new Date(now.getFullYear(), now.getMonth() + 1, 1);
		nextMonth.setHours(0, 0, 0, 0);
		return nextMonth;
	}

	function getCurrentMonthStart() {
		const now = new Date();
		const currentMonthStart = new Date(now.getFullYear(), now.getMonth(), 1);
		currentMonthStart.setHours(0, 0, 0, 0);
		return currentMonthStart;
	}

	function getCurrentMonthEnd() {
		const now = new Date();
		const currentMonthEnd = new Date(now.getFullYear(), now.getMonth() + 1, 0);
		currentMonthEnd.setHours(23, 59, 59, 999);
		return currentMonthEnd;
	}

	let countdownDate = getNextMonthStart();

	function updateCountdown() {
	const now = new Date();

	// لو النهاردة هو أول يوم في الشهر
	if (now >= getCurrentMonthStart() && now <= getCurrentMonthEnd() && now.getDate() === 1) {
		document.getElementById("deal-title").innerText = "Special Offer!";
		document.getElementById("deal-text").innerText = "Enjoy 50% OFF on all products today!";
		document.getElementById("deal-btn").style.display = "inline-block";

		// وقف العد التنازلي
		document.getElementById("days").innerText = "00";
		document.getElementById("hours").innerText = "00";
		document.getElementById("minutes").innerText = "00";
		document.getElementById("seconds").innerText = "00";

		return;
	}

	// من يوم 2 يبدأ العد التنازلي لأول يوم في الشهر القادم
	const distance = countdownDate.getTime() - now.getTime();

	const days = Math.floor(distance / (1000 * 60 * 60 * 24));
	const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
	const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
	const seconds = Math.floor((distance % (1000 * 60)) / 1000);

	document.getElementById("days").innerText = String(days).padStart(2, '0');
	document.getElementById("hours").innerText = String(hours).padStart(2, '0');
	document.getElementById("minutes").innerText = String(minutes).padStart(2, '0');
	document.getElementById("seconds").innerText = String(seconds).padStart(2, '0');

	// لو خلص العد التنازلي → جهز العد الجديد للشهر اللي بعده
	if (distance <= 0) {
		countdownDate = getNextMonthStart();
	}
	}

	setInterval(updateCountdown, 1000);
</script>
@endsection
