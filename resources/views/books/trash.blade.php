@extends('layouts.global')

@section('title-page')
     Data Tong Sampah Buku
@endsection

@section('starter-page')
Data Tong Sampah Buku
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

                    <a href="{{ route('books.create') }}" class="btn btn-info" style="margin-bottom: 10px;">Tambah Data</a>
                        <div class="card">
                                <div class="card-header">
                                  <h3 class="card-title">Buku</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                  
                                  <div class="row">
                                        
                                      <div class="col-md-4">
                                            <form action="{{ route('books.index') }}">
                                                <div class="form-group">
                                                        <input 
                                                        type="text" 
                                                        class="form-control" 
                                                        value="{{ Request::get('keyword') }}" 
                                                        id="keyword" 
                                                        name="keyword" 
                                                        placeholder="Filter berdasarkan judul">
                                                        
                                                    </div>
                                      </div>


                                      <div class="col-2"><button class="btn btn-info btn-block" type="submit"><i class="fa fa-search"></i> Filter</button></div>
                                    <div class="col-2"><a class="btn btn-info btn-warning btn-block" href="{{ route('books.index') }}"><i class="fa fa-search"></i> Clear</a></div>
                                    
                                   
                                </form>

                                <div class="col-md-4">
                                        <a class="btn btn-info " href="{{ route('books.index') }}"><i class="fa fa-eye"></i> All</a>
                                            <a class="btn btn-info " href="{{ route('books.index' , ['status' => 'publish']) }}"><i class="fa fa-eye"></i> Publish</a>
                                            <a class="btn btn-info " href="{{ route('books.index', ['status' => 'draft']) }}"><i class="fa fa-eye"></i> Draft</a>
                                            <a class="btn btn-danger " href="{{ route('books.trash') }}"><i class="fa fa-trash-o"></i> Trash</a>
                                    </div>
                                  </div>

                                  <table id="pengguna" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Cover Buku</th>
                                        <th>Judul</th>
                                        <th>Penulis</th>
                                        <th>Status</th>
                                        <th>Kategori</th>
                                        <th>Stok</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                        <th>Hapus</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                    @forelse ($books as $book)
                                    <tr>
                                        <td>
                                            @if ($book->cover)
                                                <img src="{{ asset('storage/'.$book->cover) }}" alt="Foto Buku" width="50px">
                                            @else
                                                <img src="{{ asset('assets/dist/img/empty-user.png') }}" alt="Foto Buku" width="50px">
                                            @endif
                                        </td>
                                        <td>{{ ucfirst($book->title) }}</td>
                                        <td>{{ ucfirst($book->author) }}</td>
                                        <td>@if ($book->status == "DRAFT")
                                                <button class="btn" style="background: purple;color: white;">{{ $book->status }}</button>
                                            @else
                                                <button class="btn" style="background: brown;color: white;">{{ $book->status }}</button>
                                            @endif
                                        </td>
                                        <td>
                                            <ul class="pl-3">
                                                @foreach ($book->categories as $category)
                                                    <li>{{ $category->name }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td> {{ $book->stock }} </td>
                                        <td> {{ $book->price }} </td>

                                        <td>
                                            <a href="{{ route('books.edit', [$book->id]) }}" class="btn btn-warning" style="margin-right:10px;"><i class="fa fa-pencil"></i> Edit</a>
                                            <a href="{{ route('books.show', [$book->id]) }}" class="btn btn-info"><i class="fa fa-eye"></i> Detail</a>
                                            {{-- <a href="{{ route('books.restore', [$book->id]) }}" class="btn btn-default"><i class="fa fa-window-restore"></i> Restore</a> --}}
                                        </td>
                                        <td>
                                                <form
                                                    method="POST" 
                                                    action="{{route('books.delete-permanent', [$book->id])}}"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Hapus Buku Permanent?')"
                                                    >

                                                    @csrf 
                                                    <input type="hidden" name="_method" value="DELETE">

                                                    <input type="submit" value="Delete" class="btn btn-danger">
                                                </form>

                                            <form 
                                                method="POST"
                                                action="{{route('books.restore', [$book->id])}}"
                                                class="d-inline"
                                                >

                                                @csrf 
                                                <input type="submit" value="Restore" class="btn btn-success"/>
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
                                            <th>Cover Buku</th>
                                            <th>Judul</th>
                                            <th>Penulis</th>
                                            <th>Status</th>
                                            <th>Kategori</th>
                                            <th>Stok</th>
                                            <th>Harga</th>
                                            <th>Aksi</th>
                                            <th>Hapus</th>
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