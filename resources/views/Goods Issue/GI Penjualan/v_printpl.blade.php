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
    <!-- title row -->
    
    <!-- info row -->
    {{-- <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        <h4>Kepada</h4> 
        <address>
            <h4>{{ $gipenjualan->customer }}</h4>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>Tanggal : {{ $gipenjualan->Tanggal }}</b><br>
        <br>
        <b>Order ID:</b> {{ $gipenjualan->id_sales }}<br>
      </div>
      <!-- /.col -->
    </div> --}}
    <!-- /.row -->

    <!-- Table row -->
    @foreach ($totalItem as $item)
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
          <center>
            Packing List
          </center>
        </h2>
      </div>
      <!-- /.col -->
    </div>
        <div class="row">
      <div class="col-12">
        <table class="table">
          <tr>
            <th colspan='4'style="border:2px solid">Customer : {{ $item->customer }}</th>
            <th colspan='3' style="border:2px solid">ID Goods Issue : {{ $item->ID_Transaksi }}</th>
            <th colspan='3' style="border:2px solid">Tanggal : {{ $item->Tanggal }}</th>
          </tr>
          <tr >
            <th colspan='3' style="border:2px solid">Nama Kain : {{ $item->keterangan1 }}</th>
            <th colspan='2' style="border:2px solid">Warna : {{ $item->keterangan2 }}</th>
            <th colspan='1' style="border:2px solid">Grade : {{ $item->keterangan3 }}</th>
            <th colspan='2' style="border:2px solid">Jumlah Yard : {{ formatTotal($item->total_panjang) }}</th>
            <th colspan='2' style="border:2px solid">Jumlah Roll : {{ $item->total_roll }}</th>
          </tr>
          
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
            <td style="border:1px solid">{{ formatTotal($data->JUMLAH) }}</td>
            @if (($key + 1) % 10 == 0)
              </tr>
            @endif
            @endforeach\
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    @endforeach
    
    
    <!-- /.row -->
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<!-- Page specific script -->
<script>
  window.addEventListener("load", window.print());
</script>
</body>
</html>
