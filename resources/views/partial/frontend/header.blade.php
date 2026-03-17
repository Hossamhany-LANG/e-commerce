<!-- HEADER -->
		<header id="header">
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li style="color: white; list-style: none; display: inline-block; margin-right: 15px;">
							<i class="fa fa-phone"></i><b>{{ \App\Models\AboutUs::first()->phone ?? '' }}</b>
						</li>
						<li style="color: white; list-style: none; display: inline-block; margin-right: 15px;">
							<i class="fa fa-envelope-o"></i><b>{{ \App\Models\AboutUs::first()->email ?? '' }}</b>
						</li>
						<li style="color: white; list-style: none; display: inline-block;">
							<i class="fa fa-map-marker"></i><b>{{ \App\Models\AboutUs::first()->address ?? '' }}</b>
						</li>
					</ul>
					<ul class="header-links pull-right">
						<li style="color: rgb(236, 219, 219); list-style: none; display: inline-block;">
							<i class="fa fa-dollar"></i><b>USA</b>
						</li>	
						@guest
						<li class="nav-item">
							<a class="nav-link" href="{{route('login')}}">
								<i class="fas fa-user-alt mr-1 text-gray"></i>Login
							</a>
						</li>
							<li class="nav-item">
								<a class="nav-link" href="{{route('register')}}">
									<i class="fas fa-user-alt mr-1 text-gray"></i>Register
								</a>
							</li>
						@else
						<li class="nav-item dropdown">
							<a href="#" class="nav-link dropdown-toggle custom-dropdown" id="authDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-user-o"></i>
								Welcome, {{ auth()->user()->full_name }}
							</a>							
							<div class="dropdown-menu mt-3" aria-labelledby="authDropdown">
								<a href="{{route('profile.show')}}" class="dropdown-item border-0 ">My profile</a>
								<a href="javascript:void(0);" class="dropdown-item border-0"
								onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
								>Logout</a>
								<form action="{{route('logout')}}" method="POST" id="logout-form" class="d-none">
									@csrf
								</form>
							</div>
						</li>	
						@endguest
					</ul>
				</div>
			</div>  
			<div id="header">
				<div class="container">
					<div class="row">
						<div class="col-md-3">
							<div >
								<span class="main-title font-weight-bold text-uppercase text-white">
									<b>{{ \App\Models\AboutUs::first()->pagename ?? '' }}</b>
								</span>
								
							</div>
						</div>
						<div class="col-md-6">
							<div class="header-search">
								<form action="{{ route('search') }}" method="GET">
									<input class="input" type="text" name="query" placeholder="Search for products...">
									<button class="search-btn">Search</button>
								</form>
							</div>
						</div>

						@php
								$wishlist_Count = App\Models\WishList::forCurrentUser()->count();
						@endphp
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<div>
									<a href="{{route('wishlist')}}">
										<i class="fa fa-heart-o"></i>
										<span>Your Wishlist</span>
										<div class="qty">{{$wishlist_Count}}</div>
									</a>
								</div>
								<div>
									<a href="{{ route('compare.index') }}"> <i class="fa fa-exchange"></i> 
										<span>Compare</span> 
										<div class="qty">{{ App\Models\Comparison::forCurrentUser()->count() }}</div> 
									</a> 
								</div>
								@php
										$carts = App\Models\Cart::forCurrentUser()->get();
								@endphp
								<div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Your Cart</span>
										<div class="qty">{{$carts->count()}}</div>
									</a>
									<div class="cart-dropdown">
										@foreach ($carts as $cart)
										<div class="cart-list">
											<div class="cart-product-widget">
											<div class="cart-product-preview">
												<img src="{{ $cart->product->photo }}" alt="Product">
											</div>

											<div class="cart-product-body">
												<h3 class="product-name"><a href="{{ route('frontend.product', $cart->product->id) }}">{{ $cart->product->name }}</a></h3>
												<h4 class="product-price"><span class="qty">{{ $cart->quantity }} *</span> ${{number_format($cart->product->price,2)}}</h4>
											</div>

											</div>

										</div>
										<hr>
										@endforeach
										<div class="cart-summary">
											<small>{{$carts->count()}} Item(s) selected</small>
											<h5>SUBTOTAL: ${{ number_format($carts->sum(function($cart) {
												return $cart->product->price * $cart->quantity;})) }}</h5>
										</div>
										<div class="cart-btns">
											<a href="{{route('frontend.cart')}}">View Cart</a>
											<a href="{{route('frontend.checkout')}}">Checkout <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
								</div>
								<div>
									<a href="{{ route('frontend.store') }}">
										<i class="fa fa-shopping-bag"></i>
										<span>Shop</span>
									</a>
								</div>
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>
		<!-- /HEADER -->