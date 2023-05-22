@extends('layout.v_template')
@section('title', 'GI Penjualan')
@section('content')
    <h1>Detail Goods Issue Penjualan</h1>
    <a href="/gipenjualan/printsj/{{ $gipenjualan->ID_Transaksi }}" target="_blank" class="btn btn-primary">Print Surat Jalan</a>
    <a href="/gipenjualan/printpl/{{ $gipenjualan->ID_Transaksi }}" target="_blank" class="btn btn-primary">Print Packing List</a>    
    <div class="content">
        <div class="row">
            <div class="col-sm-6">
            <div class="modal-body">
                <div class="form-group">
                    <label>ID Goods Issue : {{ $gipenjualan->ID_Transaksi }}</label>
                </div>
                <div class="form-group">
                    <label>ID Purchase Order : {{ $gipenjualan->id_sales }}</label>
                </div>
                <div class="form-group">
                    <label>Tanggal : {{ $gipenjualan->Tanggal }}</label>
                </div>
                <div class="form-group">
                    <label>Customer : {{ $gipenjualan->customer }}</label>
                </div>
                <div class="form-group">
                    <label>Total Panjang : {{ formatTotal($gipenjualan->total_panjang)}} yard</label>
                </div>
                <div class="form-group">
                    <label>Total Roll : {{ $gipenjualan->total_roll }}</label>
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
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($item as $data )
                    <tr>
                      <td>{{ $data->BARCODE }}</td>
                      <td>{{ $data->ID_BARANG }}</td>
                      <td>{{ $data->JUMLAH }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
    </div>  
@endsection