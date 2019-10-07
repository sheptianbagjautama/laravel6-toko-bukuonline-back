@extends('layouts.global')

@section('title-page')
     Data List Order
@endsection

@section('starter-page')
    Data List Order
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

                    {{-- <a href="{{ route('orders.create') }}" class="btn btn-info" style="margin-bottom: 10px;">Tambah Data</a> --}}
                        <div class="card">
                                <div class="card-header">
                                  <h3 class="card-title">Order</h3>
                                </div>

                                <!-- /.card-header -->
                                <div class="card-body">
                                  
                                  <div class="row">
                                        
                                        <div class="col-md-4">
                                            <form action="{{ route('orders.index') }}">
                                                <div class="form-group">
                                                        <input 
                                                        type="text" 
                                                        class="form-control" 
                                                        value="{{ Request::get('buyer_email') }}" 
                                                        id="buyer_email" 
                                                        name="buyer_email" 
                                                        placeholder="Filter berdasarkan email pembeli">
                                                        
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                            <div class="form-group">
                                                                <select name="status" class="form-control" id="status">
                                                                        <option value="">ANY</option>
                                                                        <option {{Request::get('status') == "SUBMIT" ? "selected" : ""}} value="SUBMIT">SUBMIT</option>
                                                                        <option {{Request::get('status') == "PROCESS" ? "selected" : ""}} value="PROCESS">PROCESS</option>
                                                                        <option {{Request::get('status') == "FINISH" ? "selected" : ""}} value="FINISH">FINISH</option>
                                                                        <option {{Request::get('status') == "CANCEL" ? "selected" : ""}} value="CANCEL">CANCEL</option>
                                                                </select>
                                                                </div>
                                                            </div>


                                      <div class="col-2"><button class="btn btn-info btn-block" type="submit"><i class="fa fa-search"></i> Filter</button></div>
                                    <div class="col-2"><a class="btn btn-info btn-warning btn-block" href="{{ route('orders.index') }}"><i class="fa fa-search"></i> Clear</a></div>
                                    </form>
                                  </div>

                                  <table id="pengguna" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>No Invoice</th>
                                        <th>Status</th>
                                        <th>Pembeli</th>
                                        <th>Total Quantity</th>
                                        <th>Tanggal Order</th>
                                        <th>Total Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                    @forelse ($orders as $order)
                                    <tr>
                                        <td>{{ $order->invoice_number }}</td>
                                        <td>@if ($order->status == "SUBMIT")
                                                <button class="btn btn-warning" >{{ $order->status }}</button>
                                            @elseif($order->status == "PROCESS")
                                                <button class="btn btn-info" >{{ $order->status }}</button>
                                            @elseif($order->status == "FINISH")
                                                <button class="btn btn-success" >{{ $order->status }}</button>
                                            @elseif($order->status == "CANCEL")
                                                <button class="btn btn-danger"  >{{ $order->status }}</button>
                                            @endif
                                        </td>
                                        <td>{{ $order->user->name }} <br> <small>{{ $order->user->email }}</small></td>
                                        <td>{{$order->totalQuantity}} pc (s)</td>
                                        <td>{{$order->created_at}}</td>
                                        <td>{{ $order->total_price }}</td>
                                        <td><a href="{{route('orders.edit', [$order->id])}}" class="btn btn-info btn-sm"> Edit</a></td>
                                        {{-- <td>{{ ucfirst($order->name) }}</td>
                                        <td>{{ $order->slug }}</td>
                                        <td>
                                            @if ($order->image)
                                                <img src="{{ asset('storage/'.$order->image) }}" alt="Foto Kategori" width="50px">
                                            @else
                                                <img src="{{ asset('assets/dist/img/empty-user.png') }}" alt="Foto Kategori" width="50px">
                                            @endif

                                        </td>
                                        <td>
                                            <a href="{{ route('orders.edit', [$order->id]) }}" class="btn btn-warning" style="margin-right:10px;"><i class="fa fa-pencil"></i> Edit</a>
                                            <a href="{{ route('orders.show', [$order->id]) }}" class="btn btn-info"><i class="fa fa-eye"></i> Detail</a>
                                        </td>
                                        <td>
                                                <form 
                                                action="{{ route('orders.destroy', [$order->id]) }}"
                                                onsubmit="return confirm('Hapus data ke tong sampah ?')"
                                                method="POST">

                                                @csrf

                                                <input type="hidden" name="_method" value="DELETE">

                                                
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</button>
                                            </form>
                                        </td>
                                        </tr> --}}
                                    @empty
                                        <tr>
                                            <td colspan="5">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                    
                                    </tbody>
                                    <tfoot>
                                            <tr>
                                                    <th>No Invoice</th>
                                                    <th>Status</th>
                                                    <th>Pembeli</th>
                                                    <th>Total Quantity</th>
                                                    <th>Tanggal Order</th>
                                                    <th>Total Harga</th>
                                                    <th>Aksi</th>
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