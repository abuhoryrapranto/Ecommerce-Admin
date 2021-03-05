<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <link rel="icon" type="image/gif/png" href="{{asset('dist/img/logo-3.png')}}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  </head>
  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
      <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom-1">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <span class="dropdown-item dropdown-header text-info font-weight-bold">{{ Auth::guard('admin')->user()->full_name }}</span>
              <div class="dropdown-divider"></div>
              <a href="{{url('/changeAdminPassword')}}" class="dropdown-item">
                <i class="fas fa-key mr-2"></i> Change Password
              </a>
              <div class="dropdown-divider"></div>
              <a href="{{ url('/logout') }}" class="dropdown-item dropdown-footer text-danger font-weight-bold"><i class="fas fa-sign-out-alt"></i> Sign Out</a>
            </div>
          </li>
        </ul>
      </nav>
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{url('/dashboard')}}" class="brand-link">
          <span class="brand-text font-weight-light">EC-Admin</span>
        </a>
        <div class="sidebar" style="font-size: 14px;">
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="{{ asset('dist/img/avatar.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="#" class="d-block">{{ Auth::guard('admin')->user()->full_name }}</a>
            </div>
          </div>
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-item">
                <a href="{{url('/dashboard')}}" class="nav-link {{ Request::segment(1) === 'dashboard'? 'active' : null }}">
                  <i class="nav-icon fas fa-tachometer-alt" style="font-size: 14px;"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/admin-list')}}" class="nav-link {{ Request::segment(1) === 'admin-list' || Request::segment(1) === 'edit' ? 'active' : null }}">
                  <i class="nav-icon fas fa-user" style="font-size: 14px;"></i>
                  <p>
                    Admin
                  </p>
                </a>
              </li>
              <li class="nav-item has-treeview {{ Request::segment(1) === 'product' ? 'menu-open' : null }}">
                <a href="#" class="nav-link {{ Request::segment(1) === 'product' ? 'active' : null }}">
                  <i class="nav-icon fas fa-shopping-bag" style="font-size: 14px;"></i>
                  <p>
                    Product
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{url('/product/add-new')}}" class="nav-link {{ Request::segment(1) === 'product' && Request::segment(2) === 'add-new' ? 'active' : null }}">
                      <p class="ml-3">Add New</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/product/all-active-products')}}" class="nav-link {{ Request::segment(1) === 'product' && Request::segment(2) === 'all-active-products' ? 'active' : null }}">
                      <p class="ml-3">Active Products</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item has-treeview {{ Request::segment(1) === 'setting' ? 'menu-open' : null }}">
                <a href="#" class="nav-link {{ Request::segment(1) === 'setting' ? 'active' : null }}">
                  <i class="nav-icon fas fa-cog" style="font-size: 14px;"></i>
                  <p>
                    Setting
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{url('/setting/brand')}}" class="nav-link {{ Request::segment(1) === 'setting' && Request::segment(2) === 'brand' ? 'active' : null }}">
                      <p class="ml-3">Brand</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/setting/type')}}" class="nav-link {{ Request::segment(1) === 'setting' && Request::segment(2) === 'type' ? 'active' : null }}">
                      <p class="ml-3">Type</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/setting/subtype')}}" class="nav-link {{ Request::segment(1) === 'setting' && Request::segment(2) === 'subtype' ? 'active' : null }}">
                      <p class="ml-3">Subtype</p>
                    </a>
                  </li>
                </ul>
              </li>
              <!--<li class="nav-item has-treeview {{ Request::segment(1) === 'products' ? 'menu-open' : null }}">
                <a href="#" class="nav-link {{ Request::segment(1) === 'products' ? 'active' : null }}">
                  <i class="nav-icon fas fa-shopping-bag" style="font-size: 14px;"></i>
                  <p>
                    Products
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{url('/products/addNewProduct')}}" class="nav-link {{ Request::segment(1) === 'products' && Request::segment(2) === 'addNewProduct' ? 'active' : null }}">
                      <p class="ml-3">Add New</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/products/allProductList')}}" class="nav-link {{ Request::segment(1) === 'products' && Request::segment(2) === 'allProductList' ? 'active' : null }}">
                      <p class="ml-3">Products List</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/products/brandList')}}" class="nav-link {{ Request::segment(1) === 'products' && Request::segment(2) === 'brandList' ? 'active' : null }}">
                      <p class="ml-3">Product Brands</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/products/typeList')}}" class="nav-link {{ Request::segment(1) === 'products' && Request::segment(2) === 'typeList' ? 'active' : null }}">
                      <p class="ml-3">Product Types</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/products/unitList')}}" class="nav-link {{ Request::segment(1) === 'products' && Request::segment(2) === 'unitList' ? 'active' : null }}">
                      <p class="ml-3">Product Units</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/products/allDeleted')}}" class="nav-link {{ Request::segment(1) === 'products' && Request::segment(2) === 'allDeleted' ? 'active' : null }}">
                      <p class="ml-3">Deleted Products</p>
                    </a>
                  </li>
                </ul>
              </li>
               <li class="nav-item">
                <a href="{{url('/customers/allCustomers')}}" class="nav-link {{ Request::segment(1) === 'customers' ? 'active' : null }}">
                  <i class="nav-icon fas fa-user-friends" style="font-size: 14px;"></i>
                  <p>
                    Customers
                  </p>
                </a>
              </li>
              <li class="nav-item has-treeview {{ Request::segment(1) === 'suppliers' ? 'menu-open' : null }}">
                <a href="#" class="nav-link {{ Request::segment(1) === 'suppliers' ? 'active' : null }}">
                  <i class="nav-icon fas fa-people-carry" style="font-size: 14px;"></i>
                  <p>
                    Suppliers
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{url('/suppliers/addNewSupplier')}}" class="nav-link {{ Request::segment(1) === 'suppliers' && Request::segment(2) === 'addNewSupplier' ? 'active' : null }}">
                      <p class="ml-3">Add New</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/suppliers/supllierList')}}" class="nav-link {{ Request::segment(1) === 'suppliers' && Request::segment(2) === 'supllierList' ? 'active' : null }}">
                      <p class="ml-3">Supplier List</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/suppliers/deletedSupplierList')}}" class="nav-link {{ Request::segment(1) === 'suppliers' && Request::segment(2) === 'deletedSupplierList' ? 'active' : null }}">
                      <p class="ml-3">Deleted Suppliers</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item has-treeview {{ Request::segment(1) === 'purchase' ? 'menu-open' : null }}">
                <a href="#" class="nav-link {{ Request::segment(1) === 'purchase' ? 'active' : null }}">
                  <i class="nav-icon fas fa-shopping-basket" style="font-size: 14px;"></i>                  <p>
                    Purchase
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{url('/purchase/addNewPurchase')}}" class="nav-link {{ Request::segment(1) === 'purchase' && Request::segment(2) === 'addNewPurchase' ? 'active' : null }}">
                      <p class="ml-3">Add New</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/purchase/allPurchase')}}" class="nav-link {{ Request::segment(1) === 'purchase' && Request::segment(2) === 'allPurchase' ? 'active' : null }}">
                      <p class="ml-3">Purchase List</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/purchase/deletedPurchaseList')}}" class="nav-link {{ Request::segment(1) === 'purchase' && Request::segment(2) === 'deletedPurchaseList' ? 'active' : null }}">
                      <p class="ml-3">Deleted Purchase</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item has-treeview {{ Request::segment(1) === 'invoice' ? 'menu-open' : null }}">
                <a href="#" class="nav-link {{ Request::segment(1) === 'invoice' ? 'active' : null }}">
                  <i class="nav-icon fas fa-file-invoice-dollar" style="font-size: 14px;"></i>
                  <p>
                    Invoices
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{url('/invoice/createNew')}}" class="nav-link {{ Request::segment(1) === 'invoice' && Request::segment(2) === 'createNew' ? 'active' : null }}">
                      <p class="ml-3">Create New</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/invoice/invoiceList')}}" class="nav-link {{ Request::segment(1) === 'invoice' && Request::segment(2) === 'invoiceList' ? 'active' : null }}">
                      <p class="ml-3">Invoices List</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/invoice/deletedInvoices')}}" class="nav-link {{ Request::segment(1) === 'invoice' && Request::segment(2) === 'deletedInvoices' ? 'active' : null }}">
                      <p class="ml-3">Deleted Invoice</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="{{url('/reports')}}" class="nav-link {{ Request::segment(1) === 'reports' ? 'active' : null }}">
                  <i class="nav-icon fas fa-file-pdf" style="font-size: 14px;"></i>
                  <p>
                    Reports
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/myShop')}}" class="nav-link {{ Request::segment(1) === 'myShop' || Request::segment(1) === 'editMyShop' ? 'active' : null }}">
                  <i class="nav-icon fas fa-store" style="font-size: 14px;"></i>
                  <p>
                    My Shop
                  </p>
                </a>
              </li> -->
            </ul>
          </nav>
        </div>
      </aside>
      <div class="content-wrapper">
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h4 class="m-0 text-dark">@yield('page_header')</h4>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right mr-5">
                  @yield('add_button')
                </ol>
              </div>
            </div>
          </div>
        </div>
        
        <section class="content">
          <div class="container-fluid">
            @yield('content')
          </div>
        </section>
      </div>
      <footer class="main-footer">
        Copyright &copy; <?php echo date("Y"); ?> <a class="text-success" href="https://www.softvenger.com/" target="_blank"></a>.</strong> All rights reserved.
      </footer>
    </div>
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <!-- <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('charts/chart-area-demo.js') }}"></script>
    <script src="{{ asset('charts/chart-pie-demo.js') }}"></script>
    <script src="{{ asset('charts/chart-bar-demo.js') }}"></script> -->
    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js')}}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>
    <script>
    $('#datepicker').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd'
    });
    </script>
    <script>
    $( document ).ready(function() {
    setTimeout(function() { $("#msg").hide(); }, 5000);
    });
    </script>
  </body>
</html>