@extends('layouts.app')

@section('content')

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>

</head>-->

<section id="slider">
	<!--slider-->
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div id="slider-carousel" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
						<li data-target="#slider-carousel" data-slide-to="1"></li>
						<li data-target="#slider-carousel" data-slide-to="2"></li>
					</ol>

					<div class="carousel-inner">
						<div class="item active">
							<div class="col-sm-6">
								<h1><span>WELCOME TO</span></h1>
								<h2>USTORA</h2>
								<p>What makes us different makes us great.</p>
								<button type="button" class="btn btn-default get">Shop Now</button>
							</div>
							<div class="col-sm-6">
								<img src="images/home/girl1.jpg" class="girl img-responsive" alt="" />
								<img src="images/home/pricing.png" class="pricing" alt="" />
							</div>
						</div>

						<div class="item">
							<div class="col-sm-6">
								<h1><span>WELCOME TO</span></h1>
								<h2>USTORA</h2>
								<p>What makes us different makes us great.</p>
								<button type="button" class="btn btn-default get">Shop Now</button>
							</div>
							<div class="col-sm-6">
								<img src="images/home/girl1.jpg" class="girl img-responsive" alt="" />
								<img src="images/home/pricing.png" class="pricing" alt="" />
							</div>
						</div>

					</div>

					<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
						<i class="fa fa-angle-left"></i>
					</a>
					<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
						<i class="fa fa-angle-right"></i>
					</a>
				</div>

			</div>
		</div>
	</div>
</section>
<!--/slider-->

<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<div class="left-sidebar">
					<h2>Category</h2>
					<div class="panel-group category-products" id="accordian">
						<!--category-productsr-->
						@foreach ($categories as $category)
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordian" href="#{{$category->title}}">
										<li><a href="/catagory/{{$category->title}}">{{$category->title}} </a></li>
									</a>
								</h4>
							</div>
							@if ($category->SubCategories->count() > 0)
							<div id="{{$category->title}}" class="panel-collapse collapse">
								<div class="panel-body">
									<ul>
										@foreach ($category->SubCategories as $subCategory)
										<li><a href="#">{{$subCategory->title}} </a></li>
										@endforeach
									</ul>
								</div>
							</div>
							@endif
						</div>
						@endforeach
					</div>
					<!--/category-products-->

					<div class="brands_products" style="display: none !important;">
						<!--brands_products-->
						<h2>Brands</h2>
						<div class="brands-name">
							<ul class="nav nav-pills nav-stacked">
								@foreach ($brands as $brand)
								<li><a href="#"> <span class="pull-right">({{$brand->products->count()}})</span>{{$brand->title}}</a></li>
								@endforeach
							</ul>
						</div>
					</div>
					<!--/brands_products-->
				</div>
			</div>

			<div class="col-sm-9 padding-right">
				<div class="features_items">
					<!--features_items-->
					<h2 class="title text-center">Features Items</h2>
					@foreach ($featured as $fProduct)
					<div class="col-sm-4">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="{{$fProduct->image_name}}" alt="" />
									<h2>${{$fProduct->sale_price}}</h2>
									<p>{{$fProduct->name}}</p>
									<add-to-cart product-id="{{$fProduct->id}}" user-id="{{auth()->user()->id ?? 0}}" />
								</div>
								<div class="product-overlay">
									<a href="/product/{{$fProduct->slug}}">
										<div class="overlay-content">
											<h2>${{$fProduct->sale_price}}</h2>
											<p>{{$fProduct->name}}</p>
											<add-to-cart product-id="{{$fProduct->id}}" user-id="{{auth()->user()->id ?? 0}}" />
										</div>
									</a>
								</div>
							</div>
							<div class="choose">
								<ul class="nav nav-pills nav-justified">
									<!-- <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li> -->
								</ul>
							</div>
						</div>
					</div>
					@endforeach


				</div>
				<!--features_items-->

				@foreach ($pageCategories as $pageCategory)
				<div class="category-tab">
					<!--category-tab-->
					<div class="col-sm-12">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tshirt" data-toggle="tab">{{$pageCategory->title}}</a></li>
						</ul>
					</div>
					<div class="tab-content">
						<div class="tab-pane fade active in" id="tshirt">
							@foreach ($pageCategory->products as $pageProductCategory)
							@foreach ( $pageProductCategory->products as $eachProduct)
							<div class="col-sm-3">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
											<a href="/product/{{$eachProduct->slug}}">
												<img src="{{$eachProduct->image_name}}" alt="" />
											</a>
											<h2>${{$eachProduct->sale_price}}</h2>
											<p>{{$eachProduct->name}}</p>
											<add-to-cart product-id="{{$fProduct->id}}" user-id="{{auth()->user()->id ?? 0}}" />
										</div>
									</div>
								</div>
							</div>
							@endforeach

							@endforeach
						</div>
					</div>
				</div>
				<!--/category-tab-->
				@endforeach
				<div class="d-none" style="display: none;">
					<!--recommended_items-->
					<h2 class="title text-center">recommended items</h2>
					<div class="recommendedCarousel">
						@foreach ($recommended as $rProduct)
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="{{$fProduct->image_name}}" alt="" />
									<h2>${{$rProduct->sale_price}}</h2>
									<p>{{$rProduct->name}}</p>
									<add-to-cart product-id="{{$fProduct->id}}" user-id="{{auth()->user()->id ?? 0}}" />
								</div>
								<div class="product-overlay">
									<a href="/product/{{$rProduct->slug}}">
										<div class="overlay-content">
											<h2>${{$rProduct->sale_price}}</h2>
											<p>{{$rProduct->name}}</p>
											<add-to-cart product-id="{{$rProduct->id}}" user-id="{{auth()->user()->id ?? 0}}" />
										</div>
									</a>
								</div>
							</div>
							<div class="choose">
								<ul class="nav nav-pills nav-justified">
									<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
								</ul>
							</div>
						</div>
						@endforeach
					</div>
				</div>
				<!--/recommended_items-->

			</div>
		</div>
	</div>
</section>

@endsection
@section('scriptTag')


@endsection