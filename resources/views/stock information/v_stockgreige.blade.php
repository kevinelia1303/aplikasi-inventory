@extends('layout.v_template')
@section('title', 'Greige')
@section('content')
    <h1>Stok Greige</h1>  
    <form action="/stockgreige" method="get">
        <div class="row">
        <div class="col-xs-7 col-sm-6 col-lg-8">
            <div id="reader" width="600px"></div>
        </div>
        
        <div class="col-xs-7 col-sm-6 col-lg-8">
            <input type="text" id="id_barang" name="id_barang" class="form-control" placeholder="Cari ID Barang ...">
        </div>
        <div class="col-xs-7 col-sm-6 col-lg-8">
            <input type="text" id="kode_barang" name="kode_barang" class="form-control" placeholder="Cari Kode Barang ...">
        </div>
        <div class="col-xs-7 col-sm-6 col-lg-8">
            <button type="submit" class="btn btn-primary mt-4">Search</button>
        </div>
    </div> 
    </form>
    <div class="col-xs-7 col-sm-6 col-lg-8">
            <label>Total Roll :{{ $total_roll }}</label>
    </div>
    <div class="col-xs-7 col-sm-6 col-lg-8">
            <label>Total Yard : {{ $total_panjang }}</label>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="add-row" class="display table table-striped table-hover" >
                <thead>
                    <tr>
                        <th>ID Barang</th>
                        <th>Sisir</th>
                        <th>Pick</th>
                        <th>Lebar</th>
                        <th>Gramasi</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                        <th>Lokasi</th>
                        <th>Kode Barang</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach ($greige as $data )
                    <tr>
                        <td>{{ $data->id_barang }}</td>
                        <td>{{ $data->keterangan1 }}</td>
                        <td>{{ $data->keterangan2 }}</td>
                        <td>{{ $data->keterangan3 }}</td>
                        <td>{{ $data->keterangan4 }}</td>
                        <td>{{ $data->jumlah }}</td>
                        <td>{{ $data->satuan }}</td>
                        <td>{{ $data->id_lokasi }}</td>
                        <td>{{ $data->barcode }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
<script src="https://unpkg.com/html5-qrcode" type="text/javascript">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<script>
    function onScanSuccess(decodedText, decodedResult) {
  // handle the scanned code as you like, for example:
    console.log(`Code matched = ${decodedText}`, decodedResult);
    $("#kode_barang").val(decodedText);
    }

    function onScanFailure(error) {
    // handle scan failure, usually better to ignore and keep scanning.
    // for example:
    console.warn(`Code scan error = ${error}`);
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
    "reader",
    { fps: 10, qrbox: {width: 250, height: 250} },
    /* verbose= */ false);
    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
</script>  
@endsection