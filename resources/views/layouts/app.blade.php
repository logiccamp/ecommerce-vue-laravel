<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	@yield("styleSection")
	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="https://js.squareupsandbox.com/v2/paymentform"></script>
	<!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	<!-- Styles -->
	<!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
	<link href="/css/bootstrap.min.css" rel="stylesheet">
	<link href="/css/font-awesome.min.css" rel="stylesheet">
	<link href="/css/prettyPhoto.css" rel="stylesheet">
	<link href="/css/price-range.css" rel="stylesheet">
	<link href="/css/animate.css" rel="stylesheet">
	<link href="/css/main.css" rel="stylesheet">
	<link href="/css/responsive.css" rel="stylesheet">
	<link href="/dist/assets/owl.carousel.css" rel="stylesheet">
	<!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
	<link rel="shortcut icon" href="/images/ico/favicon.ico">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/images/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/images/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/images/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="/images/ico/apple-touch-icon-57-precomposed.png">
	<link rel="stylesheet" type="text/css" href="/slick/slick.css" />
	<link rel="stylesheet" type="text/css" href="/slick/slick-theme.css" />
</head>

<body>
	<div id="app">
		<header id="header">
			<!--header-->
			<div id="navbarTop">
				<div class="header-middle">
					<!--header-middle-->
					<div class="container">
						<div class="row">
							<div class="col-md-4 clearfix">
								<div class="logo pull-left">
									<a href="/">
										<h3 style="color: #0075be">USTORA</h3>
									</a>
								</div>

							</div>
							<div class="col-md-8 clearfix ">
								<div class="shop-menu clearfix pull-right">
									<ul class="nav navbar-nav">
										@if (Route::has('login'))
										@auth
										<li><a href=""><i class="fa fa-heart"></i> Wishlist</a></li>
										<li>
											<cart-items />
										</li>
										<li>
											<!-- <a href="" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>     -->
											<a href="{{ url('/account') }}"><i class="fa fa-user"></i> Account</a>
										</li>
										@else
										<li>
											<a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline"> <i class="fa fa-lock"></i>Login</a>
											<a href="{{ route('register') }}" class="text-sm text-gray-700 dark:text-gray-500 underline"> <i class="fa fa-lock"></i>Signup</a>
										</li>
										@endauth
										@endif
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--/header-middle-->
			</div>
			<div class="header-bottom ">
				<!--header-bottom-->
				<div class="container">
					<div class="row">
						<div class="col-sm-9">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</div>
							<div class="mainmenu pull-left">
								<ul class="nav navbar-nav collapse navbar-collapse">
									<li><a href="/" class="{{$home}}">Home</a></li>
									<li><a href="/shop" class="{{$shop}}">Shop</a></li>
									<li><a href="/account" class="{{$account}}">Account</a></li>
									<li><a href="/about" class="{{$about}}">About</a></li>
								</ul>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="search_box pull-right">
								<input type="text" placeholder="Search" />
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/header-bottom-->
		</header>
		<!--/header-->

		<main class="py-4">
			@yield('content')
		</main>



		<footer id="footer">
			<!--Footer-->
			<div class="footer-widget">
				<div class="container">
					<div class="row">
						<div class="col-sm-4">
							<div class="single-widget">
								<h2>Quick Links</h2>
								<ul class="nav nav-pills nav-stacked">
									<li><a href="/about">About Us</a></li>
									<li><a href="/contact-us">Contact Us</a></li>
									<li><a href="/account">Account</a></li>
									<li><a href="/shop">Shop</a></li>
								</ul>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="single-widget">
								<h2>Quick Shop</h2>
								<ul class="nav nav-pills nav-stacked">
									@for ($i = 0; $i < 4; $i++) <li><a href="/category/{{$categories[$i]->title}}">{{$categories[$i]->title}}</a></li>
										@endfor
								</ul>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="single-widget">
								<h2>Policies</h2>
								<ul class="nav nav-pills nav-stacked">
									<li><a href="/shipping-policy">Shipping Policy</a></li>
									<li><a href="/return-policy">Return Policy</a></li>
									<li><a href="/terms-and-condition">Terms and Condition</a></li>
								</ul>
							</div>
						</div>

					</div>
				</div>
			</div>

			<div class="footer-bottom">
				<div class="container">
					<div class="row">
						<p class="pull-left">Copyright © {{date('Y')}} USTORA. All rights reserved.</p>
					</div>
				</div>
			</div>

		</footer>
		<!--/Footer-->

	</div>
	<script src="/js/jquery.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script src="/js/jquery.scrollUp.min.js"></script>
	<script src="/js/price-range.js"></script>
	<script src="/js/jquery.prettyPhoto.js"></script>
	<script src="/js/main.js"></script>

	<script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript" src="/slick/slick.min.js"></script>
	<script src="/js/carousel.js"></script>

	@yield('scriptTag')
</body>

</html>