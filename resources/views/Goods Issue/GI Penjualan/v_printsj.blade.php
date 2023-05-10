<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Invoice Print</title>

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
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
          Surat Jalan
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
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
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
          <thead >
          <tr >
            <th style="border:2px solid">Jenis Kain</th>
            <th style="border:2px solid">Warna</th>
            <th style="border:2px solid">Jumlah Yard</th>
            <th style="border:2px solid">Jumlah Roll</th>
          </tr>
          </thead>
          <tbody>
          @foreach ($item as $data )
            <tr>
                <td style="border:1px solid">{{ $data->keterangan1 }}</td>
                <td style="border:1px solid">{{ $data->keterangan2 }}</td>
                <td style="border:1px solid">{{ $data->total_panjang }}</td>
                <td style="border:1px solid">{{ $data->total_roll }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <div class="row">
      <!-- accepted payments column -->
      <div class="col-4">
        <h5>Tanga Tangan yang terima,</h5>
        <br>
        <br>
        <br><br>
      </div>
      <!-- /.col -->
      <div class="col-4">
        <h5>Mengetahui,</h5>
      </div>
      <div class="col-4">
        <h5>Hormat Kami,</h5>
      </div>
      <!-- /.col -->
    </div>
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
