@extends('layout.v_template')
@section('title', 'Greige')
@section('content')
    <h1>Data Master Greige</h1>
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
										
										<a href="/greige/addgreige" class="btn btn-primary btn-round ml-auto">+ Add greige</a> <br>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="add-row" class="display table table-striped table-hover" >
											<thead>
												<tr>
                                                    <th>ID Barang</th>
													<th>Jenis Barang</th>
													<th>Sisir</th>
													<th>Pick</th>
													<th>Lebar</th>
                                                    <th>Gramasi</th>
                                                    <th>Satuan</th>
                                                    <th>Action</th>
												</tr>
											</thead>
											
											<tbody>
                                                @foreach ($greige as $data )
												<tr>
													<td>{{ $data->id_barang }}</td>
													<td>{{ $data->jenis_barang }}</td>
                                                    <td>{{ $data->keterangan1 }}</td>
													<td>{{ $data->keterangan2 }}</td>
                                                    <td>{{ $data->keterangan3 }}</td>
                                                    <td>{{ $data->keterangan4 }}</td>
                                                    <td>{{ $data->satuan }}</td>
													<td>
														<a href="/greige/detailgreige/{{ $data->id_barang }}"  class="btn btn-success btn-xs"><i class="fa fa-info"></i> Detail</a>
                                                        <a href="/greige/editgreige/{{ $data->id_barang }}"  class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
                                                        <a href="/greige/deletegreige/{{ $data->id_barang }}" data-toggle="modal" class="btn btn-danger btn-xs" data-target="#delete{{ $data->id_barang }}"><i class="fa fa-trash"></i> Hapus</a>
													</td>
												</tr>
                                                @endforeach
											</tbody>
										</table>
										@foreach ($greige as $data)

    
										<div class="modal fade" id="delete{{$data->id_barang}}">
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
													<a href="/greige/deletegreige/{{$data->id_barang}}"  class="btn btn-outline-light">Yes</a>
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