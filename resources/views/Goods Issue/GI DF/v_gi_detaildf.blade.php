@extends('layout.v_template')
@section('title', 'GI DF')
@section('content')
    <h1>Detail Goods Issue Maklon Dyeing Finishing</h1>
    <a href="/gidf/printsj/{{ $gidf->ID_Transaksi }}" target="_blank" class="btn btn-primary">Print Surat Jalan</a>
    <a href="/gidf/printpl/{{ $gidf->ID_Transaksi }}" target="_blank" class="btn btn-primary">Print Packing List</a>      
    <div class="content">
        <div class="row">
            <div class="col-sm-6">
            <div class="modal-body">
                <div class="form-group">
                    <label>ID Goods Issue : {{ $gidf->ID_Transaksi }}</label>
                </div>
                <div class="form-group">
                    <label>ID Purchase Order : {{ $gidf->id_purchaseorder }}</label>
                </div>
                <div class="form-group">
                    <label>Tanggal : {{ $gidf->Tanggal }}</label>
                </div>
                <div class="form-group">
                    <label>Supplier : {{ $gidf->nama_supplier }}</label>
                </div>
                <div class="form-group">
                    <label>Total Panjang : {{ $gidf->total_panjang }} yard</label>
                </div>
                <div class="form-group">
                    <label>Total Roll : {{ $gidf->total_roll }}</label>
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