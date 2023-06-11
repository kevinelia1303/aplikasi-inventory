@extends('layout.v_template')
@section('title', 'Stock Opname')
@section('content')
<h1>Stock Opname Awal</h1>
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
										
										<a href="/stokopname/add" class="btn btn-primary btn-round ml-auto">+ Add Stock Opname</a> <br>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="add-row" class="display table table-striped table-hover" >
											<thead>
												<tr>
                                                    <th>ID Stock Opname</th>
													<th>Tanggal</th>
													<th>Total Panjang</th>
                                                    <th>Action</th>
												</tr>
											</thead>
											
											<tbody>
                                                @foreach ($so as $data )
												<tr>
													<td>{{ $data->ID_Transaksi }}</td>
													<td>{{ $data->Tanggal }}</td>
                                                    <td>{{ formatTotal($data->total_panjang)  }}</td>
													<td>
                                                        <a href="/stokopname/detailso/{{ $data->ID_Transaksi }}"  class="btn btn-success btn-xs"><i class="fa fa-info"></i> Detail</a>
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