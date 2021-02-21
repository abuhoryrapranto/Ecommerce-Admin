@extends('structure.admin_structure')
@section('title', 'Brand')
@section('page_header', 'All Brands')
@section('add_button')
<button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#brandModal">
Add New
</button>
@endsection
@section('content')
<style>
    label{
        color: grey;
    }
    .dropdown-item:hover {
        color: black !important;
    }
    .table-responsive {
        display: table;
    }
</style>
@if (Session::has('msg'))
<div class="alert alert-success" id="msg" role="alert">
	{{ Session::get('msg') }}
</div>
@endif
<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @if(count($brands) > 0)
            @foreach($brands as $key => $row)
                <tr>
                    <th scope="row">{{$brands->firstItem() + $key}}</th>
                    <td>{{$row->name}}</td>
                    <td>{{$row->description}}</td>
                    <td>
                        @if($row->status == 1)
                        <span class="bg-success pl-2 pr-2 rounded">Active</span>
                        @else
                        <span class="bg-danger pl-2 pr-2 rounded">Deactive</span>
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Action
                            </button>
                            <div class="dropdown-menu bg-dark" aria-labelledby="dropdownMenuButton">
                                @if($row->status == 1)
                                    <a class="dropdown-item text-danger" href="{{url('setting/statuschange-brand/'.$row->id.'/0')}}">Deactive</a>
                                @else
                                    <a class="dropdown-item text-success" href="{{url('setting/statuschange-brand/'.$row->id.'/1')}}">Active</a>
                                @endif
                              
                              <a class="dropdown-item text-danger" href="{{url('setting/delete-brand/'.$row->id)}}">Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
          @else
                <p>No Brand Found!</p>
          @endif
        </tbody>
      </table>
      {{$brands->links()}}
</div>

<!-- Brand Modal -->
<div class="modal" id="brandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add Brand</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{url('setting/save-brand')}}" method="POST">
            {{csrf_field()}}
            <div class="form-group">
                @error('brand_name')
                  <small class="form-text text-danger">{{$message}}</small>
                @enderror
                <label>Brand Name</label>
                <input type="text" class="form-control" name="brand_name" placeholder="Enter Brand Name">
                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Description</label>
                  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="brand_description"></textarea>
                </div>
            </div>
            <button class="btn btn-sm btn-success pl-3 pr-3">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>


@if(count($errors) > 0)
<script>
$( document ).ready(function() {
$('#brandModal').modal('show');
});
</script>
@endif
@endsection