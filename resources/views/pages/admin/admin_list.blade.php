@extends('structure.admin_structure')
@section('title', 'Admin List')
@section('page_header', 'Admins')
@section('content')
@section('add_button')
<button type="button" class="btn  btn-sm btn-outline-success" data-toggle="modal" data-target="#exampleModalCenter">
  Add New
</button>
@endsection
@if (Session::has('msg'))
<div class="alert alert-success" id="msg" role="alert">
	{{ Session::get('msg') }}
</div>
@endif
<div class="row">
<div class="card-deck">
    @foreach($admins as $row)
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{asset('dist/img/avatar.png')}}" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title font-weight-bold">
                    {{$row->full_name}}
                    @if($row->status == 1)
                      <i class="fas fa-check text-success"></i>
                    @else
                        <i class="fas fa-times text-danger"></i>
                    @endif
                    </h5>
                  <br>
                  <div style="color: grey;">
                    <span>{{$row->email}}</span><br>
                    <span>0{{$row->phone}}</span><br>
                    <span>{{$row->is_super == 1 ? 'Super Admin' : 'General Admin'}}</span>
                  </div>
                  <div class="btn-group dropup float-right">
                    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Options
                    </button>
                    <div class="dropdown-menu">
                      <!-- Dropdown menu links -->
                      @if(Auth::guard('admin')->user()->id != $row->id && Auth::guard('admin')->user()->is_super == 1)
                        @if($row->status == 1)
                        <a class="dropdown-item font-weight-bold text-gray" href="{{url('/status-change/'.$row->id.'/0')}}"><i class="fas fa-times text-danger"></i> Deactive</a>
                        @else
                            <a class="dropdown-item font-weight-bold text-gray" href="{{url('/status-change/'.$row->id.'/1')}}"><i class="fas fa-check text-success"></i> Active</a>                       
                        @endif

                        @if($row->is_super == 1)
                        <a class="dropdown-item font-weight-bold text-gray" href="{{url('/super-change/'.$row->id.'/0')}}"><i class="fas fa-times text-danger"></i> Remove Super</a>
                        @else
                            <a class="dropdown-item font-weight-bold text-gray" href="{{url('/super-change/'.$row->id.'/1')}}"><i class="fas fa-check text-success"></i> Make Super</a>                       
                        @endif
                      @endif
                    </div>
                  </div>
                </div>
              </div>
    @endforeach
</div>
</div>

<!-- Modal -->
<div class="modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add New Admin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('save-admin')}}" method="POST">
          {{csrf_field()}}
          <div class="form-group">
            <label class="text-gray" for="">Full Name</label>
              <input type="text" class="form-control" name="full_name" value="{{old('full_name')}}" placeholder="Full Name">
              @error('full_name')
                <small class="form-text text-danger">{{$message}}</small>
              @enderror
          </div>
          <div class="form-group">
            <label class="text-gray" for="">Email</label>
            <input type="text" class="form-control" name="email" value="{{old('email')}}" placeholder="Email Address">
            @error('email')
              <small class="form-text text-danger">{{$message}}</small>
            @enderror
          </div>
          <label class="text-gray" for="">Phone</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">+880</div>
            </div>
            <input type="number" class="form-control" name="phone" value="{{old('phone')}}" placeholder="Phone">
          </div>
          @error('phone')
            <small class="form-text text-danger">{{$message}}</small>
          @enderror
          <div class="form-group mt-3">
            <label class="text-gray" for="">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Password">
            @error('password')
              <small class="form-text text-danger">{{$message}}</small>
            @enderror
          </div>
          <button class="btn btn-sm btn-success">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

@if(count($errors) > 0)
<script>
$( document ).ready(function() {
$('#exampleModalCenter').modal('show');
});
</script>
@endif
@endsection