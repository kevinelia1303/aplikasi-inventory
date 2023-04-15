@extends('layout.v_template')
@section('title', 'Edit PO Benang')
@section('content')
    <h1>Edit Purchase Order Benang</h1>
    <div class="card card-info">
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="/pobenang/update/{{ $po->id_PurchaseOrder }}" >
                @csrf
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">ID Purchase Order</label>
                    <div class="col-sm-10">
                      <input readonly value="{{ $po->id_PurchaseOrder }}" type="text" class="form-control" name="id_PurchaseOrder" placeholder="ID Purchase Order .." required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-10">
                      <input readonly value="{{ $po->tanggal }}" type="date"  class="form-control" name="tanggal" required>
                    </div>
                  </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Supplier</label>
                    <div class="col-sm-10">
                    <div class="input-group-prepend">
                        <input readonly value="{{ $po->nama_supplier }}" type="text" readonly class="form-control" id="id_supplier" name="id_supplier" placeholder="id_supplier">
                    </div>
                    {{-- <select disabled class="form-control" id="id_supplier" name="id_supplier" required>
                        <option value="" hidden>-- Pilih Supplier --</option>
                        @foreach ($supplier as $data)
                            <option value="{{ $data->id_supp }} {{ $data->id_supp == $po->id_supplier ? 'selected' : '' }}">{{ $data->nama_supplier }}</option>
                        @endforeach
                    </select> --}}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Total Harga</label>
                    <div class="col-sm-10">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                            <input readonly value="{{ $po->total_harga }}" type="text" readonly class="form-control" id="total_harga" name="total_harga" placeholder="Total Harga ..">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                      <input type="text" value="{{ $po->status }}" class="form-control" name="status" placeholder="Status ..">
                    </div>
                  </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Jenis Bayar</label>
                    <div class="col-sm-10">
                      <input readonly type="text" value="{{ $po->jenis_bayar }}" class="form-control" name="jenis_bayar" placeholder="Status ..">
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
                      <th>ID Barang</th>
                      <th>Jumlah (Yard)</th>
                      <th>Harga (Per Yard)</th>
                      <th>Total Harga</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($item as $data )
                    <tr>
                      <td>{{ $data->id_barang }}</td>
                      <td>{{ $data->jumlah }}</td>
                      <td>{{ $data->harga }}</td>
                      <td>{{ $data->TotalHarga }}</td>
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