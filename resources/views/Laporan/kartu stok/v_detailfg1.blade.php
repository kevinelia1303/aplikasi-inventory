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
                  @if(substr( $detail->id_barang,0,1)=='F')
                    <h6>Jenis Kain : {{ $detail->keterangan1 }}</h6>
                    <h6>Warna : {{ $detail->keterangan2 }}</h6>
                    <h6>Bulan {{ $detail->bulan }} Tahun {{ $detail->tahun }}</h6>
                  @elseif(substr( $detail->id_barang,0,3)=='ITJ')
                    <h6>Sisir : {{ $detail->keterangan1 }}</h6>
                    <h6>Pick : {{ $detail->keterangan2 }}</h6>
                    <h6>Lebar : {{ $detail->keterangan2 }}</h6>
                    <h6>Gramasi : {{ $detail->keterangan2 }}</h6>
                    <h6>Bulan {{ $detail->bulan }} Tahun {{ $detail->tahun }}</h6>
                  @else
                    <h6>Yarn Count : {{ $detail->keterangan1 }}</h6>
                    <h6>Composition : {{ $detail->keterangan2 }}</h6>
                    <h6>Yarn Type : {{ $detail->keterangan2 }}</h6>
                    <h6>Bulan {{ $detail->bulan }} Tahun {{ $detail->tahun }}</h6>
                  @endif
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
                <h3 class="card-title">Transaksi</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID Transaksi</th>
                    <th>Date</th>
                    <th>ID Barang</th>
                    <th>Receipt</th>
                    <th>Issue</th>
                    <th>Balance</th>
                    {{-- <th>Balance</th> --}}
                  </tr>
                  </thead>
                  <tbody>
                      @foreach ($gr as $data )
                    <tr>
                      @if (substr( $data->id_tran,0,2)=='RG')
                      <td>
                        <a href="/grpogreige/detailgrgreige/{{ $data->id_tran }}" > {{ $data->id_tran }}</a><br>
                        <h6>{{ $data->nama_supplier }} ({{ $data->id_purchaseorder }})</h6>
                      </td>
                      @elseif (substr( $data->id_tran,0,2)=='RM')
                      <td>
                        <a href="/grtwisting/detailgrtwisting/{{ $data->id_tran }}"> {{ $data->id_tran }}</a>
                        <h6>{{ $data->nama_supplier }} ({{ $data->id_purchaseorder }})</h6>
                      </td>
                      @elseif (substr( $data->id_tran,0,2)=='RY')
                      <td>
                        <a href="/grpobenang/detailgrbenang/{{ $data->id_tran }}"> {{ $data->id_tran }}</a>
                        <h6>{{ $data->nama_supplier }} ({{ $data->id_purchaseorder }})</h6>
                      </td>
                      @elseif (substr( $data->id_tran,0,2)=='RJ')
                      <td>
                        <a href="/grdyeingfinishing/detailgrdf/{{ $data->id_tran }}"> {{ $data->id_tran }}</a>
                        <h6>PT Indotex Lasindo Jaya ({{ $data->id_purchaseorder }})</h6>
                      </td>
                      @elseif (substr( $data->id_tran,0,2)=='JF')
                      <td>
                        <a href="/gipenjualan/detailgipenjualan/{{ $data->id_tran }}" > {{ $data->id_tran }}</a>
                        <h6>{{ $data->customer }} ({{ $data->id_sales }})</h6>
                      </td>
                      @elseif (substr( $data->id_tran,0,2)=='DM')
                      <td>
                        <a href="/gitwisting/detailgitwisting/{{ $data->id_tran }}"> {{ $data->id_tran }}</a>
                        <h6>{{ $data->nama_supplier }} ({{ $data->id_purchaseorder }})</h6>
                      </td>
                      @elseif (substr( $data->id_tran,0,2)=='DF')
                      <td>
                        <a href="/gidf/detailgidf/{{ $data->id_tran }}"> {{ $data->id_tran }}</a>
                        <h6>{{ $data->nama_supplier }} ({{ $data->id_purchaseorder }})</h6>
                      </td>
                      @endif
                      <td>{{ $data->Tanggal }}</td>
                      <td>{{ $data->id_barang }}</td>

                      @if ($data->transaksi=='KURANG')
                        <td>-</td>
                        <td>{{ $data->total }}</td>
                        @foreach ($bal->where("id_tran","=",$data->id_tran)->sortBy('balance')->slice(0,1) as $key => $data )
                        <td>{{ $data->balance }}</td>
                      @endforeach
                      @else
                        <td>{{ $data->total }}</td>
                        <td>-</td>
                        @foreach ($bal->where("id_tran","=",$data->id_tran)->sortByDesc('balance')->slice(0,1) as $key => $data )
                        <td>{{ $data->balance }}</td>
                      @endforeach
                      @endif
                      {{-- <td>{{ $data->total + $detail->awal }}</td> --}}
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