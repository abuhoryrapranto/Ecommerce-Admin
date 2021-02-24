@extends('structure.admin_structure')
@section('title', 'Add Product')
@section('page_header', 'Add Product')
@section('content')
<style>
  label {
    color: grey;
  }
</style>
<link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@if (Session::has('msg'))
<div class="alert alert-success" id="msg" role="alert">
	{{ Session::get('msg') }}
</div>
@elseif(Session::has('failedMsg'))
<div class="alert alert-danger" id="msg" role="alert">
	{{ Session::get('failedMsg') }}
</div>
@endif
<form action="{{url('/product/save-product')}}" method="post" enctype="multipart/form-data">
  {{@csrf_field()}}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputName">Product Name</label>
                <input type="text" class="form-control" id="exampleInputName" name="name" placeholder="Enter Product Name">
                @error('name')
                    <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Product Brand</label>
                <select class="form-control" id="exampleFormControlSelect1" name="brand_id">
                  <option value="">---Select---</option>
                  @foreach($brands as $row)
                    <option value="{{$row->id}}">{{$row->name}}</option>
                  @endforeach
                </select>
                <small class="float-right">Not in list?<a href="#" data-toggle="modal" data-target="#brandModal"> Add new</a></small>
                @error('brand_id')
                  <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect2">Product Type</label>
                <select class="form-control" id="exampleFormControlSelect2" name="type_id">
                  <option value="">---Select---</option>
                  @foreach($types as $row)
                    <option value="{{$row->id}}">{{$row->name}}</option>
                  @endforeach
                </select>
                <small class="float-right">Not in list?<a href="#" data-toggle="modal" data-target="#typeModal"> Add new</a></small>
                @error('type_id')
                  <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>

            <div class="form-group">
              <label for="exampleFormControlSelect2">Product Sub Type</label>
              <select class="form-control" id="exampleFormControlSelect2" name="sub_type_id">
                <option value="">---Select---</option>
                @foreach($sub_types as $row)
                  <option value="{{$row->id}}">{{$row->name}}</option>
                @endforeach
              </select>
              <small class="float-right">Not in list?<a href="#" data-toggle="modal" data-target="#subTypeModal"> Add new</a></small>
              @error('sub_type_id')
                <small class="form-text text-danger">{{$message}}</small>
              @enderror
          </div>
            <br>
            <div class="card">
                <div class="card-header">
                  Product Option Box
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" id="colorCheckBox">
                                  <b class="form-check-label text-primary" for="colorCheckBox">
                                    Select Color
                                  </b>
                                </div>
                                <div class="colorOption ml-3" style="display: none;">
                                    <div class="form-group">
                                        <label class="text-primary">Select Color</label>
                                        <div class="select2-purple">
                                        <select class="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;" name="color[]">
                                          @foreach($colors as $row)
                                            <option value="{{$row->name}}">{{$row->name}}</option>
                                          @endforeach
                                        </select>
                                        </div>
                                      </div>
                                </div>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="weightCheckBox">
                                    <b class="form-check-label text-success" for="weightCheckBox">
                                      Select Weight
                                    </b>
                                </div>
                                <div class="form-group ml-3 weightOption" style="display: none;">
                                    <label class="text-success">Product Weight</label>
                                    <input type="text" class="form-control" id="weightBox" name="weight" placeholder="Enter Product Weight. Ex: 100 ml">
                                    <!-- <small id="nameHelp" class="form-text text-muted"></small> -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" id="sizeCheckBox">
                                  <b class="form-check-label text-info" for="sizeCheckBox">
                                    Select Size
                                  </b>
                                </div>
                                <div class="sizeOption ml-3" style="display: none;">
                                    <div class="form-group">
                                        <label class="text-info">Select Size</label>
                                        <div class="select2-purple">
                                        <select class="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;" name="size[]">
                                          @foreach($sizes as $row)
                                            <option value="{{$row->name}}">{{$row->name}}</option>
                                          @endforeach
                                        </select>
                                        </div>
                                      </div>
                                </div>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="gridCheck1">
                                    <label class="form-check-label" for="gridCheck1">
                                      Select Custom
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
          <div class="form-froup">
            <label>Thumbnail Image</label>
            <br>
            <input type="file" name="thumbnail">
            <br>
            @error('thumbnail')
              <small class="form-text text-danger">{{$message}}</small>
            @enderror
          </div>
            <div class="form-group">
                <label for="exampleInputMainPrice">Main Price</label>
                <input type="number" class="form-control" id="exampleInputMainPrice" name="main_price" placeholder="Enter Product Main Price">
                @error('main_price')
                  <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputOfferPrice">Offer Price</label>
                <input type="number" class="form-control" id="exampleInputOfferPrice" name="offer_price" placeholder="Enter Product Offer Price">
                <!-- <small id="nameHelp" class="form-text text-muted"></small> -->
            </div>
            <div class="form-group">
                <label for="exampleInputTotalStock">Total Stock</label>
                <input type="number" class="form-control" id="exampleInputTotalStock" name="total_stock" placeholder="Enter Product Total Stock">
                <!-- <small id="nameHelp" class="form-text text-muted"></small> -->
            </div>
            <!-- <div class="form-group">
                <label for="exampleFormControlTextarea1">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
            </div> -->
            <div class="form-group">
              <textarea id="summernote" name="description"></textarea>
            </div>
        </div>
    </div>
    <div class="text-center mt-5 pb-3">
        <button class="btn btn-success pl-5 pr-5">Next <i class="fas fa-chevron-right"></i></button>
    </div>
</form>

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

  <!-- Type Modal -->
<div class="modal" id="typeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add Type</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{url('setting/save-type')}}" method="POST">
            {{csrf_field()}}
            <div class="form-group">
                @error('type_name')
                  <small class="form-text text-danger">{{$message}}</small>
                @enderror
                <label>Type Name</label>
                <input type="text" class="form-control" name="type_name" placeholder="Enter Type Name">
                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Description</label>
                  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="type_description"></textarea>
                </div>
            </div>
            <button class="btn btn-sm btn-success pl-3 pr-3">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>

    <!-- Sub Type Modal -->
<div class="modal" id="subTypeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Sub Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('setting/save-subtype')}}" method="POST">
          {{csrf_field()}}
          <div class="form-group">
                @error('sub_type_name')
                  <small class="form-text text-danger">{{$message}}</small>
                @enderror
              <label>Sub Type Name</label>
              <input type="text" class="form-control" name="sub_type_name" placeholder="Enter Sub Type Name">
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="sub_type_description"></textarea>
              </div>
          </div>
          <button class="btn btn-sm btn-success pl-3 pr-3">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script>
$('.select2').select2()
$('.select2bs4').select2({
  theme: 'bootstrap4'
});
</script>

<script>
    $(document).ready(function() {
        $('#colorCheckBox').click(function() {
            $(".colorOption").toggle(this.checked);
        });
        $('#weightCheckBox').click(function() {
            $(".weightOption").toggle(this.checked);
        });
        $('#sizeCheckBox').click(function() {
            $(".sizeOption").toggle(this.checked);
        });
    })
</script>

<script type="text/javascript">
$(document).ready(function() {
  $('#summernote').summernote({
    height: 110,
  });
});
</script>

@if ($errors->has('brand_name'))
<script>
$( document ).ready(function() {
$('#brandModal').modal('show');
});
</script>

@elseif ($errors->has('type_name'))
<script>
$( document ).ready(function() {
$('#typeModal').modal('show');
});
</script>

@elseif ($errors->has('sub_type_name'))
<script>
$( document ).ready(function() {
$('#subTypeModal').modal('show');
});
</script>
@endif

@endsection