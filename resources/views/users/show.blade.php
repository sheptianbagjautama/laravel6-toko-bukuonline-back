@extends('layouts.global')

@section('title-page')
     Detail Pengguna
@endsection

@section('starter-page')
    Detail Pengguna
@endsection

@section('content')
 <!-- Main content -->
 <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-4">
                    <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                              <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="{{ asset('storage/'.$user->avatar) }}"
                                     alt="User profile picture">
                              </div>
              
                              <h3 class="profile-username text-center">{{ $user->name }}</h3>
              
                              <p class="text-muted text-center">{{ $user->email }}</p>
              
                              <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                  <b>Username</b> <a class="float-right">{{ $user->username }}</a>
                                </li>
                                <li class="list-group-item">
                                  <b>No. Telepon</b> <a class="float-right">{{ $user->phone }}</a>
                                </li>
                                <li class="list-group-item">
                                  <b>Alamat</b> <a class="float-right">{{ $user->address }}</a>
                                </li>

                                <li class="list-group-item">
                                        <b>Roles</b> <a class="float-right">
                                           @foreach (json_decode($user->roles) as $role)
                                               &middot; {{ $role }} <br>
                                           @endforeach
                                        </a>
                                </li>
                              </ul>
              
                              <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                            </div>
                            <!-- /.card-body -->
                          </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
@endsection
