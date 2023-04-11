@extends('layout.v_template')
@section('title', 'Add Supplier')
@section('content')
    <h1>Add Supplier</h1>
    <form action="/supplier/insert" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="content">
        <div class="row">
            <div class="col-sm-6">
                <div class="modal-body">
                <div class="form-group">
                    <label>Nama Supplier</label>
                    <input type="text" class="form-control" name="nama_supplier" placeholder="Nama Supplier .." required>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" class="form-control" name="alamat" placeholder="Alamat .." required>
                </div>
                <div class="form-group">
                    <label>No Telepon</label>
                    <input type="text" class="form-control" name="no_telepon" placeholder="No Telepon .." required>
                </div>
                <div class="form-group">
                    <label>Contact Person</label>
                    <input type="text" class="form-control" name="contact_person" placeholder="Contact Person .." required>
                </div>
                <div class="form-group">
                    <label>Provinsi</label>
                    <select class="form-control" data-width="100%" name="provinsi" id="provinsi" required>
                        <option value="" hidden>-- Pilih Provinsi --</option>
                        @foreach ($provinsi as $data)
                            <option value="{{ $data->id }}">{{ $data->name_prov }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Kota</label>
                    <select class="form-control" data-width="100%" name="kota" id="kota" required>
                        <option value="" hidden>-- Pilih Kota --</option>
                        @foreach ($kota as $data)
                            <option value="{{ $data->id }}">{{ $data->name_regency }}</option>
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