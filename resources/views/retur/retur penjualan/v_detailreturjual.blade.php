@extends('layout.v_template')
@section('title', 'Retur Beli')
@section('content')
    <h1>Detail Retur Beli</h1>
    
    <a href="/gitwisting/printsj/{{ $gitwisting->ID_Transaksi }}" target="_blank" class="btn btn-primary">Print Surat Jalan</a>
    <a href="/gitwisting/printpl/{{ $gitwisting->ID_Transaksi }}" target="_blank" class="btn btn-primary">Print Packing List</a>      
       
    <div class="content">
        <div class="row">
            <div class="col-sm-6">
            <div class="modal-body">
                <div class="form-group">
                    <label>ID Goods Issue : {{ $gitwisting->ID_Transaksi }}</label>
                </div>
                
                <div class="form-group">
                    <label>Tanggal : {{ $gitwisting->Tanggal }}</label>
                </div>
                <div class="form-group">
                    <label>Supplier : {{ $gitwisting->nama_supplier }}</label>
                </div>
                <div class="form-group">
                    <label>Total Panjang : {{ formatTotal($gitwisting->total_panjang) }} yard</label>
                </div>
                <div class="form-group">
                    <label>Total Roll : {{ $gitwisting->total_roll }}</label>
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
                      <th style="border:1px solid">Keterangan</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($item as $data )
                    <tr>
                      <td>{{ $data->barcode }}</td>
                      <td>{{ $data->id_barang }}</td>
                      <td>{{ formatTotal($data->jumlah) }}</td>
                      <td>{{ $data->keterangan }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
    </div>  
@endsection