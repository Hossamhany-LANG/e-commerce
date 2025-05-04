<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Electro - HTML Ecommerce Template">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <title>@yield('title')</title>

 		<!-- Google font -->
																								
 		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
 		<link type="text/css" rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}"/>
 		<link type="text/css" rel="stylesheet" href="{{asset('frontend/css/slick.css')}}"/>
 		<link type="text/css" rel="stylesheet" href="{{asset('frontend/css/slick-theme.css')}}"/>
 		<link type="text/css" rel="stylesheet" href="{{asset('frontend/css/nouislider.min.css')}}"/>
 		<link rel="stylesheet" href="{{asset('frontend/css/font-awesome.min.css')}}">
 		<link type="text/css" rel="stylesheet" href="{{asset('frontend/css/style.css')}}"/>

   <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
   <!--[if lt IE 9]>
	 <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	 <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
   <![endif]-->

	@yield('styles')
	
    <!-- Laravel Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Responsive Design -->
    <!-- Add IE Support if required -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head>
  <body class="font-sans antialiased">
        <div id="app"  class="font-sans antialiased bg-white" style="scroll-behavior: smooth">
            <!-- Header Section -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

		@section('header')
				@include('partial.frontend.header')
		@show

		@include('partial.frontend.navbar')
		
            <!-- Page Content -->
                <main class="py-4">
                    @yield('content')
                </main>

				@include('partial.frontend.footer')
        </div>

        <!-- External Scripts -->
		<script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
		<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('frontend/js/slick.min.js') }}"></script>
		<script src="{{ asset('frontend/js/nouislider.min.js') }}"></script>
		<script src="{{ asset('frontend/js/jquery.zoom.min.js') }}"></script>
		<script src="{{ asset('frontend/js/main.js') }}"></script>
		
		<!-- Optional: Include any additional scripts here -->
		@yield('scripts')

    </body>
</html>
