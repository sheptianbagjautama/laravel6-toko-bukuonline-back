<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href=" {{ asset('assets/dist/css/adminlte.min.css') }} ">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/iCheck/square/blue.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page" style="background-image: linear-gradient(to right, #bc4e9c , #f80759)" >
<div class="login-box">
  <div class="login-logo">
      <img src="{{ asset('assets/dist/img/book-shop.png') }}" width="128px" height="128px" ><br>
    <a  style="color: white;font-size:30px;"><b>Aplikasi Toko Buku Online</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Masuk untuk memulai sesi anda</p>

      <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group has-feedback">
          <input id="email" placeholder="Masukan Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

          @error('email')
            <div class="alert alert-danger alert-dismissible" style="margin-top:15px;">
                    <h6><i class="icon fa fa-ban"></i> Error!</h6>
                    <strong>{{ $message }}</strong>
            </div>
          @enderror
          
        </div>
        <div class="form-group has-feedback">
                <input id="password" placeholder="Masukan Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                <div class="alert alert-danger alert-dismissible" style="margin-top:15px;">
                        <h6><i class="icon fa fa-ban"></i> Error!</h6>
                        <strong>{{ $message }}</strong>
                </div>
              @enderror

        </div>
        <div class="row">
          <div class="col-8">
            <div class="checkbox icheck">
              <label>
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                Remember Me
              </label>

           
            </div>
          </div>
          <!-- /.col -->
          <!-- /.col -->
        </div>
      

      <div class="social-auth-links text-center mb-3">

        <button type="submit" class="btn btn-block btn-primary">
                <i class="fa fa-sign-in mr-2"></i> Masuk
        </button>

        @if (Route::has('password.request'))
        <a href="{{ route('password.request') }}" class="btn btn-block btn-danger">
          <i class="fa fa-lock mr-2"></i> Lupa Password
        </a>
        @endif

    </form>
      </div>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src=" {{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src=" {{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('assets/plugins/iCheck/icheck.min.js') }} "></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass   : 'iradio_square-blue',
      increaseArea : '20%' // optional
    })
  })
</script>
</body>
</html>
