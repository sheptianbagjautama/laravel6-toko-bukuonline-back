@extends('layouts.global')

@section('title-page')
     Detail Kategori
@endsection

@section('starter-page')
    Detail Kategori
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
                                     src="{{ asset('storage/'.$category->image) }}"
                                     alt="User profile picture">
                              </div>
              
                              <h3 class="profile-username text-center">{{ $category->name }}</h3>
              
                              <p class="text-muted text-center">{{ $category->slug }}</p>
              
                              <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                  <b>Di Buat Oleh</b> <a class="float-right">{{ $category->created_by }}</a>
                                </li>
                                <li class="list-group-item">
                                  <b>Di Ubah Oleh</b> <a class="float-right">{{ $category->updated_by }}</a>
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
