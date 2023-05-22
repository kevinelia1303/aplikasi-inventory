@extends('layout.v_template')
@section('title', 'GR DF')
@section('content')
    <h1>Detail Goods Receipt Maklon Dyeing Finishing</h1>
    <div class="content">
        <div class="row">
            <div class="col-sm-6">
            <div class="modal-body">
                <div class="form-group">
                    <label>ID Goods Receipt : {{ $grdf->ID_Transaksi }}</label>
                </div>
                <div class="form-group">
                    <label>ID Purchase Order : {{ $grdf->id_purchaseorder }}</label>
                </div>
                <div class="form-group">
                    <label>Tanggal : {{ $grdf->Tanggal }}</label>
                </div>
                <div class="form-group">
                    <label>Supplier : {{ $grdf->nama_supplier }}</label>
                </div>
                <div class="form-group">
                    <label>Total Panjang : {{ formatTotal($grdf->total_panjang) }} yard</label>
                </div>
                <div class="form-group">
                    <label>Total Roll : {{ formatTotal($grdf->total_roll) }}</label>
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
                      <td>{{ $data->BARCODE }}</td>
                      <td>{{ $data->ID_BARANG }}</td>
                      <td>{{ formatTotal($data->JUMLAH) }}</td>
                      <td>{{ $data->ID_LOKASI }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
    </div>     
@endsection