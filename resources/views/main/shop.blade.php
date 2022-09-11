@extends('layouts.app')

@section('content')
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
										<li><a href="/category/{{$category->title}}">{{$category->title}} </a></li>
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
					<h2 class="title text-center">Shop</h2>
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

			</div>
		</div>
	</div>
</section>


@endsection
@section('scriptTag')

@endsection