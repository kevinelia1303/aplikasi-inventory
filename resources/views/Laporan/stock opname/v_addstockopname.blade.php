@extends('layout.v_template')
@section('title', 'Stock Opname')
@section('content')
    <h1>Add Stock Opname Awal</h1>
    <form method="post" action="{{ route('submitDataSO') }}" class="form-horizontal">
                @csrf
                <div class="card-body">
                  <input type="hidden" value="{{ Auth::user()->id }}" name="id_user" required>
                  <input type="hidden" value="TAMBAH" name="TRANSAKSI" >
                  
                   <div class="form-group row">
                    <label class="col-sm-2 col-form-label">ID Stock Opname</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="id_Transaksi"  value="{{ 'SG'.date('Y').'-'.date('m').$kd }}"  required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-10">
                      <input type="date"  class="form-control" name="tanggal" required>
                    </div>
                  </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">ID Barang</label>
                    <div class="col-sm-10"> 
                      <select class="form-control" id="id_barangg" name="id_barangg" required>
                        <option  value="" hidden>-- Pilih Barang --</option>
                          @foreach ($barang as $data)
                            <option value='{{ $data->id_barang }}'>{{ $data->id_barang }}</option>
                          @endforeach
                    </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Lokasi</label>
                    <div class="col-sm-10"> 
                      <select class="form-control" id="id_lokasi" name="id_lokasi" required>
                        <option  value="" hidden>-- Pilih Lokasi --</option>
							@foreach ($gudang as $data)
								<option value='{{ $data->kode_gudang }}'>{{ $data->kode_gudang }}</option>
							@endforeach
                    </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Total Panjang</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control" id="total_panjang" name="total_panjang" placeholder="Total Panjang ..">
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" value="Submit">
                </div> 
                </div>
                <div class="row">
                <div class="col-12 table-responsive">
                    <h5>List Barang</h5>
                    <div class="row">
                        <div class="col-4">
                            <div id="reader" width="600px"></div>
                        </div>
                    </div>
                    
                  <table class="table table-striped" id="tabel1">
                    <thead>
                    <tr >
                      
                      <th style="border:1px solid">Kode Barang</th>
                      {{-- <th style="border:1px solid">ID Barang</th> --}}
                      <th style="border:1px solid">Jumlah (Yard)</th>
                      {{-- <th style="border:1px solid">Lokasi</th> --}}
                      <th style="border:1px solid">
                            <a href="javascript:;" class="btn btn-info addRow">+</a></th>
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
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="{{ asset('AdminLTE-master/') }}/plugins/select2/js/select2.full.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
<script>
  $(document).ready(function() {
        $('#id_barang').select2();
        $('#id_barangg').select2();
        $('#id_supplier').select2();
    });
</script>
<script>
    $(document).ready(function () {
        let baris = 0;
        $('thead').on('click', '.addRow', function () {
            baris = baris + 1
            var html = "<tr style='border:1px solid' id='baris'" +baris+  ">"
                html += "<td style='border:1px solid;width:40%;'>"
                html += "<input type='text' size=40 name='kode_barang[]' id='result" +baris+"'>"
                html += "</td>"
                // html += "<td style='border:1px solid;width:30%;'>"
                // html += "<select style='width:100%;' class='form-control' name='id_barang[]' class='id_barang' id='id_barang"+baris+"' required>"
                // html += "<option value='' hidden>-- Pilih Barang --</option>"
                // html += "@foreach ($barang as $data)"
                // html += "<option value='{{ $data->id_barang }}'>{{ $data->id_barang }}</option>"
                // html += "@endforeach"
                // html += "</select>"
                // html += "</td>"
                html += "<td style='border:1px solid'>"
                html += "<input type='number' class='form-control' name='jumlah[]' id='jumlah" +baris+"' required>"
                html += "</td>"
                // html += "<td style='border:1px solid;width:15%;'>"
                // html += "<select class='form-control' name='kode_gudang[]' class='kode_gudang' id='kode_gudang"+baris+"' required>"
                // html += "<option value='' hidden>-- Pilih Gudang --</option>"
                // html += "@foreach ($gudang as $data)"
                // html += "<option value='{{ $data->kode_gudang }}'>{{ $data->kode_gudang }}</option>"
                // html += "@endforeach"
                // html += "</select>"
                // html += "</td>"
                html +="<td style='border:1px solid'><a href='javascript:;'' class='btn btn-danger deleteRow'>-</a></td>"
                html += "</tr>"
            console.log(html);
            $('#tabel1').append(html);
            $('#id_barang'+baris).select2();
            // document.getElementById('total_roll').value = baris;
            
            console.log(baris);
            $(document).ready(function(){
              $("#jumlah"+baris).keyup(function() {
                var arr = document.getElementsByName('jumlah[]');
                var tot=0;
                for(var i=0;i<arr.length;i++){
                  if(parseInt(arr[i].value))
                      tot += parseInt(arr[i].value);
                }
                document.getElementById('total_panjang').value = tot;
                var table = document.getElementById("tabel1");
                var totalRowCount = table.rows.length;
                var rows = totalRowCount - 1;
                console.log(totalRowCount);
                document.getElementById('total_roll').value = rows;
              });
            });
            $(document).ready(function(){
              $('tbody').on('click','.deleteRow', function () {
              var row = rows-1;
              console.log(row);
              document.getElementById('total_roll').value = row;
              $(this).parent().parent().remove();
            }); 
            })
            
        });
        function onScanSuccess(decodedText, decodedResult) {
  // handle the scanned code as you like, for example:
//   console.log(`Code matched = ${decodedText}`, decodedResult);
  $("#result"+baris).val(decodedText)
}

function onScanFailure(error) {
  // handle scan failure, usually better to ignore and keep scanning.
  // for example:
  console.warn(`Code scan error = ${error}`);
}

let html5QrcodeScanner = new Html5QrcodeScanner(
  "reader",
  { fps: 10, qrbox: {width: 250, height: 250} },
  /* verbose= */ false);
html5QrcodeScanner.render(onScanSuccess, onScanFailure); 
        
    });
    $('tbody').on('click','.deleteRow', function () {
    $(this).parent().parent().remove();
    });

</script>
@endsection