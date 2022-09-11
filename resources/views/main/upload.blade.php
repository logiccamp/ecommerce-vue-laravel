@extends('layouts.app')

@section("styleSection")
@endSection("styleSection")

@section('content')
<div class="container">
	<div class=" card p-5">
		<form action="{{route('uploadthis')}}" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="row">
				<div class="col-sm-6" style="margin: 10px auto;">
					<label for="">Title</label>
					<input type="text" class="form-control" name="title" id="title" />
				</div>

				<div class="col-sm-6" style="margin: 10px auto;">
					<label for="">Price</label>
					<input type="text" class="form-control" name="cp" id="cp" />
				</div>

				<div class="col-sm-6" style="margin: 10px auto;">
					<label for="">Sales Price</label>
					<input type="text" class="form-control" name="sp" id="sp" />
				</div>

				<div class="col-sm-6" style="margin: 10px auto;">
					<label for="">Categories</label> <br>
					@foreach ($categories as $category)
					<label for="{{$category->id}}">
						<input type="radio" name="categories" id="categories" value="{{$category->id}}" />
						{{$category->title}}
					</label>
					@endforeach
				</div>

				<div class="col-sm-12" style="margin: 10px auto;">
					<label for="">Description</label>
					<textarea name="description" id="description" cols="30" rows="10"></textarea>
				</div>

				<div class="col-sm-12" style="margin: 10px auto;">
					<label for="">Image</label>
					<input type="file" name="image" id="image" class="form-control">
				</div>

				<div class="col-sm-6" style="margin: 10px auto;">
					<button id="addProduct" class="btn btn-success" type="submit">Add Product</button>
				</div>
			</div>

		</form>
	</div>
</div>
@endsection
@section('scriptTag')
<script>

</script>
@endsection