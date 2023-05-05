@extends('layout.v_template')
@section('title', 'GR Twisting')
@section('content')
    <h1>Detail Goods Receipt Maklon Twisting</h1>    
    <div class="content">
        <div class="row">
            <div class="col-sm-6">
            <div class="modal-body">
                <div class="form-group">
                    <label>ID Goods Receipt : {{ $grtwisting->ID_Transaksi }}</label>
                </div>
                <div class="form-group">
                    <label>ID Purchase Order : {{ $grtwisting->id_purchaseorder }}</label>
                </div>
                <div class="form-group">
                    <label>Tanggal : {{ $grtwisting->Tanggal }}</label>
                </div>
                <div class="form-group">
                    <label>Supplier : {{ $grtwisting->nama_supplier }}</label>
                </div>
                <div class="form-group">
                    <label>Total Panjang : {{ $grtwisting->total_panjang }} yard</label>
                </div>
                <div class="form-group">
                    <label>Total Roll : {{ $grtwisting->total_roll }}</label>
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
                      <th style="border:1px solid">Lokasi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($item as $data )
                    <tr>
                      <td>{{ $data->Kode_Barang }}</td>
                      <td>{{ $data->id_barang }}</td>
                      <td>{{ $data->total_Panjang }}</td>
                      <td>{{ $data->kode_gudang }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
    </div> 
@endsection