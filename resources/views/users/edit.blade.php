@extends('layouts.global')

@section('title-page')
     Edit Pengguna
@endsection

@section('starter-page')
    Edit Pengguna
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
                   

                    <div class="card card-primary " >
                            <div class="card-header">
                              <h3 class="card-title">Form Edit Data </h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form 
                                role="form"
                                enctype="multipart/form-data"
                                action="{{  route('users.update', [$user->id])}}"
                                method="POST">

                            @csrf
                            <input type="hidden" value="PUT" name="_method">

                              <div class="card-body">

                                <div class="form-group">
                                  <label for="name">Nama</label>
                                  <input type="text" class="form-control" id="name" name="name" value="{{old('name') ? old('name') : $user->name}}" placeholder="Masukan Nama Lengkap">

                                  @if ($errors->first('name'))
                <div class="alert alert-danger alert-dismissible" style="margin-top:15px;">
                  <strong><i class="icon fa fa-ban"></i> {{ $errors->first('name') }}</strong>
                </div>
                @endif
                                </div>

                                <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" placeholder="Masukan Username" disabled>
                                </div>

                                <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" disabled id="email" name="email" value="{{ $user->email }}" placeholder="Masukan Email">
                                </div>

                                <div class="form-check">
                                        <input type="radio" {{ $user->status == "ACTIVE" ? "checked" : "" }} class="form-check-input" id="active" name="status"  value="ACTIVE">
                                        <label class="form-check-label" for="active">Active</label>
                                </div>

                                <div class="form-check">
                                        <input type="radio" {{ $user->status == "INACTIVE" ? "checked" : "" }} class="form-check-input" id="inactive" name="status"  value="INACTIVE">
                                        <label class="form-check-label" for="inactive">Inactive</label>
                                </div>
                                <br>

                                <div class="form-check">
                                        <input type="checkbox" {{ in_array("ADMIN",json_decode($user->roles)) ? "checked" : "" }} class="form-check-input {{$errors->first('roles') ? "is-invalid" : "" }}" id="ADMIN" name="roles[]"  value="ADMIN">
                                        <label class="form-check-label" for="ADMIN">Administrator</label>
                                </div>

                                <div class="form-check">
                                        <input type="checkbox" {{ in_array("STAFF",json_decode($user->roles)) ? "checked" : "" }} class="form-check-input {{$errors->first('roles') ? "is-invalid" : "" }}" id="STAFF" name="roles[]"  value="STAFF">
                                        <label class="form-check-label" for="STAFF">Staff</label>
                                </div>

                                <div class="form-check">
                                        <input type="checkbox" {{ in_array("CUSTOMER",json_decode($user->roles)) ? "checked" : "" }} class="form-check-input {{$errors->first('roles') ? "is-invalid" : "" }}" id="CUSTOMER" name="roles[]"  value="CUSTOMER">
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
                                        <input type="text" class="form-control {{$errors->first('phone') ? "is-invalid" : ""}}" value="{{old('phone') ? old('phone') : $user->phone}}" id="phone" name="phone" placeholder="Masukan No Telepon">

                                        @if ($errors->first('phone'))
                <div class="alert alert-danger alert-dismissible" style="margin-top:15px;">
                  <strong><i class="icon fa fa-ban"></i> {{ $errors->first('phone') }}</strong>
                </div>
                @endif
                                </div>

                                <div class="form-group">
                                        <label for="address">Alamat</label>
                                        <textarea class="form-control {{$errors->first('address') ? "is-invalid" : ""}}"  id="address" name="address" rows="3"  placeholder="Masukan Alamat ...">{{old('address') ? old('address') : $user->address}}</textarea>
                                
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
                                            <input type="file" class="custom-file-input" id="avatar" name="avatar">
                                            <label class="custom-file-label" for="avatar">Choose file</label>
                                          </div>
                                          <div class="input-group-append">
                                            <span class="input-group-text" id="">Upload</span>
                                          </div>
                                        </div>
                                        <div class="alert alert-info alert-dismissible" style="margin-top:15px;">
                                                <h6><i class="icon fa fa-ban"></i> Pesan!</h6>
                                                <strong>Kosongkan jika tidak ingin mengubah foto profil</strong>
                                        </div>
                                </div>

                                <div class="form-group">
                                        <label for="address">Foto Profil Saat Ini</label>
                                        @if ($user->avatar)
                                            <img src="{{ asset('storage/'.$user->avatar) }}" alt="Foto Profil" width="120px">
                                            <br>
                                        @else 
                                            Tidak Ada Foto Profil
                                        @endif   
                                        
                                </div>

                                {{-- <div class="form-group">
                                  <label for="password">Password</label>
                                  <input type="password" class="form-control" id="password" name="password" placeholder="Masukan Password">
                                </div>

                                <div class="form-group">
                                  <label for="password_confirmation">Konfirmasi Password</label>
                                  <input type="password" class="form-control" id="password_confirmation" name="password" placeholder="Masukan Konfirmasi Password">
                                </div> --}}
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



