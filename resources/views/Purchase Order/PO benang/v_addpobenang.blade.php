@extends('layout.v_template')
@section('title', 'Add PO Benang')
@section('content')
    <h1>Add Purchase Order Benang</h1>
    <!-- /.card -->
            <!-- Horizontal Form -->
            <div class="card card-info">
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">ID Purchase Order</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="id_PurchaseOrder" placeholder="ID Purchase Order .." required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-10">
                      <input type="date"  class="form-control" name="tanggal" required>
                    </div>
                  </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Supplier</label>
                    <div class="col-sm-10">
                    <select class="form-control" id="id_supplier" name="id_supplier" required>
                        <option value="" hidden>-- Pilih Supplier --</option>
                        @foreach ($supplier as $data)
                            <option value="{{ $data->id_supp }}">{{ $data->nama_supplier }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Total Harga</label>
                    <div class="col-sm-10">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                            <input type="text" readonly class="form-control" id="total_harga" name="total_harga" placeholder="Total Harga ..">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="status" placeholder="Status ..">
                    </div>
                  </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Jenis Bayar</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="jenis_bayar" required>
                        <option value="" hidden>-- Pilih Jenis Pembayaran --</option>
                        <option value="Kredit">Kredit</option>
                        <option value="Cash">Cash</option>
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-sm">Simpan</button>
                </div> 
                </div>
                
                
                </div>
               
              </form>
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped" id="tabel1">
                    <thead>
                    <tr >
                      <th style="border:1px solid">No</th>
                      <th style="border:1px solid">ID Barang</th>
                      <th style="border:1px solid">Jumlah</th>
                      <th style="border:1px solid">Harga</th>
                      <th style="border:1px solid">Total Harga</th>
                      <th style="border:1px solid">Action</th> 
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td style="border:1px solid">1</td>
                      <td style="border:1px solid;width:50%;" contenteditable="true">
                         <select class="form-control" class="id_barang" id="id_barang" name="id_barang" required>
                            <option value="" hidden>-- Pilih Barang --</option>
                            @foreach ($benang as $data)
                                <option value="{{ $data->id_barang }}">{{ $data->id_barang }}</option>
                            @endforeach
                          </select>
                      </td>
                      <td style="border:1px solid">
                        <input type="text" class="form-control" id="jumlah" name="jumlah" required>
                      </td>
                      <td style="border:1px solid">
                        <input type="text" class="form-control" id="harga" name="harga" required>
                      </td>
                      <td style="border:1px solid" >
                        <input type="text" readonly class="form-control" id="total" name="total" required>
                      </td>
                      <td style="border:1px solid"><button class="btn-sm btn-danger" id="hapus">-</button></td>
                    </tr>
                    </tbody>
                  </table>
                  <button class="btn btn-primary btn-btn-lg" id="tambah">+</button>
                </div>
                
                <!-- /.col -->
              </div>
            </div> 


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
  $(document).ready(function() {
        $('#id_barang').select2();
    });
  $(document).ready(function() {
      $('#id_supplier').select2();
  });
</script>
<script>
  $(document).ready(function(){
        $("#harga").keyup(function() {
            var jumlah = $("#jumlah").val();
            var harga = $("#harga").val();
            console.log(parseInt(jumlah));
            console.log(harga);
            var total = parseInt(harga) * parseInt(jumlah);
            $("#total").val(total);
            var arr = document.getElementsByName('total');
            var tot=0;
            for(var i=0;i<arr.length;i++){
              if(parseInt(arr[i].value))
                  tot += parseInt(arr[i].value);
            }
            document.getElementById('total_harga').value = tot;
        });
    });
</script>  
<script>
    $(document).ready(function () {
        let baris = 1;
        $(document).on('click', '#tambah', function () {
            baris = baris + 1
            var html = "<tr style='border:1px solid' id='baris'" +baris+  ">"
                html +="<td style='border:1px solid'>"+baris+"</td>"
                html +="<td style='border:1px solid;width:30%;'>"
                html += "<select class='form-control' class='id_barang' id='id_barang"+baris+"' name='id_barang' required>"
                html += "<option value='' hidden>-- Pilih Barang --</option>"
                html += "@foreach ($benang as $data)"
                html += "<option value='{{ $data->id_barang }}'>{{ $data->id_barang }}</option>"
                html += "@endforeach"
                html += "</select>"
                html += "</td>"
                html += "<td style='border:1px solid'>"
                html += "<input type='text' class='form-control' id='jumlah" +baris+"' name='jumlah' required>"
                html += "</td>"
                html += "<td style='border:1px solid'>"
                html += "<input type='text' class='form-control' id='harga" +baris+"' name='harga' required>"
                html += "</td>"
                html += "<td style='border:1px solid'>"
                html += "<input type='text' readonly class='form-control' id='total" +baris+"' name='total' required>"
                html += "</td>"
                html +="<td style='border:1px solid'> <button class='btn-sm btn-danger' data-row='baris' id='hapus'>-</button> </td>"
                html += "</tr>"
            console.log(html);
            $('#tabel1').append(html);
            $('#id_barang'+baris).select2();
            $(document).ready(function(){
              $("#harga"+baris).keyup(function() {
                var jumlah = $("#jumlah"+baris).val();
                var harga = $("#harga"+baris).val();
                console.log(parseInt(jumlah));
                console.log(harga);
                var total = parseInt(harga) * parseInt(jumlah);
                $("#total"+baris).val(total);
                var arr = document.getElementsByName('total');
                var tot=0;
                for(var i=0;i<arr.length;i++){
                  if(parseInt(arr[i].value))
                      tot += parseInt(arr[i].value);
                }
                document.getElementById('total_harga').value = tot;
              });
            });
            
        });
        
    });
    $(document).on('click', '#hapus', function () {
            let hapus = $(this).data('row')
            $('#' + hapus).remove()
    });
    
    
</script> 

@endsection