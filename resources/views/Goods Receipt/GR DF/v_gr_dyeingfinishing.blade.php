@extends('layout.v_template')
@section('title', 'GR DF')
@section('content')
    <h1>Goods Receipt Maklon Dyeing Finishing</h1>
    <form action="/grdyeingfinishing" method="get">
		@csrf
		<div class="row mb-3">
			<div class="col-sm-2">
				<label for="" class="form-label"></label>
				<input type="text" name="ID_Transaksi" class="form-control" placeholder="Cari ID Goods Receipt Greige ...">
			</div>
			<div class="col-sm-2">
				<label for="" class="form-label"></label>
				<input type="text" name="id_PurchaseOrder" class="form-control" placeholder="Cari ID PO Greige ...">
			</div>
			<div class="col-sm-2">
				<label for="" class="form-label"></label>
				<input type="date" placeholder="dd/mm/yyyy" name="tanggal" class="form-control">
			</div>
			<div class="col-sm-2">
				<label for="" class="form-label"></label>
				<select class="form-control" id="id_supplier" name="id_supplier">
                        <option value="" hidden>-- Pilih Supplier --</option>
                        @foreach ($supplier1 as $data)
                            <option value="{{ $data->id_supp }}">{{ $data->nama_supplier }}</option>
                        @endforeach
                    </select>
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
										
										<a href="/grdyeingfinishing/add" class="btn btn-primary btn-round ml-auto">+ Add Goods Receipt Maklon DF</a> <br>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="add-row" class="display table table-striped table-hover" >
											<thead>
												<tr>
                                                    <th>ID Transaksi</th>
                                                    <th>ID Purchase Order</th>
													<th>Tanggal</th>
													<th>Supplier</th>
													<th>Total Panjang</th>
													<th>Total Roll</th>
                                                    <th>Action</th>
												</tr>
											</thead>
											
											<tbody>
                                                @foreach ($grdf as $data )
												<tr>
													<td>{{ $data->ID_Transaksi }}</td>
                                                    <td>{{ $data->id_purchaseorder  }}</td>
													<td>{{ $data->Tanggal }}</td>
                                                    <td>{{ $data->nama_supplier }}</td>
													<td>{{ $data->total_panjang  }}</td>
													<td>{{ $data->total_roll  }}</td>
													<td>
														<a href="/grdyeingfinishing/detailgrdf/{{ $data->ID_Transaksi }}"  class="btn btn-success btn-xs"><i class="fa fa-info"></i> Detail</a>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<script>
  $(document).ready(function() {
        $('#id_supplier').select2();
    });
</script>    
@endsection