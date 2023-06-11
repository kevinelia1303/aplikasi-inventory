@extends('layout.v_template')
@section('title', 'GR Greige')
@section('content')
    <h1>Detail Goods Receipt Purchase Order Greige</h1>
    <div class="content">
        <div class="row">
            <div class="col-sm-6">
            <div class="modal-body">
                <div class="form-group">
                    <label>ID Goods Receipt : {{ $grpogreige->ID_Transaksi }}</label>
                </div>
                <div class="form-group">
                    <label>ID Purchase Order : {{ $grpogreige->id_purchaseorder }}</label>
                </div>
                <div class="form-group">
                    <label>Tanggal : {{ $grpogreige->Tanggal }}</label>
                </div>
                <div class="form-group">
                    <label>Supplier : {{ $grpogreige->nama_supplier }}</label>
                </div>
                <div class="form-group">
                    <label>Total Panjang : {{ formatTotal($grpogreige->total_panjang) }} yard</label>
                </div>
                <div class="form-group">
                    <label>Total Roll : {{ formatTotal($grpogreige->total_roll) }}</label>
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