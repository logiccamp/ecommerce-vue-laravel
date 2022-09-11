@extends('layouts.app')

@section("styleSection")
<link rel="stylesheet" href="/css/theme.css">
@endSection("styleSection")

@section('content')
<div class="container">
	<div class="p-5">
		<div class="container ">
			<div class="blog-post-area">
				<h2 class="title text-center">About Us</h2>
				<div class="single-blog-post">
					<a href="">
						<img src="images/blog/blog-one.jpg" alt="" style="height: 40vh; object-fit: cover">
					</a>
					<h3>
						Who We Are
					</h3>
					<p>
						Welcome to USTORA STORES, your number one source for all things Wears for both men and women, Electronics, Home and Kitchen appliances. We're dedicated to giving you the service.


						USTORA STORES has come a long way from its beginnings in [starting location]. USTORA STORES offer you the best prices and amazing discounts you can get in the market on all our products.

						We hope you enjoy our products as much as we enjoy selling the best and authentic products to all our customers across the country. If you have any questions or comments, please don't hesitate to contact us.
					</p>

				</div>
			</div>
			<!--/blog-post-area-->

		</div>
	</div>
</div>
@endsection
@section('scriptTag')

@endsection