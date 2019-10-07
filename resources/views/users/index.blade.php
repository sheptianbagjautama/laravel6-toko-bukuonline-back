@extends('layouts.global')

@section('title-page')
     Data List Pengguna
@endsection

@section('starter-page')
    Data List Pengguna
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

                    <a href="{{ route('users.create') }}" class="btn btn-info" style="margin-bottom: 10px;">Tambah Data</a>
                        <div class="card">
                                <div class="card-header">
                                  <h3 class="card-title">Pengguna</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                  
                                  <div class="row">
                                        
                                      <div class="col-md-6">
                                            <form action="{{ route('users.index') }}">
                                                <div class="form-group">
                                                        <input 
                                                        type="text" 
                                                        class="form-control" 
                                                        value="{{ Request::get('keyword') }}" 
                                                        id="keyword" 
                                                        name="keyword" 
                                                        placeholder="Filter berdasarkan email">
                                                        
                                                    </div>
                                      </div>

                                      <div class="col-md-1" style="margin-top:5px;">
                                            <div class="form-check">
                                                    <input {{ Request::get('status') == 'ACTIVE' ? 'checked' : '' }}  type="radio" class="form-check-input" id="active" name="status"  value="ACTIVE">
                                                    <label class="form-check-label" for="active">Active</label>
                                            </div>
                                      </div>
                                      <div class="col-md-1" style="margin-top:5px;">
                                            <div class="form-check">
                                                    <input type="radio" {{ Request::get('status') == 'INACTIVE' ? 'checked' : '' }} class="form-check-input" id="inactive" name="status"  value="INACTIVE">
                                                    <label class="form-check-label" for="inactive">Inactive</label>
                                            </div>
                                      </div>


                                      <div class="col-2"><button class="btn btn-info btn-block" type="submit"><i class="fa fa-search"></i> Filter</button></div>
                                    <div class="col-2"><a class="btn btn-info btn-warning btn-block" href="{{ route('users.index') }}"><i class="fa fa-search"></i> Clear</a></div>
                                    </form>
                                  </div>

                                  <table id="pengguna" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                        <th>Hapus</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                    @forelse ($users as $user)
                                    <tr>
                                        <td>{{ ucfirst($user->name) }}</td>
                                        <td>{{ ucfirst($user->username) }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ($user->status == 'ACTIVE')
                                                <button class="btn btn-success">{{ ucfirst($user->status) }}</button>
                                            @else
                                                <button class="btn btn-danger">{{ ucfirst($user->status) }}</button>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->avatar)
                                                <img src="{{ asset('storage/'.$user->avatar) }}" alt="Foto Profil" width="50px">
                                            @else
                                                <img src="{{ asset('assets/dist/img/empty-user.png') }}" alt="Foto Profil" width="50px">
                                            @endif

                                        </td>
                                        <td>
                                            <a href="{{ route('users.edit', [$user->id]) }}" class="btn btn-warning" style="margin-right:10px;"><i class="fa fa-pencil"></i> Edit</a>
                                            <a href="{{ route('users.show', [$user->id]) }}" class="btn btn-info"><i class="fa fa-eye"></i> Detail</a>
                                        </td>
                                        <td>
                                                <form 
                                                action="{{ route('users.destroy', [$user->id]) }}"
                                                onsubmit="return confirm('Hapus data permanen ?')"
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
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Foto</th>
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