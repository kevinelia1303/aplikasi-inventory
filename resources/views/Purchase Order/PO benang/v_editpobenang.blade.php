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
                    <label class="col-sm-2 col-form-label">Jenis Bayar</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="jenis_bayar" required>
                        <option {{ $po->jenis_bayar == 'Kredit' ? 'selected' : '' }} value="Kredit">Kredit</option>
                        <option {{ $po->jenis_bayar == 'Cash' ? 'selected' : '' }} value="Cash">Cash</option>
                    </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Sending Term</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="shipment" required>
                        <option {{ $po->shipment == 'Partial Shipment' ? 'selected' : '' }} value="Partial Shipment">Partial Shipment</option>
                        <option {{ $po->shipment == 'Full Shipment' ? 'selected' : '' }} value="Full Shipment">Full Shipment</option>
                    </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="status" required>
                        <option {{ $po->status == 'Done' ? 'selected' : '' }} value="Done">Done</option>
                        <option {{ $po->status == 'In Progress' ? 'selected' : '' }} value="In Progress">In Progress</option>
                    </select>
                    </div>
                  </div>
                
                <div class="form-group">
                    <input type="submit" value="Submit">
                </div> 
                </div>
                <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped" id="tabel1">
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
              </form>
              
    </div>  


    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
     --}}

@endsection