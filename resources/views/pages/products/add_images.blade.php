@extends('structure.admin_structure')
@section('title', 'Add Images')
@section('page_header', 'Add Images')
@section('content')
@if (Session::has('msg'))
<div class="alert alert-success" id="msg" role="alert">
	{{ Session::get('msg') }}
</div>
@endif

@endsection