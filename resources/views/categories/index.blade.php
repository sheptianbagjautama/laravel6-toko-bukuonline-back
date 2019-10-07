@extends('layouts.global')

@section('title-page')
     Data List Kategori
@endsection

@section('starter-page')
    Data List Kategori
@endsection

@section('header')
    <link rel="stylesheet" href=" {{ asset('assets/plugins/datatables/dataTables.bootstrap4.css') }}">
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

                    <a href="{{ route('categories.create') }}" class="btn btn-info" style="margin-bottom: 10px;">Tambah Data</a>
                        <div class="card">
                                <div class="card-header">
                                  <h3 class="card-title">Kategori</h3>
                                </div>

                                <!-- /.card-header -->
                                <div class="card-body">
                                  
                                  <div class="row">
                                        
                                      <div class="col-md-4">
                                            <form action="{{ route('categories.index') }}">
                                                <div class="form-group">
                                                        <input 
                                                        type="text" 
                                                        class="form-control" 
                                                        value="{{ Request::get('keyword') }}" 
                                                        id="keyword" 
                                                        name="keyword" 
                                                        placeholder="Filter berdasarkan nama kategori">
                                                        
                                                    </div>
                                      </div>


                                      <div class="col-2"><button class="btn btn-info btn-block" type="submit"><i class="fa fa-search"></i> Filter</button></div>
                                    <div class="col-2"><a class="btn btn-info btn-warning btn-block" href="{{ route('categories.index') }}"><i class="fa fa-search"></i> Clear</a></div>
                                    </form>

                                    <div class="col-md-4">
                                        <a class="btn btn-info " href="{{ route('categories.index') }}"><i class="fa fa-eye"></i> Published</a>
                                        <a class="btn btn-danger " href="{{ route('categories.trash') }}"><i class="fa fa-trash-o"></i> Trash</a>
                                    </div>
                                  </div>

                                  <table id="pengguna" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Slug</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                        <th>Hapus</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                    @forelse ($categories as $category)
                                    <tr>
                                        <td>{{ ucfirst($category->name) }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>
                                            @if ($category->image)
                                                <img src="{{ asset('storage/'.$category->image) }}" alt="Foto Kategori" width="50px">
                                            @else
                                                <img src="{{ asset('assets/dist/img/empty-user.png') }}" alt="Foto Kategori" width="50px">
                                            @endif

                                        </td>
                                        <td>
                                            <a href="{{ route('categories.edit', [$category->id]) }}" class="btn btn-warning" style="margin-right:10px;"><i class="fa fa-pencil"></i> Edit</a>
                                            <a href="{{ route('categories.show', [$category->id]) }}" class="btn btn-info"><i class="fa fa-eye"></i> Detail</a>
                                        </td>
                                        <td>
                                                <form 
                                                action="{{ route('categories.destroy', [$category->id]) }}"
                                                onsubmit="return confirm('Hapus data ke tong sampah ?')"
                                                method="POST">

                                                @csrf

                                                <input type="hidden" name="_method" value="DELETE">

                                                
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</button>
                                            </form>
                                        </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                    
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Slug</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                        <th>Hapus</th
                                    </tr>
                                    </tfoot>
                                  </table>
                              
              </div>
  
            </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
@endsection


@section('footer')
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.js') }}"></script>
<script>
        $(function () {
          $("#pengguna").DataTable();
        });
      </script>
@endsection