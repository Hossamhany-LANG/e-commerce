		<!-- NAVIGATION -->
		<nav id="navigation">
			<div class="container">
				<div id="responsive-nav">
					<ul class="main-nav nav navbar-nav">
						<li class="{{ Request::is('/') ? 'active' : '' }}"><a href="/">Home</a></li>
						<li class="{{ Request::is('computerdevices') ? 'active' : '' }}"><a href="{{ route('frontend.computerdevices') }}">ComputerDevices</a></li>
						<li class="{{ Request::is('smartphones') ? 'active' : '' }}"><a href="{{ route('frontend.smartphones') }}">SmartPhones</a></li>
						<li class="{{ Request::is('cameras') ? 'active' : '' }}"><a href="{{ route('frontend.cameras') }}">Cameras</a></li>
						<li class="{{ Request::is('homeelectronics') ? 'active' : '' }}"><a href="{{ route('frontend.homeelectronics') }}">HomeElectronics</a></li>
						<li class="{{ Request::is('accessories') ? 'active' : '' }}"><a href="{{ route('frontend.accessories') }}">Accessories</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- /NAVIGATION -->   