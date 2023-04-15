@extends('layout.v_template')
@section('title', 'PO Benang')
@section('content')
    <h1>Purchase Order Benang</h1>
	{{-- <form action="/filterdata" method="get">
	<div class="row mb-3">
		<div class="col-sm-2">
			<input type="text" name="id_PurchaseOrder" class="form-control" placeholder="Cari ID Purchase Order ...">
		</div>
		<div class="col-sm-2">
			<input type="date" placeholder="dd/mm/yyyy" name="tanggal" class="form-control">
		</div>
		<div class="col-sm-2">
			<select class="form-control" name="level" required>
				<option value="" hidden>-- Pilih Status --</option>
				<option value="In Progress">In Progress</option>
				<option value="Done">Done</option>
            </select>
		</div>
		<div class="col-sm-2">
			<button type="submit" class="btn btn-primary mt-4">Search</button>
		</div>
	</div>
	</form> --}}
	<form action="/pobenang" method="get">
		@csrf
		<div class="row mb-3">
			<div class="col-sm-3">
				<label for="" class="form-label"></label>
				<input type="text" name="id_PurchaseOrder" class="form-control" placeholder="Cari ID Purchase Order ...">
			</div>
			<div class="col-sm-3">
				<label for="" class="form-label"></label>
				<input type="date" placeholder="dd/mm/yyyy" name="tanggal" class="form-control">
			</div>
			<div class="col-sm-3">
				<label for="" class="form-label"></label>
				<select class="form-control" name="status" >
					<option value="" hidden>-- Pilih Status --</option>
					<option value="In Progress">In Progress</option>
					<option value="Done">Done</option>
				</select>
			</div>
			<div class="col-sm-3">
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
										
										<a href="/pobenang/add" class="btn btn-primary btn-round ml-auto">+ Add Purchase Order Benang</a> <br>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="add-row" class="display table table-striped table-hover" >
											<thead>
												<tr>
                                                    <th>ID Purchase Order</th>
													<th>Tanggal</th>
													<th>Supplier</th>
													<th>Total Harga</th>
													<th>Status</th>
													<th>Jenis Pembayaran</th>
                                                    <th>Action</th>
												</tr>
											</thead>
											
											<tbody>
                                                @foreach ($pobenang as $data )
												<tr>
													<td>{{ $data->id_PurchaseOrder }}</td>
													<td>{{ $data->tanggal }}</td>
                                                    <td>{{ $data->nama_supplier }}</td>
													<td>{{ $data->total_harga  }}</td>
													<td>{{ $data->status  }}</td>
                                                    <td>{{ $data->jenis_bayar  }}</td>
													<td>
														<a href="/pobenang/edit/{{ $data->id_PurchaseOrder }}"  class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
                                                        <a href="/pobenang/detailpobenang/{{ $data->id_PurchaseOrder }}"  class="btn btn-success btn-xs"><i class="fa fa-info"></i> Detail</a>
													</td>
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
@endsection