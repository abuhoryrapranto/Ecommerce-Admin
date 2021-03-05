@extends('structure.admin_structure')
@section('title', 'Active Products')
@section('page_header', 'Active Products')
@section('add_button')
<a  class="btn btn-outline-success btn-sm" href="{{url('/product/add-new')}}">
Add New
</a>
@endsection
@section('content')
@if (Session::has('msg'))
<div class="alert alert-success" id="msg" role="alert">
	{{ Session::get('msg') }}
</div>
@endif
<div class="row">
	@if(count($products) > 0)
		@foreach($products as $row)
		<div class="col-md-2">
			<div class="card pd-action" data-pdname="{{$row['name']}}" data-brand="{{$row['brand']}}" data-type="{{$row['type']}}" data-subType="{{$row['sub_type']}}" data-mainPrice="{{$row['main_price']}}" data-offerPrice="{{$row['offer_price']}}" data-featureimage="{{$row['feature_images']}}" data-options="{{$row['options']}}" data-description="{{$row['description']}}" data-toggle="modal" data-target="#productDetailsModal" style="cursor: pointer;">
				<img class="card-img-top" src="{{$row['thumbnail'] ? asset('thumbnail/'.$row['thumbnail']) : asset('dist/img/noimage.png')}}" alt="product image" height="200">
				<div class="card-body">
					<div class="text-gray">
						<b>{{$row['name']}}</b>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	@else
		<h5>No Active Products Found!</h5>
	@endif
</div>

<!-- Product Details -->
<div class="modal" id="productDetailsModal" tabindex="-1" role="dialog" aria-labelledby="productDetailsModalTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
	  <div class="modal-content">
		<div class="modal-header">
		  <b class="modal-title text-gray" id="pd_name"></b>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
			<div class="featureImages">
			</div>
			<br>
			<div class="row">
				<div class="col-md-4">
					<div class="info text-gray">
						<p><b>Brand: </b><span id="brandName"></span></p>
						<p><b>Type: </b><span id="typeName"></span></p>
						<p><b>Subtype: </b><span id="subTypeName"></span></p>
					</div>
				</div>
				<div class="col-md-4 text-gray">
					<p><b>Main Price: </b><span id="mainPrice"></span></p>
					<p><b>Offer Price: </b><span id="offerPrice"></span></p>
				</div>
				<div class="col-md-4 text-gray">
					<p><b>Colors: </b><span id="colors"></span></p>
					<p><b>Sizes: </b><span id="sizes"></span></p>
					<p><b>Weight: </b><span id="weight"></span></p>
				</div>
			</div>
			<div class="text-gray">
				<h6><b>Description:</b></h6>
				<p id="description"></p>
			</div>
		</div>
		<div class="pb-3 text-center">
			<div class="btn-group text-white" role="group" aria-label="Second group">
				<a class="btn btn-sm btn-info">Edit</a>
				<a class="btn btn-sm btn-primary">Publish</a>
			</div>
		</div>
	  </div>
	</div>
  </div>

  <script>
	  $(document).ready(function() {
		$('[data-toggle="tooltip"]').tooltip(); 
		$('.pd-action').click(function() {
			$('.imgData').remove();

			let pd_name = $(this).attr('data-pdname');
			let pd_brand = $(this).attr('data-brand');
			let pd_type = $(this).attr('data-type');
			let pd_sub_type = $(this).attr('data-subType');
			let main_price = $(this).attr('data-mainPrice');
			let offer_price = $(this).attr('data-offerPrice');
			let featureImages = $(this).attr('data-featureimage');
			let options = $(this).attr('data-options');
			let description = $(this).attr('data-description');

			$('#pd_name').html(pd_name);
			$('#brandName').html(pd_brand);
			$('#typeName').html(pd_type);
			$('#mainPrice').html(main_price);
			$('#description').html(description);

			if(!offer_price) {
				$('#offerPrice').html('Not Available');
			} else {
				$('#offerPrice').html(offer_price);
			}
			let data = JSON.parse(featureImages);
			let directory = "{{asset('/products/')}}";
			data.forEach(element => {
				let img = directory+'/'+element.url;
				let htmlTag = '<img class="imgData ml-2" src="'+img+'" data-toggle="tooltip" title="'+element.color+'" height="100">';
				$('.featureImages').append(htmlTag);
			});

			let optionsData = JSON.parse(options);
			optionsData.forEach(element => {
				let colors = element.color;
				let sizes = element.size;
				let weight = element.weight;
				if(!colors) {
					$('#colors').html('Not Available');
				}
				else {
					$('#colors').html(colors);
				}

				if(!sizes) {
					$('#sizes').html('Not Available');
				}

				else {
					$('#sizes').html(sizes);
				}

				if(!weight) {
					$('#weight').html('Not Available');
				}

				else {
					$('#weight').html(weight);
				}
			});
			
		})
	  })
  </script>
@endsection