@extends('layout.v_template')
@section('title', 'Add Benang')
@section('content')
    <h1>Add Data Master Benang</h1>
    <form action="/benang/insertbenang" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="content">
        <div class="row">
            <div class="col-sm-6">
                <div class="modal-body">
                <div class="form-group">
                    <label>ID Barang</label>
                    <input type="text" class="form-control" name="id_barang" placeholder="ID Barang .." required>
                </div>
                <div class="form-group">
                    <label>Yarn Count</label>
                    <input type="text" class="form-control" name="keterangan1" placeholder="Yarn Count .." required>
                </div>
                <div class="form-group">
                    <label>Composition</label>
                    <input type="text" class="form-control" name="keterangan2" placeholder="Composition .." required>
                </div>
                <div class="form-group">
                    <label>Yarn Type</label>
                    <input type="text" class="form-control" name="keterangan3" placeholder="Yarn Type .." required>
                </div>
                <div class="form-group">
                    <label>Satuan</label>
                    <select class="form-control" name="id_satuan" required>
                        <option value="" hidden>-- Pilih Satuan --</option>
                        @foreach ($satuan as $data)
                            <option value="{{ $data->id_satuan }}">{{ $data->satuan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Jenis Barang</label>
                    <select class="form-control" name="id_jenis_barang" required>
                        <option value="" hidden>-- Pilih Jenis Barang --</option>
                        @foreach ($jenis_barang as $data)
                            <option value="{{ $data->id_jenis_barang }}">{{ $data->jenis_barang }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </div>
            
        </div>
    </div>
</form>           
@endsection