		<!-- FOOTER -->
		<footer id="footer"  >
			<!-- top footer -->
			<div class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title"><b>About Us</b></h3>
								@php
									$aboutus =\App\Models\AboutUs::first();
								@endphp
								<p>{{ $aboutus->description ?? '' }}</p>
								<br>
								<ul class="footer-links">
									<li style="color: rgb(174, 164, 164); list-style: none;">
										<i class="fa fa-map-marker"></i><b>{{ $aboutus->address ?? '' }}</b>
									</li>									
									<li style="color: rgb(174, 164, 164); list-style: none; margin-right: 15px;">
										<i class="fa fa-phone"></i><b>{{ $aboutus->phone ?? '' }}</b>
									</li>
									<li style="color: rgb(174, 164, 164); list-style: none; margin-right: 15px;">
										<i class="fa fa-envelope-o"></i><b>{{ $aboutus->email ?? '' }}</b>
									</li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title"><b>Categories</b></h3>
								<ul class="footer-links">
									<li><a href="{{route('frontend.computerdevices')}}">ComputerDevices</a></li>
									<li><a href="{{route('frontend.smartphones')}}">SmartpPhones</a></li>
									<li><a href="{{route('frontend.cameras')}}">Cameras</a></li>
									<li><a href="{{route('frontend.homeelectronics')}}">HomeElectronics</a></li>
									<li><a href="{{route('frontend.accessories')}}">Accessories</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title"><b>Service</b></h3>
								<ul class="footer-links">
									<li><a href="{{route('profile.show')}}">My Account</a></li>
									<li><a href="{{route('frontend.cart')}}">View Cart</a></li>
									<li><a href="{{route('wishlist')}}">Wishlist</a></li>
									<li><a href="{{route('compare.index')}}">Compare</a></li>
									<li><a href="{{route('frontend.store')}}">Store</a></li>
								</ul>
							</div>
						</div>
						<div class="clearfix visible-xs"></div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title"><b>Information</b></h3>
								<ul class="footer-links">
									<li><a href="{{route('help')}}">Help</a></li>
									<li><a href="{{route('aboutus.page')}}">About Us</a></li>
									<li><a href="{{route('contactus')}}">Contact Us</a></li>
									<li><a href="{{route('privacy_policy')}}">Privacy Policy</a></li>
									<li><a href="{{route('orders_and_returns')}}">Orders & Returns</a></li>
									<li><a href="{{route('terms_and_conditions')}}">Terms & Conditions</a></li>
								</ul>
							</div>
						</div>

					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /top footer -->

			<!-- bottom footer -->
			<div id="bottom-footer" class="section">
				<div class="container">
					<div class="row">
						<div class="col-md-12 text-center">
							<ul class="footer-payments">
								<li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
								<li><a href="#"><i class="fa fa-credit-card"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
							</ul>
						</div>
					</div>
						<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /bottom footer -->
		</footer>
		<!-- /FOOTER -->
            <!-- Footer (Optional, if needed) -->
            <footer class="bg-gray-200 text-center py-4">
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            </footer>