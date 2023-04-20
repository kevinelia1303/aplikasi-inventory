@extends('layout.v_template')
@section('title', 'Detail Benang')
@section('content')
    <h1>Detail Data Master Benang</h1> 
    <div class="content">
        <div class="row">
            <div class="col-sm-6">
            <div class="modal-body">
                <div class="form-group">
                    <label>ID Barang : {{ $benang->id_barang }}</label>
                </div>
                <div class="form-group">
                    <label>Satuan : {{ $benang->satuan }}</label>
                </div>
                <div class="form-group">
                    <label>Jenis Barang : {{ $benang->jenis_barang }}</label>
                </div>
                <div class="form-group">
                    <label>Total Roll : </label>
                </div>
                <div class="form-group">
                    <label>Total Yard : </label>
                </div>
            </div>  
            <h5>List Ketersediaan Barang</h5>
             
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
                      <th>Jumlah</th>
                      <th>Lokasi #</th>
                      <th>Tanggal Masuk</th>
                      <th>Kode Barang</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td>1</td>
                      <td>Call of Duty</td>
                      <td>455-981-221</td>
                      <td>El snort testosterone trophy driving gloves handsome</td>
                      <td>$64.50</td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
    </div>   
@endsection