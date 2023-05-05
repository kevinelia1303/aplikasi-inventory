@extends('layout.v_template')
@section('title', 'GI Penjualan')
@section('content')
    <h1>Detail Goods Issue Penjualan</h1>    
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
                    <label>Supplier : {{ $gipenjualan->nama_supplier }}</label>
                </div>
                <div class="form-group">
                    <label>Total Panjang : {{ $gipenjualan->total_panjang }} yard</label>
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
                      <th style="border:1px solid">Kode Barang</th>
                      <th style="border:1px solid">ID Barang</th>
                      <th style="border:1px solid">Jumlah (Yard)</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($item as $data )
                    <tr>
                      <td>{{ $data->Kode_Barang }}</td>
                      <td>{{ $data->id_barang }}</td>
                      <td>{{ $data->total_Panjang }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
    </div>  
@endsection