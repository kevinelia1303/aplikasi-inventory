@extends('layout.v_template')
@section('title', 'Kartu Stok')
@section('content')
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
										<h2>Daftar Kartu Stok</h2> <br>
										<button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#modalCetak" >
											<i class="fa fa-print"></i>
											Cetak Kartu Stok
                                        </button>
										
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="add-row" class="display table table-striped table-hover" >
											<thead>
												<tr>
                                                    <th>Tahun</th>
													<th>Bulan</th>
													<th>ID Barang</th>
													<th>Kode Gudang</th>
													<th>Stok Awal</th>
                                                    <th>Masuk</th>
                                                    <th>Keluar</th>
													<th>Stok Akhir</th>
													<th>Action</th>
												</tr>
											</thead>
											
											<tbody>
                                                @foreach ($KartuStok as $data )
												<tr>
													<td>{{ $data->tahun }}</td>
													<td>{{ $data->bulan }}</td>
                                                    <td>{{ $data->id_barang }}</td>
													<td>{{ $data->kode_gudang }}</td>
                                                    <td>{{ $data->awal }}</td>
                                                    <td>{{ $data->masuk }}</td>
													<td>{{ $data->keluar }}</td>
													<td>{{ $data->akhir }}</td>
													<td><a href="/kartustok/detail/{{ $data->tahun }}-{{ $data->bulan }}-{{ $data->id_barang }}"  class="btn btn-info btn-xs"><i class="fa fa-info"></i> Detail</a></td>
													
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
<div class="modal fade" id="modalCetak" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Cetak Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="GET" target="_blank" enctype="multipart/form-data" action="/laporan_kartuStok/cetak">
            @csrf
            
            <div class="modal-body">
				<div class="form-group">
                    <label>ID Barang</label>
                    <select class='form-control select2' style="width: 100%;" name='id_barang'  id='id_barang' required>
						<option value='' hidden>-- Pilih Barang --</option>
							@foreach ($barang as $data)
								<option value='{{ $data->id_barang }}'>{{ $data->id_barang }}</option>
							@endforeach
					</select>
				</div>
                <div class="form-group">
                    <label>Tahun Awal</label>
                    <input type="text" class="form-control" name="tahun_awal" id="datepicker1" required />
                </div>
				<div class="form-group">
                    <label>Bulan Awal</label>
                    <input type="text" class="form-control" name="bulan_awal" id="datepicker2" required />
                </div>
                <div class="form-group">
                    <label>Tahun Akhir</label>
                    <input type="text" class="form-control" name="tahun_akhir" id="datepicker3" required />
                </div>
				<div class="form-group">
                    <label>Bulan Akhir</label>
                    <input type="text" class="form-control" name="bulan_akhir" id="datepicker4" required />
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i>Close</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i>Cetak Data</button>
            </div>
            </form>     
        </div>
    </div>
</div>	

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="{{ asset('AdminLTE-master/') }}/plugins/select2/js/select2.full.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
<script>
  $(document).ready(function() {
		$('.select2').select2();
    });

$("#datepicker1").datepicker({
    format: "yyyy",
    viewMode: "years", 
    minViewMode: "years",
    autoclose:true //to close picker once year is selected
});

$("#datepicker2").datepicker({
    format: "mm",
    viewMode: "months", 
    minViewMode: "months",
    autoclose:true //to close picker once year is selected
});
$("#datepicker3").datepicker({
    format: "yyyy",
    viewMode: "years", 
    minViewMode: "years",
    autoclose:true //to close picker once year is selected
});
$("#datepicker4").datepicker({
    format: "mm",
    viewMode: "months", 
    minViewMode: "months",
    autoclose:true //to close picker once year is selected
});
</script>	 
@endsection