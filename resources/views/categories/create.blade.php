@extends('layouts.global')

@section('title-page')
     Data Kategori
@endsection

@section('starter-page')
    Data Kategori
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
                              <h3 class="card-title">Form Tambah Data </h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form 
                                role="form"
                                enctype="multipart/form-data"
                                action="{{ route('categories.store') }}" 
                                method="POST">

                            @csrf

                              <div class="card-body">

                                <div class="form-group">
                                  <label for="name">Nama Kategori</label>
                                  <input type="text" class="form-control {{$errors->first('name') ? "is-invalid" : ""}}"
                                  value="{{old('name')}}" id="name" name="name" placeholder="Masukan Nama Kategori">
                                  
                                  @if ($errors->first('name'))
                <div class="alert alert-danger alert-dismissible" style="margin-top:15px;">
                  <strong><i class="icon fa fa-ban"></i> {{ $errors->first('name') }}</strong>
                </div>
                @endif
                                
                                </div>

                                <div class="form-group">
                                        <label for="exampleInputFile">Category Image</label>
                                        <div class="input-group">
                                          <div class="custom-file">
                                            <input type="file" class="custom-file-input {{$errors->first('image') ? "is-invalid" : ""}}" id="image" name="image">
                                            <label class="custom-file-label" for="image">Choose file</label>
                                          </div>
                                          <div class="input-group-append">
                                            <span class="input-group-text" id="">Upload</span>
                                          </div>
                                        </div>

                                        @if ($errors->first('image'))
                <div class="alert alert-danger alert-dismissible" style="margin-top:15px;">
                  <strong><i class="icon fa fa-ban"></i> {{ $errors->first('image') }}</strong>
                </div>
                @endif
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



