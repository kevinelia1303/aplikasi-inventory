<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ITJ | Kartu Stok</title>

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
        <center>
        <h2 class="page-header">
          
            Kartu Stok <br> 
          
        </h2>
        <h5>ID Barang : {{ $barang->id_barang }}</h5>
        {{-- @if( {{ $barang->id_jenis_barang  }} = 1)
            <h5>ID Barang : {{ $barang->id_barang }}</h5>
            <h5>Jenis Kain : {{ $barang->keterangan1 }}</h5>
            <h5>Warna : {{ $barang->keterangan2 }}</h5>
            <h5>Grade : {{ $barang->keterangan3 }}</h5>
        @endif --}}
        {{-- @if( {{ $barang->id_jenis_barang  }} = 2)
            <h5>ID Barang : {{ $barang->id_barang }}</h5>
            <h5>Sisir : {{ $barang->keterangan1 }}</h5>
            <h5>Pick : {{ $barang->keterangan2 }}</h5>
            <h5>Lebar : {{ $barang->keterangan3 }}</h5>
            <h5>Gramasi : {{ $barang->keterangan4 }}</h5>
        @endif
        @if( {{ $barang->id_jenis_barang  }} = 3)
            <h5>ID Barang : {{ $barang->id_barang }}</h5>
        @endif --}}
        
        </center>
      </div>
      
      <!-- /.col -->
    </div>
    <div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<div class="table-responsive">
										<table id="add-row" class="display table table-striped table-hover" >
											<thead>
												<tr>
                                                    <th>Tahun</th>
													<th>Bulan</th>
													<th>ID Barang</th>
													<th>Kode Gudang</th>
													<th>Awal</th>
                                                    <th>Masuk</th>
                                                    <th>Keluar</th>
													<th>Akhir</th>
												</tr>
											</thead>
											
											<tbody>
                                                @foreach ($KartuStok as $data )
												<tr>
													<td>{{ $data->TAHUN }}</td>
													<td>{{ $data->BULAN }}</td>
                                                    <td>{{ $data->id_barang }}</td>
													<td>{{ $data->KODE_GUDANG }}</td>
                                                    <td>{{ $data->AWAL }}</td>
                                                    <td>{{ $data->MASUK }}</td>
													<td>{{ $data->KELUAR }}</td>
													<td>{{ $data->AKHIR }}</td>
												</tr>
                                                @endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>  

</div>
<script>
  window.addEventListener("load", window.print());
</script>
</body>
</html>
