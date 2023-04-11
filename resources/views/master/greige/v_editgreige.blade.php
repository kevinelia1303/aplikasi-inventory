@extends('layout.v_template')
@section('title', 'Edit Greige')
@section('content')
    <h1>Edit Data Master Greige</h1>
    <form action="/greige/updategreige/{{ $greige->id_barang }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="content">
        <div class="row">
            <div class="col-sm-6">
                @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>ID Barang</label>
                    <input type="text" value="{{ $greige->id_barang }}" class="form-control" name="id_barang" placeholder="ID Barang .." required>
                </div>
                <div class="form-group">
                    <label>Sisir</label>
                    <input type="text" value="{{ $greige->keterangan1 }}" class="form-control" name="keterangan1" placeholder="Sisir.." required>
                </div>
                <div class="form-group">
                    <label>Pick</label>
                    <input type="text" value="{{ $greige->keterangan2 }}" class="form-control" name="keterangan2" placeholder="Pick .." required>
                </div>
                <div class="form-group">
                    <label>Lebar</label>
                    <input type="text" value="{{ $greige->keterangan3 }}" class="form-control" name="keterangan3" placeholder="Lebar .." required>
                </div>
                <div class="form-group">
                    <label>Gramasi</label>
                    <input type="text" value="{{ $greige->keterangan4 }}" class="form-control" name="keterangan4" placeholder="Gramasi .." required>
                </div>
                <div class="form-group">
                    <label>Satuan</label>
                    <select class="form-control" name="id_satuan" required>
                        <option value="" hidden>-- Pilih Satuan --</option>
                        @foreach ($satuan as $data)
                            <option value="{{ $data->id_satuan }}" {{ $data->id_satuan == $greige->id_satuan ? 'selected' : '' }}>{{ $data->satuan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Jenis Barang</label>
                    <select class="form-control" name="id_jenis_barang" required>
                        <option value="" hidden>-- Pilih Jenis Barang --</option>
                        @foreach ($jenis_barang as $data)
                            <option value="{{ $data->id_jenis_barang }}" {{ $data->id_jenis_barang == $greige->id_jenis_barang ? 'selected' : '' }}>{{ $data->jenis_barang }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <a href="/greige" class="btn btn-secondary "><i class="fa fa-undo"></i> Close</a>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save changes</button>
            </div>
            </form>     
            
        </div>
    </div>
</form>     
@endsection