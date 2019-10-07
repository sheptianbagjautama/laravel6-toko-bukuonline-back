@extends('layouts.global')

@section('title-page')
     Data Edit Buku
@endsection

@section('starter-page')
    Data Edit Buku
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
                                action="{{ route('books.update', [$book->id]) }}" 
                                method="POST">

                            @csrf

                            <input type="hidden" name="_method" value="PUT">

                              <div class="card-body">

                                <div class="form-group">
                                  <label for="name">Judul</label>
                                  <input type="text" class="form-control {{$errors->first('title') ? "is-invalid" : ""}}"  value="{{old('title') ? old('title') : $book->title}}"  id="title" name="title"  placeholder="Masukan Judul Buku">

                                  @if ($errors->first('title'))
                <div class="alert alert-danger alert-dismissible" style="margin-top:15px;">
                  <strong><i class="icon fa fa-ban"></i> {{ $errors->first('title') }}</strong>
                </div>
                @endif
                                </div>

                            
                                <div class="form-group">
                                        <label for="exampleInputFile">Cover Buku</label>
                                        <div class="input-group">
                                          <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="cover" name="cover">
                                            <label class="custom-file-label" for="cover">Choose file</label>
                                          </div>
                                          <div class="input-group-append">
                                            <span class="input-group-text" id="">Upload</span>
                                          </div>
                                        </div>
                                        <div class="alert alert-info alert-dismissible" style="margin-top:15px;">
                                                <h6><i class="icon fa fa-ban"></i> Pesan!</h6>
                                                <strong>Kosongkan jika tidak ingin mengubah cover buku</strong>
                                        </div>
                                </div>
      
                                <div class="form-group">
                                        <label for="address">Cover Saat Ini</label>
                                        @if ($book->cover)
                                            <img src="{{ asset('storage/'.$book->cover) }}" alt="Cover Buku" width="120px">
                                            <br>
                                        @else 
                                            Tidak Ada Cover Buku
                                        @endif   
                                        
                                </div>

                            <div class="form-group">
                                    <label for="description">Deskripsi</label>
                                    <textarea class="form-control {{$errors->first('description') ? "is-invalid" : ""}}"    id="description" name="description" rows="3"  placeholder="Masukan Alamat ...">{{old('description') ? old('description') : $book->description}}</textarea>

                                    @if ($errors->first('description'))
                                    <div class="alert alert-danger alert-dismissible" style="margin-top:15px;">
                                      <strong><i class="icon fa fa-ban"></i> {{ $errors->first('description') }}</strong>
                                    </div>
                                    @endif
                            </div>

                            <div class="form-group">
                                <label for="name">Stok</label>
                                <input type="text" class="form-control {{$errors->first('stock') ? "is-invalid" : ""}}"  value="{{old('stock') ? old('stock') : $book->stock}}" id="stock" name="stock"  placeholder="Masukan Stok" min="0" value="0">

                                @if ($errors->first('stock'))
                                <div class="alert alert-danger alert-dismissible" style="margin-top:15px;">
                                  <strong><i class="icon fa fa-ban"></i> {{ $errors->first('stock') }}</strong>
                                </div>
                                @endif
                              </div>

                              <div class="form-group">
                                <label for="name">Penulis</label>
                                <input type="text" class="form-control {{$errors->first('author') ? "is-invalid" : ""}}"  value="{{old('author') ? old('author') : $book->author}}" id="author" name="author"  placeholder="Masukan Penulis" >

                                @if ($errors->first('author'))
                                <div class="alert alert-danger alert-dismissible" style="margin-top:15px;">
                                  <strong><i class="icon fa fa-ban"></i> {{ $errors->first('author') }}</strong>
                                </div>
                                @endif
                              </div>

                              <div class="form-group">
                                <label for="name">Penerbit</label>
                                <input type="text" class="form-control {{$errors->first('publisher') ? "is-invalid" : ""}}"  value="{{old('publisher') ? old('publisher') : $book->publisher}}" id="publisher" name="publisher" placeholder="Masukan Penerbit" >

                                @if ($errors->first('publisher'))
                                <div class="alert alert-danger alert-dismissible" style="margin-top:15px;">
                                  <strong><i class="icon fa fa-ban"></i> {{ $errors->first('publisher') }}</strong>
                                </div>
                                @endif
                              </div>

                              <div class="form-group">
                                <label for="name">Harga</label>
                                <input type="text" class="form-control {{$errors->first('price') ? "is-invalid" : ""}}"  value="{{old('price') ? old('price') : $book->price}}" id="price" name="price"  placeholder="Masukan Harga">

                                @if ($errors->first('price'))
                                <div class="alert alert-danger alert-dismissible" style="margin-top:15px;">
                                  <strong><i class="icon fa fa-ban"></i> {{ $errors->first('price') }}</strong>
                                </div>
                                @endif
                              </div>

                              <div class="form-group">
                                <label for="categories">Kategori</label>
                                <select name="categories[]" id="categories" class="form-control select2" multiple></select>
                              </div>

                              <div class="form-group">
                                    <select name="status" id="status" class="form-control">
                                            <option {{$book->status == 'PUBLISH' ? 'selected' : ''}} value="PUBLISH">PUBLISH</option>
                                            <option {{$book->status == 'DRAFT' ? 'selected' : ''}} value="DRAFT">DRAFT</option>
                                          </select>
                                  </div>


                              <!-- /.card-body -->
              
                              <div class="card-footer">
                                <button  name="save_action" class="btn btn-primary" value="PUBLISH">Submit</button>
                                {{-- <button  name="save_action" class="btn btn-secondary" value="DRAFT">Simpan Sebagai Draft</button> --}}
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

@section('footer')
    <script>


        $('#categories').select2({
            ajax:{
                url: 'http://localhost:2001/ajax/categories/search',
                processResults:function(data) {
                    return {
                        results: data.map(function(item){return {id: item.id, text: item.name} })
                    }
                }
            }
        });

        var categories = {!! $book->categories !!}

        categories.forEach(function(category){
        var option = new Option(category.name, category.id, true, true);
        $('#categories').append(option).trigger('change');
        });

        

    </script>
@endsection



