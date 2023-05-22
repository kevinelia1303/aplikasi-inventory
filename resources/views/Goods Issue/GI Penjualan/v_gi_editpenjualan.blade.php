@extends('layout.v_template')
@section('title', 'Barang')
@section('content')
    <h1>Edit Goods Issue Penjualan</h1>
    <div class="card card-info">
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="/gipenjualan/update/{{ $gipenjualan->ID_Transaksi }}" >
                @csrf
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">ID Goods Issue</label>
                    <div class="col-sm-10">
                      <input readonly value="{{ $gipenjualan->ID_Transaksi }}" type="text" class="form-control" name="id_PurchaseOrder" placeholder="ID Purchase Order .." required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">ID Sales Order</label>
                    <div class="col-sm-10">
                      <input readonly value="{{ $gipenjualan->id_sales }}" type="text" class="form-control" name="id_PurchaseOrder" placeholder="ID Purchase Order .." required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-10">
                      <input readonly value="{{ $gipenjualan->Tanggal }}" type="date"  class="form-control" name="tanggal" required>
                    </div>
                  </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Customer</label>
                    <div class="col-sm-10">
                    <div class="input-group-prepend">
                        <input readonly value="{{ $gipenjualan->customer }}" type="text" readonly class="form-control" id="id_supplier" name="id_supplier" placeholder="id_supplier">
                    </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Total Panjang</label>
                    <div class="col-sm-10">
                      <input readonly value="{{ formatTotal($gipenjualan->total_panjang) }}" type="text" readonly class="form-control" id="total_harga" name="total_harga" placeholder="Total Harga .."> 
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Total Roll</label>
                    <div class="col-sm-10">
                      <input readonly type="text" value="{{ $gipenjualan->total_roll }}" class="form-control" name="jenis_bayar" placeholder="Total Roll ..">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="status" required>
                        <option {{ $gipenjualan->status == 'Terkirim' ? 'selected' : '' }} value="Terkirim">Terkirim</option>
                        <option {{ $gipenjualan->status == 'Persiapan Kirim' ? 'selected' : '' }} value="Persiapan Kirim">Persiapan Kirim</option>
                    </select>
                    </div>
                  </div>
                
                <div class="form-group">
                    <input type="submit" value="Submit">
                </div> 
                </div>
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
              </form>
              
    </div>    
@endsection