@extends('structure.admin_structure')
@section('title', 'Add Images')
@section('page_header', 'Add Images')
@section('content')
@if (Session::has('msg'))
<div class="alert alert-success" id="msg" role="alert">
	{{ Session::get('msg') }}
</div>
@endif
<div class="row">
	
		<div class="col-md-4">
			<div class="card">
					<h5 class="pt-2 pb-1 text-center text-gray">Thumbnail</h5>
			</div>
			<div class="card">
				<div class="card-body">
					<div class="text-center">
						<img src="{{ asset('dist/img/avatar.png') }}">
						<br>
						<input class="mt-3" type="file" name="photo[][]">
						<input type="hidden" name="photo[][color]" id="">
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card">
				<h5 class="pt-2 pb-1 text-center text-gray">Feature Images</h5>
			</div>
			<div class="card">
				<div class="text-center" id="addMoreBtn" style="display: none;">
					<button type="button" class="btn btn-sm btn-primary">Add More!</button>
				</div>
				<form action="{{url('product/save-images')}}" method="POST" enctype="multipart/form-data">
					{{csrf_field()}}
				<div class="card-body feature-images">
					<div class="singleImage">
						<input type="file" name="photo[][name]" id="featureImage">
						<div class="form-group">
							<label>If Image have any color info (optional)</label>
							<input class="form-control"  type="text" name="photo[][color]">
						</div>
					</div>
				</div>
				<button type="submit" class="btn btn-sm btn-success ml-3 mb-3">Done</button>
			</form>
			</div>
		</div>

		
	
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#featureImage').on('input',function(e){
		 	$('#addMoreBtn').css({'display': 'block'});
		});

		$('#addMoreBtn').on('click', function(e) {

			var html = '<div class="singleImage"><input type="file" name="photo[][name]" id="featureImage"><div class="form-group"><label>If Image have any color info (optional)</label><input class="form-control"  type="text" name="photo[][color]"></div></div>';

			$('.feature-images').append(html);
		})
	})
</script>
@endsection