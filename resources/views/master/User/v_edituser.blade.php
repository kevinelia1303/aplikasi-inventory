@extends('layout.v_template')
@section('title', 'Barang')
@section('content')
    <h1>Edit Data Master User</h1>

<form action="/user/update/{{ $user->id }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="content">
        <div class="row">
            <div class="col-sm-6">
                @csrf
            <input type="hidden" value="{{ $user->id }}" name="id"  required>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" value="{{ $user->name }}" class="form-control" name="name" placeholder="Nama Lengkap .." required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" value="{{ $user->email }}" class="form-control" name="email" placeholder="Email .." required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password .." >
                </div>
                <div class="form-group">
                    <label>Divisi</label>
                    <select class="form-control" name="Divisi" required>
                        <option value="" hidden>-- Pilih Divisi --</option>
                        @foreach ($divisi as $data)
                            <option value="{{ $data->id_divisi }}" {{ $data->id_divisi == $user->id_divisi ? 'selected' : '' }}>{{ $data->nama_divisi }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Jabatan</label>
                    <select class="form-control" name="Jabatan" required>
                        <option value="" hidden>-- Pilih Divisi --</option>
                        @foreach ($jabatan as $data)
                            <option value="{{ $data->id_jabatan }}" {{ $data->id_jabatan == $user->id_jabatan ? 'selected' : '' }}>{{ $data->nama_jabatan }}</option>
                        @endforeach
                    </select>
                </div>
                
            </div>

            <div class="modal-footer">
                <a href="/user" class="btn btn-secondary "><i class="fa fa-undo"></i> Close</a>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save changes</button>
            </div>
            </form>     
            
        </div>
    </div>
</form>
@endsection