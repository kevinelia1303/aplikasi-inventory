@extends('layout.v_template')
@section('title', 'Gudang')
@section('content')
    <h1>Data Master Gudang</h1>
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
										
										<a href="/gudang/add" class="btn btn-primary btn-round ml-auto">+ Add Gudang</a> <br>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="add-row" class="display table table-striped table-hover" >
											<thead>
												<tr>
                                                    <th>No</th>
													<th>Kode</th>
													<th>Nama Gudang</th>
													<th>Alamat</th>
													<th>Provinsi</th>
													<th>Kota</th>
                                                    <th>Action</th>
												</tr>
											</thead>
											
											<tbody>
                                                @php
                                                    $no=1;
                                                @endphp
                                                @foreach ($gudang as $data )
												<tr>
													<td>{{ $no++ }}</td>
													<td>{{ $data->kode_gudang }}</td>
													<td>{{ $data->nama_gudang }}</td>
                                                    <td>{{ $data->alamat }}</td>
													<td>{{ $data->name_prov  }}</td>
													<td>{{ $data->name_regency  }}</td>
													<td>
														<a href="/gudang/edit/{{ $data->kode_gudang }}"  class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
                                                        <a href="/gudang/delete/{{ $data->kode_gudang }}" data-toggle="modal" class="btn btn-danger btn-xs" data-target="#delete{{ $data->kode_gudang }}"><i class="fa fa-trash"></i> Hapus</a>
													</td>
												</tr>
                                                @endforeach
											</tbody>
										</table>

										@foreach ($gudang as $data)

    
										<div class="modal fade" id="delete{{$data->kode_gudang}}">
											<div class="modal-dialog modal-sm">
											<div class="modal-content bg-danger">
												<div class="modal-header">
													<h4 class="modal-title">{{$data->nama_gudang}}</h4>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<p>Apakah anda yakin delete data ini?&hellip;</p>
												</div>
												<div class="modal-footer justify-content-between">
													<button type="button" class="btn btn-outline-light" data-dismiss="modal">No</button>
													<a href="/gudang/delete/{{$data->kode_gudang}}"  class="btn btn-outline-light">Yes</a>
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