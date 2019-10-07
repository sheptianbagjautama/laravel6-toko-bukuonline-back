@extends('layouts.global')

@section('title-page')
Data Pengguna
@endsection

@section('starter-page')
Data Pengguna
@endsection

@section('content')
<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">

        @if (session('status'))
        <div class="alert alert-success alert-dismissible">
          <h6><i class="icon fa fa-ban"></i> Pesan !</h6>
          <strong>{{ session('status') }}</strong>
        </div>
        @endif


        <div class="card card-primary ">
          <div class="card-header">
            <h3 class="card-title">Form Tambah Data </h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" enctype="multipart/form-data" action="{{ route('users.store') }}" method="POST">

            @csrf

            <div class="card-body">

              <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" value="{{ old('name') }}"
                  class="form-control {{ $errors->first('name') ? "is-invalid" : "" }}" id="name" name="name"
                  placeholder="Masukan Nama Lengkap">

                @if ($errors->first('name'))
                <div class="alert alert-danger alert-dismissible" style="margin-top:15px;">
                  <strong><i class="icon fa fa-ban"></i> {{ $errors->first('name') }}</strong>
                </div>
                @endif

              </div>

              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" value="{{ old('username') }}"
                  class="form-control {{ $errors->first('username') ? "is-invalid" : "" }}" id="username"
                  name="username" placeholder="Masukan Username">
                @if ($errors->first('username'))
                <div class="alert alert-danger alert-dismissible" style="margin-top:15px;">
                  <strong><i class="icon fa fa-ban"></i> {{ $errors->first('username') }}</strong>
                </div>
                @endif
              </div>

              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" value="{{ old('email') }}"
                  class="form-control {{ $errors->first('email') ? "is-invalid" : "" }}" id="email" name="email"
                  placeholder="Masukan Email">

                @if ($errors->first('email'))
                <div class="alert alert-danger alert-dismissible" style="margin-top:15px;">
                  <strong><i class="icon fa fa-ban"></i> {{ $errors->first('email') }}</strong>
                </div>
                @endif

              </div>

              <div class="form-check">
                <input type="checkbox" class="form-check-input {{$errors->first('roles') ? "is-invalid" : "" }}"
                  id="ADMIN" name="roles[]" value="ADMIN">
                <label class="form-check-label" for="ADMIN">Administrator</label>

              </div>

              <div class="form-check">
                <input type="checkbox" class="form-check-input {{$errors->first('roles') ? "is-invalid" : "" }}"
                  id="STAFF" name="roles[]" value="STAFF">
                <label class="form-check-label" for="STAFF">Staff</label>
              </div>

              <div class="form-check">
                <input type="checkbox" class="form-check-input {{$errors->first('roles') ? "is-invalid" : "" }}"
                  id="CUSTOMER" name="roles[]" value="CUSTOMER">
                <label class="form-check-label" for="CUSTOMER">Customer</label>


              </div>


              @if ($errors->first('roles'))
              <div class="form-group">
                <div class="alert alert-danger alert-dismissible" style="margin-top:15px;">
                  <strong><i class="icon fa fa-ban"></i> {{ $errors->first('roles') }}</strong>
                </div>
              </div>
              @endif


              <div class="form-group">
                <label for="phone">Telepon</label>
                <input type="text" value="{{ old('phone') }}"
                class="form-control {{ $errors->first('phone') ? "is-invalid" : "" }}" id="phone" name="phone" placeholder="Masukan No Telepon">

                @if ($errors->first('phone'))
                <div class="alert alert-danger alert-dismissible" style="margin-top:15px;">
                  <strong><i class="icon fa fa-ban"></i> {{ $errors->first('phone') }}</strong>
                </div>
                @endif
              </div>

              <div class="form-group">
                <label for="address">Alamat</label>
                <textarea
                class="form-control {{ $errors->first('address') ? "is-invalid" : "" }}" id="address" name="address" rows="3"
                  placeholder="Masukan Alamat ...">{{ old('address') }}</textarea>

                  @if ($errors->first('address'))
                <div class="alert alert-danger alert-dismissible" style="margin-top:15px;">
                  <strong><i class="icon fa fa-ban"></i> {{ $errors->first('address') }}</strong>
                </div>
                @endif
              </div>

              <div class="form-group">
                <label for="exampleInputFile">Foto Profil</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input {{ $errors->first('avatar') ? "is-invalid" : "" }} " id="avatar" name="avatar">
                    <label class="custom-file-label" for="avatar">Choose file</label>
                  </div>
                  <div class="input-group-append">
                    <span class="input-group-text" id="">Upload</span>
                  </div>
                </div>

                @if ($errors->first('avatar'))
                <div class="alert alert-danger alert-dismissible" style="margin-top:15px;">
                  <strong><i class="icon fa fa-ban"></i> {{ $errors->first('avatar') }}</strong>
                </div>
                @endif
              </div>

              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" value="{{ old('password') }}"
                class="form-control {{ $errors->first('password') ? "is-invalid" : "" }}" id="password" name="password"
                  placeholder="Masukan Password">

                  @if ($errors->first('password'))
                <div class="alert alert-danger alert-dismissible" style="margin-top:15px;">
                  <strong><i class="icon fa fa-ban"></i> {{ $errors->first('password') }}</strong>
                </div>
                @endif
              </div>

              <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" value="{{ old('password_confirmation') }}"
                class="form-control {{ $errors->first('password_confirmation') ? "is-invalid" : "" }}" id="password_confirmation" name="password_confirmation"
                  placeholder="Masukan Konfirmasi Password">
                  @if ($errors->first('name'))
                <div class="alert alert-danger alert-dismissible" style="margin-top:15px;">
                  <strong><i class="icon fa fa-ban"></i> {{ $errors->first('password_confirmation') }}</strong>
                </div>
                @endif
              </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
@endsection