<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  </head>
  <body class="hold-transition login-page">
    <div class="login-box mb-5">
      <div class="card">
        <div class="card-body login-card-body">
          <form action="{{url('/login-auth')}}" method="post">
            <div class="login-logo">
              <img src="{{asset('dist/img/admin.png')}}" alt="logo" height="90">
            </div>
            <p class="login-box-msg">Sign In</p>
            {{ csrf_field() }}
            @if (Session::has('failedLogin'))
            <h6 class="text-danger font-weight-bold">{{ Session::get('failedLogin') }}</h6>
            @endif
            <div class="form-group has-feedback">
              <input type="email" class="form-control" name="email" value="{{old('email')}}" placeholder="Email">
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            @error('email')
            <p class="text-danger errorMessage">{{ $message }}</p>
            @enderror
            <div class="form-group has-feedback">
              <input type="password" class="form-control" name="password" value="{{old('password')}}" placeholder="Password">
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            @error('password')
            <p class="text-danger errorMessage">{{ $message }}</p>
            @enderror
            <div class="row">
              <div class="col-md-8">
                <!-- <a href="#">I forgot my password</a> -->
              </div>
              <div class="col-md-4">
                <button type="submit" class="btn btn-success btn-block btn-flat">Sign In</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>