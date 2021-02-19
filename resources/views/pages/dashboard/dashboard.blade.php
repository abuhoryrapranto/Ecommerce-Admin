@extends('structure.admin_structure')
@section('title', 'Dashboard')
@section('page_header', 'Dashboard')
@section('content')
@if (Session::has('msg'))
<div class="alert alert-success" id="msg" role="alert">
	{{ Session::get('msg') }}
</div>
@endif
<section class="content">
      <div class="container-fluid">
            
      </div>
    </section>
@endsection