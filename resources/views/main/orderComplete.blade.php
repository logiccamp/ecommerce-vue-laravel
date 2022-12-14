@extends('layouts.app')

@section("styleSection")
<link rel="stylesheet" href="/css/theme.css">
@endSection("styleSection")

@section('content')
<div class="container">
	<div class="p-5">
		<div class="container space-2 space-lg-3">
			<div class="w-md-80 w-lg-50 text-center mx-md-auto">
				<figure id="iconChecked" class="ie-height-90 max-width-11 mx-auto mb-3" style="">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 25.6 25.6" style="enable-background:new 0 0 25.6 25.6;" xml:space="preserve" class="injected-svg js-svg-injector" data-parent="#iconChecked">
						<style type="text/css">
							.checked-icon-0 {
								fill: #00C9A7;
							}
						</style>
						<path class="checked-icon-0 fill-success" d="M12.8,0C5.7,0,0,5.7,0,12.8s5.7,12.8,12.8,12.8s12.8-5.7,12.8-12.8S19.9,0,12.8,0z M19.5,8.8L12.7,19  c-0.2,0.3-0.5,0.5-0.8,0.5s-0.7-0.2-0.9-0.4l-4-4c-0.3-0.3-0.3-0.7,0-1l1-1c0.3-0.3,0.7-0.3,1,0l2.6,2.6l5.7-8.4  c0.2-0.3,0.7-0.4,1-0.2l1.2,0.8C19.7,8.1,19.8,8.5,19.5,8.8z"></path>
					</svg>
				</figure>
				<div class="mb-5">
					<h1 class="h3 font-weight-medium">Your order is completed!</h1>
					<p>Thank you for your order! Your order is being processed and will be completed within 3-6 hours. You will receive an email confirmation when your order is completed.</p>
				</div>
				<a class="btn btn-default btn-pill transition-3d-hover px-5" href="/home">Continue Shopping</a>
				<a class="btn btn-default btn-pill transition-3d-hover px-5" href="/orders">My Orders</a>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scriptTag')

@endsection