        		<!-- HEADER -->
		<header id="header">
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> email@email.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
					</ul>
					<ul class="header-links pull-right">
						<li><a href="#"><i class="fa fa-dollar"></i> USD</a></li>
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
								<a href="#" class="dropdown-item border-0 ">My profile</a>
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
									<b>{{ config('app.name') }}</b>
								</span>
								
							</div>
						</div>
						<div class="col-md-6">
							<div class="header-search">
								<form>
									<select class="input-select">
										<option value="0">All Categories</option>
										<option value="1">Category 01</option>
										<option value="2">Category 02</option>
									</select>
									<input class="input" placeholder="Search here">
									<button class="search-btn">Search</button>
								</form>
							</div>
						</div>
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<div>
									<a href="#">
										<i class="fa fa-heart-o"></i>
										<span>Your Wishlist</span>
										<div class="qty">2</div>
									</a>
								</div>
								<div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Your Cart</span>
										<div class="qty">3</div>
									</a>
									<div class="cart-dropdown">
										<div class="cart-list">
											<div class="product-widget">
												<div class="product-img">
													<img src="{{ asset('frontend/img/product01.png') }}" alt="Product">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#">Product Name</a></h3>
													<h4 class="product-price"><span class="qty">1x</span> $980.00</h4>
												</div>
												<button class="delete"><i class="fa fa-close"></i></button>
											</div>
										</div>
										<div class="cart-summary">
											<small>3 Item(s) selected</small>
											<h5>SUBTOTAL: $2940.00</h5>
										</div>
										<div class="cart-btns">
											<a href="#">View Cart</a>
											<a href="#">Checkout <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
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