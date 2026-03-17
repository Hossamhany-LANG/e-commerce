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
    <style>.product-img img {width: 100%;height: 300px;object-fit: contain ;}</style>

	@yield('styles')
	
    <!-- Laravel Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


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

            @if (!Request::is('login','register','password/reset','password/email'))
                @section('header')
                    @include('partial.frontend.header')
                @show
            @endif
            @if (!Request::is('login','register','password/reset','password/email'))
                        @include('partial.frontend.navbar')
                    @endif
            
		
            <!-- Page Content -->
                <main class="py-4">
                    @yield('content')
                    @if (!Request::is('login','register','password/reset','password/email'))
                        @include('partial.frontend.newsletter')
                    @endif
                </main>

				@if (!Request::is('login','register','password/reset','password/email'))
                    @include('partial.frontend.footer')
                @endif
        </div>

        <!-- External Scripts -->
		<script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
        <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
        <script src="{{ asset('frontend/js/nouislider.min.js') }}"></script>
        <script src="{{ asset('frontend/js/jquery.zoom.min.js') }}"></script>
        <script src="{{ asset('frontend/js/main.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script> 
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>

        @yield('scripts')

        <script>
        $(document).ready(function() {

            $('.add-to-cart-btn').on('click', function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();
                let productId = $(this).data('id');
                let button = $(this);
                $.ajax({
                    url: "{{ route('cart.Add') }}",
                    method: "POST",
                    data: { product_id: productId, from_hotdeals: false },
                    success: function(response) {
                        Swal.fire('Done!', response.message, 'success');
                    },
                    error: function(xhr) {
                        if(xhr.status === 409) Swal.fire('warning', xhr.responseJSON.message, 'info');
                        else Swal.fire('Error', 'An error occurred.', 'error');
                    }
                });
            });

            $('.add-to-wishlist').on('click', function(e) {
                e.preventDefault();
                let productId = $(this).data('product-id');
                let url = "{{ url('/add_wishlist') }}/" + productId;
                $.ajax({
                    url: url,
                    method: "POST",
                    data: { from_hotdeals: false },
                    success: function(response) {
                        Swal.fire('Done!', response.message, 'success');
                        $(e.target).closest('button').find('i').removeClass('fa-heart-o').addClass('fa-heart');
                    },
                    error: function(xhr) {
                        if(xhr.status === 409) Swal.fire('warning', xhr.responseJSON.message, 'info');
                    }
                });
            });

            $('.add-to-compare').on('click', function(e) {
                e.preventDefault();
                let productId = $(this).data('id');
                $.ajax({
                    url: "/add-to-compare/" + productId,
                    method: "POST",
                    success: function(response) {
                        Swal.fire('Done!', 'Product added to comparison list', 'success');
                    },
                    error: function(xhr) {
                        Swal.fire('Info', 'Product already in comparison or comparison is full of products', 'info');
                    }
                });
            });

            const $mainSlider = $('#product-main-img');
            if ($mainSlider.length > 0 && typeof allProducts !== 'undefined') {
                $mainSlider.on('afterChange', function(event, slick, currentSlide) {
                    const product = allProducts[currentSlide];
                    if (!product) return;

                    $('.product-details').css('opacity', '0.5');
                    setTimeout(() => {
                        $('.product-name').text(product.name);
                        
                        let priceHTML = `${product.price} EGP`;
                        if(product.old_price) {
                            priceHTML += ` <del class="product-old-price">${product.old_price} EGP</del>`;
                        }
                        $('.product-price').first().html(priceHTML);
                        $('.product-details p').first().text(product.description || '');

                        $('.add-to-cart-btn').data('id', product.id).attr('data-id', product.id);
                        $('.add-to-wishlist').data('product-id', product.id).attr('data-product-id', product.id);
                        $('.add-to-compare').data('id', product.id).attr('data-id', product.id);

                        $('.product-details').css('opacity', '1');
                    }, 100);
                });
            }
        });
        </script>
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
    </body>
</html>
