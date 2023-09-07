@extends('layout.v_template')
@section('title', 'Kartu Stok')
@section('content')
<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h2>Detail Mutasi Stok {{ $detail->id_barang }}</h2> <br>                 
									</div>
                    <h4>Bulan {{ $detail->bulan }} Tahun {{ $detail->tahun }}</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
    <div class="card-footer">
      <div class="row">
        <div class="col-sm-3 col-6">
          <div class="description-block border-right">
            <span class="description-text">Stok Awal Bulan</span>
            <h5 class="description-header">{{ $detail->awal }}</h5>
          </div>
          <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-sm-3 col-6">
          <div class="description-block border-right">
            <span class="description-text">Total Masuk</span>
            <h5 class="description-header">{{ $detail->masuk }}</h5>
          </div>
          <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-sm-3 col-6">
          <div class="description-block border-right">
            <span class="description-text">Total Keluar</span>
            <h5 class="description-header">{{ $detail->keluar }}</h5>
          </div>
          <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-sm-3 col-6">
          <div class="description-block">
            <span class="description-text">Stok Akhir Bulan</span>
            <h5 class="description-header">{{ $detail->akhir }}</h5>
          </div>
          <!-- /.description-block -->
        </div>
      </div>
      <!-- /.row -->
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Goods Receipt</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID Transaksi</th>
                    <th>Date</th>
                    <th>ID Barang</th>
                    <th>Total</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($gr as $data )
                    <tr>
                      <td>{{ $data->id_tran }}</td>
                      <td>{{ $data->Tanggal }}</td>
                      <td>{{ $data->id_barang }}</td>
                      <td>{{ $data->total }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Goods Issue</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID Transaksi</th>
                    <th>Date</th>
                    <th>ID Barang</th>
                    <th>Total</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($gi as $data )
                    <tr>
                      <td>{{ $data->id_tran }}</td>
                      <td>{{ $data->Tanggal }}</td>
                      <td>{{ $data->id_barang }}</td>
                      <td>{{ $data->total }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
			</div>
		</div>  
@endsection