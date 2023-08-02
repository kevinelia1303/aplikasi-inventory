@extends('layout.v_template')
@section('title', 'PO DF')
@section('content')
    <h1>Edit Purchase Order Maklon Dyeing Finishing</h1> 
    <div class="card card-info">
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="/pomaklondf/update/{{ $podf->id_PurchaseOrder }}" >
                @csrf
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">ID Purchase Order</label>
                    <div class="col-sm-10">
                      <input readonly value="{{ $podf->id_PurchaseOrder }}" type="text" class="form-control" name="id_PurchaseOrder" placeholder="ID Purchase Order .." required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-10">
                      <input readonly value="{{ $podf->tanggal }}" type="date"  class="form-control" name="tanggal" required>
                    </div>
                  </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Supplier</label>
                    <div class="col-sm-10">
                    <div class="input-group-prepend">
                        <input readonly value="{{ $podf->nama_supplier }}" type="text" readonly class="form-control" id="id_supplier" name="id_supplier" placeholder="id_supplier">
                    </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Total Harga</label>
                    <div class="col-sm-10">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                            <input readonly value="{{ $podf->total_harga }}" type="text" readonly class="form-control" id="total_harga" name="total_harga" placeholder="Total Harga ..">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Jenis Bayar</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="jenis_bayar" required>
                        <option {{ $podf->jenis_bayar == 'Kredit' ? 'selected' : '' }} value="Kredit">Kredit</option>
                        <option {{ $podf->jenis_bayar == 'Cash' ? 'selected' : '' }} value="Cash">Cash</option>
                    </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Sending Term</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="shipment" required>
                        <option {{ $podf->shipment == 'Partial Shipment' ? 'selected' : '' }} value="Partial Shipment">Partial Shipment</option>
                        <option {{ $podf->shipment == 'Full Shipment' ? 'selected' : '' }} value="Full Shipment">Full Shipment</option>
                    </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="status" required>
                        <option {{ $podf->status == 'Done' ? 'selected' : '' }} value="Done">Done</option>
                        <option {{ $podf->status == 'In Progress' ? 'selected' : '' }} value="In Progress">In Progress</option>
                    </select>
                    </div>
                  </div>
                <div class="form-group">
                    <input type="submit" value="Submit">
                </div> 
                </div>
                <div class="row">
                <div class="col-12 table-responsive">
                    <h5>List Barang</h5>
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
                    @foreach ($item as $datas )
                    
                    <tr>
                      <td hidden>
                        <input type="" value="{{ $datas->id  }}" name="id[]" id="id"  required>
                      </td>
                      <td style="border:1px solid;width:50%;" contenteditable="true">
                          <input type="text"  value="{{ $datas->id_barang }}" class="form-control" name="id_barang[]" id="id_barang" required>
                      </td>
                      <td style="border:1px solid">
                        <input type="text"  value="{{ $datas->jumlah }}" class="form-control" name="jumlah[]" id="jumlah" required>
                      </td>
                      <td style="border:1px solid">
                        <input type="text"  value="{{ $datas->harga }}" class="form-control" name="harga[]" id="harga" name="harga" required>
                      </td>
                      <td style="border:1px solid" >
                        <input readonly type="text"  value="{{ $datas->TotalHarga }}" class="form-control" name='total[]' id="total" required>
                      </td>
                      <td></td>
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
                      <th>Sisa</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($list_kebutuhan as $data )
                    <tr>
                      <td>{{ $data->id_barang }}</td>
                      <td>{{ $data->jumlah }}</td>
                      <td>{{ $data->sisa }}</td>
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