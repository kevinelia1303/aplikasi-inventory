@extends('layout.v_template')
@section('title', 'GI Penjualan')
@section('content')
    <h1>Goods Issue Penjualan</h1>
    <form action="/gipenjualan" method="get">
		@csrf
		<div class="row mb-3">
			<div class="col-sm-2">
				<label for="" class="form-label"></label>
				<input type="text" name="ID_Transaksi" class="form-control" placeholder="Cari ID Goods Issue ...">
			</div>
			<div class="col-sm-2">
				<label for="" class="form-label"></label>
				<input type="text" name="id_sales" class="form-control" placeholder="Cari ID Sales ...">
			</div>
			<div class="col-sm-2">
				<label for="" class="form-label"></label>
				<input type="date" placeholder="dd/mm/yyyy" name="tanggal" class="form-control">
			</div>
			<div class="col-sm-2">
				<label for="" class="form-label"></label>
				<input type="text" name="customer" class="form-control" placeholder="Cari Customer ...">
			</div>
			<div class="col-sm-2">
				<button type="submit" class="btn btn-primary mt-4">Search</button>
			</div>
		</div>
	</form>
    @if (session('pesan'))
	<div class="alert alert-success" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		{{ (session('pesan')) }}
	</div>
	@endif
    <div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										
										<a href="/gipenjualan/add" class="btn btn-primary btn-round ml-auto">+ Add Goods Issue Penjualan</a> <br>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="add-row" class="display table table-striped table-hover" >
											<thead>
												<tr>
                                                    <th>ID Transaksi</th>
                                                    <th>ID Sales</th>
													<th>Tanggal</th>
													<th>Customer</th>
													<th>Total Panjang</th>
													<th>Total Roll</th>
													<th>Status</th>
                                                    <th>Action</th>
												</tr>
											</thead>
											
											<tbody>
                                                @foreach ($gipenjualan as $data )
												<tr>
													<td>{{ $data->ID_Transaksi }}</td>
                                                    <td>{{ $data->id_sales  }}</td>
													<td>{{ $data->Tanggal }}</td>
                                                    <td>{{ $data->customer }}</td>
													<td>{{ formatTotal($data->total_panjang)  }}</td>
													<td>{{ $data->total_roll  }}</td>
													<td>{{ $data->status  }}</td>
													@if ( $data->status =="Terkirim")
													<td>
														<a href="/gipenjualan/edit/{{ $data->ID_Transaksi }}"  class="btn disabled btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
														<a href="/gipenjualan/detailgipenjualan/{{ $data->ID_Transaksi }}"  class="btn btn-success btn-xs"><i class="fa fa-info"></i> Detail</a>
													@else
													<td>
														<a href="/gipenjualan/edit/{{ $data->ID_Transaksi }}"  class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
														<a href="/gipenjualan/detailgipenjualan/{{ $data->ID_Transaksi }}"  class="btn btn-success btn-xs"><i class="fa fa-info"></i> Detail</a>
													</td>	
													@endif
													<td></td>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
     
@endsection