@extends('layouts.app')

@section('content')




<section>
	<div class="container">
		<div class="row">
			<div class="col-12 padding-right">
				<div class="product-details">
					<!--product-details-->
					<div class="col-sm-5">
						<div class="view-product">
							<img src="{{$product->image_name}}" alt="" />
						</div>
						<div id="similar-product" style="display: none;" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">
									<a href=""><img src="/images/product-details/similar1.jpg" alt=""></a>
									<a href=""><img src="/images/product-details/similar2.jpg" alt=""></a>
									<a href=""><img src="/images/product-details/similar3.jpg" alt=""></a>
									<a href=""><img src="/images/product-details/similar3.jpg" alt=""></a>
								</div>
							</div>
						</div>

					</div>
					<div class="col-sm-7">
						<div class="product-information">
							<!--/product-information-->
							<!-- <img src="{{$product->image_name}}" class="newarrival" alt="" /> -->
							<h2>{{$product->name}}</h2>
							<p>
								@foreach ($product->categories as $productCategory)
								<span style="margin: 0;">{{$productCategory->ProductCat->title}} </span>
								@endforeach
							</p>
							<span>
								<span>US ${{$product->sale_price}}</span>
							</span>
							<div class="d-flex flex-column">
								<img src="/images/product-details/rating.png" alt="" />
							</div>
							<p><b>Availability:</b> In Stock</p>

							<add-cart-button user-id="{{auth()->user()->id ?? 0}}"></add-cart-button>
							<!-- <add-to-cart product-id="{{$product->id}}" user-id="{{auth()->user()->id ?? 0}}" /> -->

							<div class="my-2">
								<p>
									<b>Description: <br /></b>
									{{$product->description}}
								</p>
							</div>
						</div>
						<!--/product-information-->
					</div>
				</div>
				<!--/product-details-->

				<div class="category-tab shop-details-tab">
					<!--category-tab-->
					<div class="col-sm-12">
						<ul class="nav nav-tabs">
							<li><a href="#details" data-toggle="tab">Details</a></li>
							<li class="active"><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
						</ul>
					</div>
					<div class="tab-content">
						<div class="tab-pane fade" id="details">
							<p>{{$product->description}}</p>

						</div>


						<div class="tab-pane fade active in" id="reviews">
							<div class="col-sm-12">
								<!-- <ul>
									<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
									<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
									<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
								</ul>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p> -->
								<p><b>Write Your Review</b></p>

								<form action="#">
									<span>
										<input type="text" placeholder="Your Name" />
										<input type="email" placeholder="Email Address" />
									</span>
									<textarea name=""></textarea>
									<b>Rating: </b> <img src="/images/product-details/rating.png" alt="" />
									<button type="button" class="btn btn-default pull-right">
										Submit
									</button>
								</form>
							</div>
						</div>

					</div>
				</div>
				<!--/category-tab-->

				<div class="recommended_items">
					<!--recommended_items-->
					<h2 class="title text-center">recommended items</h2>

					<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							<div class="item active">
								@foreach ($related as $rProduct)
								<div class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<a href="/product/{{$rProduct->slug}}">
													<img src="{{$rProduct->image_name}}" alt="" />
												</a>
												<h2>${{$rProduct->price}}</h2>
												<p>{{$rProduct->name}}</p>
												<add-to-cart product-id="{{$rProduct->id}}" user-id="{{auth()->user()->id ?? 0}}" />
											</div>
										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div>
						<a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
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