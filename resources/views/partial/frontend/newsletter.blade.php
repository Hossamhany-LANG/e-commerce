		<!-- NEWSLETTER -->
		<div id="newsletter" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="newsletter">
							<p>Sign Up for the <strong>NEWSLETTER</strong></p>
							<form action="{{route('newsletter.subscribe')}}" method="POST">
								@csrf
								@method('PUT')
								<input class="input" type="email" name="email" placeholder="Enter Your Email">
								<button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
							</form>
                            @php
                                $links = App\Models\AboutUs::select('facebook','twitter','instagram','linkedin')->first();
                            @endphp
							<ul class="newsletter-follow">
								<li><a href="{{$links->facebook}}" target="_blank"><i class="fa fa-facebook"></i></a></li>
								<li><a href="{{$links->twitter}}" target="_blank"><i class="fa fa-twitter"></i></a></li>
								<li><a href="{{$links->instagram}}" target="_blank"><i class="fa fa-instagram"></i></a></li>
								<li><a href="{{$links->linkedin}}" target="_blank"><i class="fa fa-linkedin"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /NEWSLETTER -->