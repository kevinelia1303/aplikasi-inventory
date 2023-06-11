@extends('layout.v_template')
@section('title', 'Stock Opname')
@section('content')
    <h1>Detail Stock Opname</h1>
    <div class="content">
        <div class="row">
            <div class="col-sm-6">
            <div class="modal-body">
                <div class="form-group">
                    <label>ID Stock Opname : {{ $so->ID_Transaksi }}</label>
                </div>
                <div class="form-group">
                    <label>Tanggal : {{ $so->Tanggal }}</label>
                </div>
                <div class="form-group">
                    <label>Barang : {{ $item[0]->id_barang }}</label>
                </div>
                <div class="form-group">
                    <label>Lokasi : {{ $item[0]->id_lokasi }}</label>
                </div>
                <div class="form-group">
                    <label>Total Panjang : {{ formatTotal($so->total_panjang) }} yard</label>
                </div>
            </div>  
            <h5>List Barang</h5>
             
              <!-- /.row -->
            </div>
        </div>
        <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th style="border:1px solid">QR Code</th>
                      <th style="border:1px solid">ID Barang</th>
                      <th style="border:1px solid">Jumlah (Yard)</th>
                      <th style="border:1px solid">Lokasi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($item as $data )
                    <tr>
                      <td>{{ $data->barcode }}</td>
                      <td>{{ $data->id_barang }}</td>
                      <td>{{ formatTotal($data->jumlah) }}</td>
                      <td>{{ $data->id_lokasi }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
    </div>     
@endsection