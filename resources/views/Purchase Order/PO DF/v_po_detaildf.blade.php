@extends('layout.v_template')
@section('title', 'PO DF')
@section('content')
    <h1>Detail Purchase Order Maklon Dyeing Finishing</h1>
    <div class="content">
        <div class="row">
            <div class="col-sm-6">
            <div class="modal-body">
                <div class="form-group">
                    <label>ID Purchase Order : {{ $podf->id_PurchaseOrder }}</label>
                </div>
                <div class="form-group">
                    <label>Tanggal : {{ $podf->tanggal }}</label>
                </div>
                <div class="form-group">
                    <label>Supplier : {{ $podf->nama_supplier }}</label>
                </div>
                <div class="form-group">
                    <label>Total Harga : {{ formatRupiah($podf->total_harga) }}</label>
                </div>
                <div class="form-group">
                    <label>Jenis Bayar : {{ $podf->jenis_bayar }}</label>
                </div>
                <div class="form-group">
                    <label>Sending Term : {{ $podf->shipment }}</label>
                </div>
                <div>
                    <label>Status : {{ $podf->status }}</label>
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
                      <th>ID Barang</th>
                      <th>Jumlah (Yard)</th>
                      <th>Harga (Per Yard)</th>
                      <th>Total Harga</th>
                      <th>Sudah Diterima</th>
                      <th>Belum Diterima</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($item as $data )
                    <tr>
                      <td>{{ $data->id_barang }}</td>
                      <td>{{ formatTotal($data->jumlah) }}</td>
                      <td>{{ formatRupiah($data->harga) }}</td>
                      <td>{{ formatRupiah($data->TotalHarga) }}</td>
                      <td>{{ formatTotal(($data->jumlah)-($data->sisa)) }}</td>
                      <td>{{ formatTotal($data->sisa) }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <div class="row">
                <div class="col-12 table-responsive">
                  <h5>List Kebutuhan Maklon</h5>
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>ID Barang</th>
                      <th>Total Yard</th>
                      <th>Sudah Terkirim</th>
                      <th>Belum Terkirim</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($list_kebutuhan as $data )
                    <tr>
                      <td>{{ $data->id_barang }}</td>
                      <td>{{ formatTotal($data->jumlah) }}</td>
                      <td>{{ formatTotal($data->sisa) }}</td>
                      <td>{{ formatTotal(($data->jumlah)-($data->sisa)) }}</td>
                      <td>{{ formatTotal($data->sisa) }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
    </div>       
@endsection