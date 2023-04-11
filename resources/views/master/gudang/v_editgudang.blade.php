@extends('layout.v_template')
@section('title', 'Edit Gudang')
@section('content')
    <h1>Edit Data Master Gudang</h1>
<form action="/gudang/update/{{ $gudang->kode_gudang }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="content">
        <div class="row">
            <div class="col-sm-6">
                @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Kode Gudang</label>
                    <input type="text" value="{{ $gudang->kode_gudang }}" class="form-control" name="kode_gudang" placeholder="Kode Gudang .." required>
                </div>
                <div class="form-group">
                    <label>Nama Gudang</label>
                    <input type="text" value="{{ $gudang->nama_gudang }}" class="form-control" name="nama_gudang" placeholder="Nama Gudang .." required>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" value="{{ $gudang->alamat }}" class="form-control" name="alamat" placeholder="Alamat .." required>
                </div>
                <div class="form-group">
                    <label>Provinsi</label>
                    <select class="form-control" name="provinsi" id="provinsi" required>
                        <option value="" hidden>-- Pilih Provinsi --</option>
                        @foreach ($provinsi as $data)
                            <option value="{{ $data->id }}" {{ $data->id == $gudang->province_id ? 'selected' : '' }}>{{ $data->name_prov }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Kota</label>
                    <select class="form-control" name="kota" id="kota" required>
                        <option value="" hidden>-- Pilih Kota --</option>
                        @foreach ($kota as $data)
                            <option value="{{ $data->id }}" {{ $data->id == $gudang->regencies_id ? 'selected' : '' }}>{{ $data->name_regency }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <a href="/gudang" class="btn btn-secondary "><i class="fa fa-undo"></i> Close</a>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save changes</button>
            </div>
            </form>     
            
        </div>
    </div>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
     --}}
<script>
    $(document).ready(function() {
        $('#provinsi').select2();
    });
</script>
<script>
    $(document).ready(function() {
        $('#kota').select2();
    });
</script>   
@endsection