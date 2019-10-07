@extends('layouts.global')

@section('title-page')
     Data Order
@endsection

@section('starter-page')
    Data Order
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
                                action="{{ route('orders.update', [$order->id]) }}" 
                                method="POST">

                            @csrf

                            <input type="hidden" value="PUT" name="_method">


                              <div class="card-body">

                                <div class="form-group">
                                  <label for="name">No. Invoice</label>
                                  <input type="text" class="form-control" value="{{ $order->invoice_number }}" disabled>
                                </div>

                                <div class="form-group">
                                        <label for="name">Pembeli</label>
                                        <input type="text" class="form-control" value="{{ $order->user->name }}" disabled>
                                </div>

                                <div class="form-group">
                                        <label for="name">Tanggal Beli</label>
                                        <input type="text" class="form-control" value="{{ $order->created_at }}" disabled>
                                </div>

                                <div class="form-group">
                                        <label for="">Buku {{ $order->totalQuantity }}</label><br>
                                        @foreach ($order->books as $book)
                                                <li>{{ $book->title }} <b>{{ $book->pivot->quantity }}</b></li>
                                        @endforeach
                                </div>

                                <div class="form-group">
                                        <label for="name">Total Harga</label>
                                        <input type="text" class="form-control" value="{{ $order->total_price }}" disabled>
                                </div>

                                <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" name="status" id="status">
                                            <option {{ $order->status == "SUBMIT" ? "selected" : "" }} value="SUBMIT">SUBMIT</option>
                                            <option {{ $order->status == "PROCESS" ? "selected" : "" }} value="PROCESS">SUBMIT</option>
                                            <option {{ $order->status == "FINISH" ? "selected" : "" }} value="FINISH">SUBMIT</option>
                                            <option {{ $order->status == "CANCEL" ? "selected" : "" }} value="CANCEL">CANCEL</option>
                                        </select>
                                </div>

                              <!-- /.card-body -->
              
                              <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Ubah</button>
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



