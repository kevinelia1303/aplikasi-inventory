@extends('layout.v_template')
@section('title', 'FG')
@section('content')
    <h1>Data Master Finished Goods</h1>
	<form action="/finished-goods" method="get">
		@csrf
		<div class="row mb-3">
			<div class="col-sm-3">
				<label for="" class="form-label"></label>
				<input type="text" name="id_barang" class="form-control" placeholder="Cari ID Barang ...">
			</div>
			<div class="col-sm-3">
				<label for="" class="form-label"></label>
				<input type="text" name="nama" class="form-control" placeholder="Cari Nama Kain ...">
			</div>
			<div class="col-sm-3">
				<label for="" class="form-label"></label>
				<input type="text" name="warna" class="form-control" placeholder="Cari Warna ...">
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
										@if (auth()->user()->id_divisi == 1 )
										<a href="/finished-goods/addfg" class="btn btn-primary btn-round ml-auto">+ Add Finsihed Goods</a> <br>
										@endif
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="add-row" class="display table table-striped table-hover" >
											<thead>
												<tr>
                                                    <th>ID Barang</th>
													<th>Jenis Barang</th>
													<th>Nama Kain</th>
													<th>Warna</th>
													<th>Grade</th>
                                                    <th>Satuan</th>
                                                    <th>Action</th>
												</tr>
											</thead>
											
											<tbody>
                                                @foreach ($finished_goods as $data )
												<tr>
													<td>{{ $data->id_barang }}</td>
													<td>{{ $data->jenis_barang }}</td>
                                                    <td>{{ $data->keterangan1 }}</td>
													<td>{{ $data->keterangan2 }}</td>
                                                    <td>{{ $data->keterangan3 }}</td>
                                                    <td>{{ $data->satuan }}</td>
													<td>
														@if (auth()->user()->id_divisi == 2 OR auth()->user()->id_divisi == 3 )
														<a href="/finished-goods/detailfg/{{ $data->id_barang }}"  class="btn btn-success btn-xs"><i class="fa fa-info"></i> Detail</a>
														@else
														<a href="/finished-goods/detailfg/{{ $data->id_barang }}"  class="btn btn-success btn-xs"><i class="fa fa-info"></i> Detail</a>
                                                        <a href="/finished-goods/editfg/{{ $data->id_barang }}"  class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
                                                        <a href="/finished-goods/deletefg/{{ $data->id_barang }}" data-toggle="modal" class="btn btn-danger btn-xs" data-target="#delete{{ $data->id }}"><i class="fa fa-trash"></i> Hapus</a>
														@endif
													</td>
												</tr>
                                                @endforeach
											</tbody>
										</table>
										@foreach ($finished_goods as $data)

    
										<div class="modal fade" id="delete{{$data->id}}">
											<div class="modal-dialog modal-sm">
											<div class="modal-content bg-danger">
												<div class="modal-header">
													<h4 class="modal-title">{{$data->id_barang}}</h4>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<p>Apakah anda yakin delete data ini?&hellip;</p>
												</div>
												<div class="modal-footer justify-content-between">
													<button type="button" class="btn btn-outline-light" data-dismiss="modal">No</button>
													<a href="/finished-goods/deletefg/{{$data->id_barang}}"  class="btn btn-outline-light">Yes</a>
												</div>
											</div>
											<!-- /.modal-content -->
											</div>
											<!-- /.modal-dialog -->
										</div>

										@endforeach
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>   
@endsection