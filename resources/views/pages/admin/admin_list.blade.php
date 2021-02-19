@extends('structure.admin_structure')
@section('title', 'Admin List')
@section('page_header', 'Admins')
@section('content')
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
                      @if(Auth::guard('admin')->user()->id != $row->id)
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
@endsection