@extends('layout.v_template')
@section('title', 'PO DF')
@section('content')
    <h1>Add Purchase Order Maklon Dyeing Finishing</h1>
    <div class="card card-info">
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('submitData3') }}" class="form-horizontal">
                @csrf
                <div class="card-body">
                  <input type="hidden" value="{{ Auth::user()->id }}" name="id_user" required>
                  
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">ID Purchase Order</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="id_PurchaseOrder" readonly="" value="{{ 'MF'.date('Y').'-'.date('m').$kd }}" placeholder="ID Purchase Order .." required>
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
                {{-- <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="status" required>
                        <option value="" hidden>-- Pilih Status --</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Done">Done</option>
                    </select>
                    </div>
                  </div> --}}
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
                    <input type="submit" value="Submit">
                </div> 
                </div>
                <div class="row">
                <div class="col-12 table-responsive">
                    <h5>List Barang</h5>
                  <table class="table table-striped" id="tabel1">
                    <thead>
                    <tr >
                      
                      <th style="border:1px solid">ID Barang</th>
                      <th style="border:1px solid">Jumlah (Yard)</th>
                      <th style="border:1px solid">Harga Per Yard</th>
                      <th style="border:1px solid">Total Harga</th>
                      <th style="border:1px solid">
                                <a href="javascript:;" class="btn btn-info addRow">+</a></th>
                            </th> 
                    </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                  </table>
                  
                </div>
                
                <div class="col-12 table-responsive">
                    <h5>List Kebutuhan Maklon</h5>
                  <table class="table table-striped" id="tabel2">
                    <thead>
                    <tr >
                      
                      <th style="border:1px solid">ID Barang</th>
                      <th style="border:1px solid">Total Yard</th>
                      <th style="border:1px solid">
                                <a href="javascript:;" class="btn btn-info addRow1">+</a></th>
                            </th> 
                    </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                  </table>
                  
                </div>
                
                <!-- /.col -->
              </div>
              </form>
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
            var arr = total;
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
        $('thead').on('click', '.addRow', function () {
            baris = baris + 1
            var html = "<tr style='border:1px solid' id='baris'" +baris+  ">"
                
                html +="<td style='border:1px solid;width:30%;'>"
                html += "<select class='form-control' name='id_barang[]' class='id_barang' id='id_barang"+baris+"' required>"
                html += "<option value='' hidden>-- Pilih Barang --</option>"
                html += "@foreach ($fg as $data)"
                html += "<option value='{{ $data->id_barang }}'>{{ $data->id_barang }}</option>"
                html += "@endforeach"
                html += "</select>"
                html += "</td>"
                html += "<td style='border:1px solid'>"
                html += "<input type='text' class='form-control' name='jumlah[]' id='jumlah" +baris+"' required>"
                html += "</td>"
                html += "<td style='border:1px solid'>"
                html += "<input type='text' class='form-control' name='harga[]' id='harga" +baris+"' name='harga' required>"
                html += "</td>"
                html += "<td style='border:1px solid'>"
                html += "<input type='text' readonly class='form-control' name='total[]'  id='total" +baris+"'  required>"
                html += "</td>"
                html +="<td style='border:1px solid'><a href='javascript:;'' class='btn btn-danger deleteRow'>-</a></td>"
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
                var arr = document.getElementsByName('total[]');
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
    $('tbody').on('click','.deleteRow', function () {
    $(this).parent().parent().remove();
    }); 
</script>
<script>
    let baris = 1;
        $('thead').on('click', '.addRow1', function () {
            baris = baris + 1
            var html = "<tr style='border:1px solid' id='baris'" +baris+  ">"
                
                html +="<td style='border:1px solid;width:30%;'>"
                html += "<select class='form-control' name='id_barangmaklon[]' class='id_barang' id='id_barangmaklon"+baris+"' required>"
                html += "<option value='' hidden>-- Pilih Barang --</option>"
                html += "@foreach ($greige as $data)"
                html += "<option value='{{ $data->id_barang }}'>{{ $data->id_barang }}</option>"
                html += "@endforeach"
                html += "</select>"
                html += "</td>"
                html += "<td style='border:1px solid'>"
                html += "<input type='text' class='form-control' name='total_maklon[]'  id='total_maklon" +baris+"'  required>"
                html += "</td>"
                html +="<td style='border:1px solid'><a href='javascript:;'' class='btn btn-danger deleteRow1'>-</a></td>"
                html += "</tr>"
            console.log(html);
            $('#tabel2').append(html);
            $('#id_barangmaklon'+baris).select2();
        });
        $('tbody').on('click','.deleteRow1', function () {
            $(this).parent().parent().remove();
        }); 
</script>
@endsection