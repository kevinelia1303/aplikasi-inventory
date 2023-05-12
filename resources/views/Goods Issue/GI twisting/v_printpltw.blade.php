<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ITJ | Packing List</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-master/') }}/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-master/') }}/dist/css/adminlte.min.css">
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
          <center>
            Packing List
          </center>
        </h2>
      </div>
      
      <div class="col-4">
        <h5>
        PT Indotex Tripadu Jaya<br>
        KP. Garung RT 001 RW 007 Pataruman<br>
        Cihampelas Kab Bandung Barat
        </h5>
        </div>
        <div class="col-4"></div>
      <div class="col-4">
        <h5>
        No Goods Issue : {{ $totalItem[0]->ID_Transaksi }}<br>
        Tanggal : {{ $totalItem[0]->Tanggal }}
        </h5>
      </div>
      
      <!-- /.col -->
    </div>
    <hr color="black" size="10px"/>
    <div class="col-12">
        <h6>Tujuan : {{ $totalItem[0]->nama_supplier }}</h6>
        <h6>Alamat : {{ $totalItem[0]->alamat }}</h6>
        <h6>Kota : {{ $totalItem[0]->name_regency }}</h6>
    </div>
    <hr color="black" size="10px"/>
    @foreach ($totalItem as $item)
    
    <div class="row">
        
        <div class="col-12">
            <h6>{{ $item->id_barang }}</h6>
        </div>
      

        <table class="table">
          
          <tbody>
            <tr>
              <td  style="border:2px solid;width:10%;">1</td>
              <td  style="border:2px solid;width:10%;">2</td>
              <td  style="border:2px solid;width:10%;">3</td>
              <td  style="border:2px solid;width:10%;">4</td>
              <td  style="border:2px solid;width:10%;">5</td>
              <td  style="border:2px solid;width:10%;">6</td>
              <td  style="border:2px solid;width:10%;">7</td>
              <td  style="border:2px solid;width:10%;">8</td>
              <td  style="border:2px solid;width:10%;">9</td>
              <td  style="border:2px solid;width:10%;">10</td>
            </tr>
            <tr>
            @foreach ($a->where('id_barang','=',$item->id_barang) as $key => $data)
            @if ($key % 10 == 0)
              <tr>
            @endif
            <td style="border:1px solid">{{ $data->total_panjang }}</td>
            @if (($key + 1) % 10 == 0)
              </tr>
            @endif
            @endforeach
          </tbody>
        </table>
        <div class="col-4">
            <h5>Total : {{ $item->total_panjang }}</h5>
        </div>
        <div class="col-4"></div>
            <div class="col-4">
                <h5>Total Roll : {{ $item->total_roll }}</h5>
            </div>
      
      
      <!-- /.col -->
    </div>
    <hr color="black" size="10px"/>
    @endforeach
    
    
    <!-- /.row -->
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<div class="row">
      <!-- accepted payments column -->
      <div class="col-4">
        <h5>Bagian Gudang</h5>
        <br>
        <br>
        <br><br>
      </div>
      <!-- /.col -->
      <div class="col-4">
      </div>
      <div class="col-4">
        <h5>Penerima</h5>
      </div>
      <!-- /.col -->
    </div>
<!-- ./wrapper -->
<!-- Page specific script -->
<script>
  window.addEventListener("load", window.print());
</script>
</body>
</html>
