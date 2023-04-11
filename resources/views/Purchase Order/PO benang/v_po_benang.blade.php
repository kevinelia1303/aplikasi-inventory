@extends('layout.v_template')
@section('title', 'PO Benang')
@section('content')
    <h1>Purchase Order Benang</h1>
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
                                                        <a href="/pobenang/detailfg/{{ $data->id_PurchaseOrder }}"  class="btn btn-success btn-xs"><i class="fa fa-info"></i> Detail</a>
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