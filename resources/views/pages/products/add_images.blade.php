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
					<input class="mt-3" type="file" name="">
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-8">
		<div class="card">
			<h5 class="pt-2 pb-1 text-center text-gray">Feature Images</h5>
		</div>
		<div class="card">
			<div class="card-body feature-images">
				<div class="text-center" id="addMoreBtn" style="display: none;">
					<button class="btn -btn-sm btn-primary">Add More!</button>
				</div>
				<div class="singleImage">
					<input type="file" name="" id="featureImage">
					<div class="form-group">
						<label>If Image have any color info (optional)</label>
						<input class="form-control"  type="text" name="">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#featureImage').on('input',function(e){
		 	$('#addMoreBtn').css({'display': 'block'});
		});

		$('#addMoreBtn').on('click', function(e) {

			var html = '<div class="singleImage"><input type="file" name="" id="featureImage"><div class="form-group"><label>If Image have any color info (optional)</label><input class="form-control"  type="text" name=""></div></div>';

			$('.feature-images').append(html);
		})
	})
</script>
@endsection