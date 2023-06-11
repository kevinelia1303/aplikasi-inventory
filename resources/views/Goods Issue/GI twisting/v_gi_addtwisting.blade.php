@extends('layout.v_template')
@section('title', 'GI Twisting')
@section('content')
    <h1>Add Goods Issue Maklon Twisting</h1>
    <div class="card card-info">
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('submitData6') }}" class="form-horizontal">
                @csrf
                <div class="card-body">
                    <input type="hidden" value="{{ Auth::user()->id }}" name="id_user" required>
                  
                   <div class="form-group row">
                    <label class="col-sm-2 col-form-label">ID Goods Issue</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="id_Transaksi" readonly="" value="{{ 'DM'.date('Y').'-'.date('m').$kd }}" placeholder="ID Goods Issue .." required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">ID Purchase Order</label>
                    <div class="col-sm-10">
                      <input type="text" value="{{ $purchase->id_PurchaseOrder }}" class="form-control" name="id_PurchaseOrder" placeholder="ID Purchase Order .." required>
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
                      <select readonly class="form-control" id="id_supplier" name="id_supplier" required>
                        <option  value="" hidden>-- Pilih Supplier --</option>
                        @foreach ($supplier as $data)
                            <option value="{{ $data->id_supp }}" {{ $data->id_supp == $purchase->id_supplier ? 'selected' : '' }}>{{ $data->nama_supplier }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
                {{-- <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="status" required>
                        <option value="" hidden>-- Pilih Status --</option>
                        <option value="Persiapan Kirim">Persiapan Kirim</option>
                        <option value="Terkirim">Terkirim</option>
                    </select>
                    </div>
                  </div> --}}
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Total Panjang</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control" id="total_panjang" name="total_panjang" placeholder="Total Panjang ..">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Total Roll</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control" id="total_roll" name="total_roll" placeholder="Total Roll ..">
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
                      <th style="border:1px solid">ID Barang</th>
                      <th style="border:1px solid">Jumlah (Yard)</th>
                      <th style="border:1px solid">Lokasi</th>
                      <th style="border:1px solid">Tanggal Masuk</th>
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
      </div>
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
  $(document).ready(function() {
        // $('#id_barang').select2();
        $('#id_supplier').select2();
    });
</script>
<script>
    $(document).ready(function () {
        let baris = 0;
        $('thead').on('click', '.addRow', function () {
            baris = baris + 1
            var html = "<tr style='border:1px solid' id='baris'" +baris+  ">"
                html += "<td style='border:1px solid;width:50%;'>"
                html += "<input type='text' size=40 name='kode_barang[]' id='result" +baris+"'>"
                html += "</td>"
                html += "<td style='border:1px solid;width:30%;'>"
                html += "<div id='detail_barang" +baris+"'></div>"
                html += "</td>"
                html += "<td style='border:1px solid'>"
                html += "<div id='totalpanjang" +baris+"'></div>"
                html += "</td>"
                html += "<td style='border:1px solid;width:10%;'>"
                html += "<div id='kode_gudang"+baris+"'></div>"
                html += "</td>"
                html += "<td style='border:1px solid;width:10%;'>"
                html += "<div id='Tanggal"+baris+"'></div>"
                html += "</td>"
                html +="<td style='border:1px solid'><a href='javascript:;'' class='btn btn-danger deleteRow'>-</a></td>"
                html += "</tr>"
            console.log(html);
            $('#tabel1').append(html);
            // document.getElementById('total_roll').value = baris;
            
            console.log(baris);
            $("#result"+baris).keyup(function(){
                var kode_barang = $("#result"+baris).val();
                $.ajax({
                    type: "GET",
                    url: "/gitwisting/ajax",
                    data: "kode_barang="+kode_barang,
                    cache:false,
                    success: function (data) {
                        $('#detail_barang'+baris).html(data);
                    }
                });
                $.ajax({
                    type: "GET",
                    url: "/gitwisting/ajax1",
                    data: "kode_barang="+kode_barang,
                    cache:false,
                    success: function (data) {
                        $('#totalpanjang'+baris).html(data);
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
                    }
                });
                $.ajax({
                    type: "GET",
                    url: "/ajax-lokasi",
                    data: "kode_barang="+kode_barang,
                    cache:false,
                    success: function (data) {
                        $('#kode_gudang'+baris).html(data);
                    }
                });
                $.ajax({
                    type: "GET",
                    url: "/ajax-tanggal",
                    data: "kode_barang="+kode_barang,
                    cache:false,
                    success: function (data) {
                        $('#Tanggal'+baris).html(data);
                    }
                });
            });
              
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
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
    var kode_barang = $("#result"+baris).val();
    $.ajax({
        type: "GET",
        url: "/gitwisting/ajax",
        data: "kode_barang="+kode_barang,
        cache:false,
        success: function (data) {
            $('#detail_barang'+baris).html(data);
        }
    })
    $.ajax({
        type: "GET",
        url: "/gitwisting/ajax1",
        data: "kode_barang="+kode_barang,
        cache:false,
        success: function (data) {
            $('#totalpanjang'+baris).html(data);
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
        }
    })

    $.ajax({
        type: "GET",
        url: "/ajax-lokasi",
        data: "kode_barang="+kode_barang,
        cache:false,
        success: function (data) {
            $('#kode_gudang'+baris).html(data);
        }
    });
    $.ajax({
        type: "GET",
        url: "/ajax-tanggal",
        data: "kode_barang="+kode_barang,
        cache:false,
        success: function (data) {
            $('#Tanggal'+baris).html(data);
        }
    });
    
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