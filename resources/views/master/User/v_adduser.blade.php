@extends('layout.v_template')
@section('title', 'Add User')
@section('content')
    <h1>Add Data Master User</h1>
    <form action="/user/insert" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="content">
        <div class="row">
            <div class="col-sm-6">
                <div class="modal-body">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" class="form-control" name="name" placeholder="Nama Lengkap .." required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email .." required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password .." required>
                </div>
                <div class="form-group">
                    <label>Divisi</label>
                    <select class="form-control" name="Divisi" required>
                        <option value="" hidden>-- Pilih Divisi --</option>
                        @foreach ($divisi as $data)
                            <option value="{{ $data->id_divisi }}">{{ $data->nama_divisi }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Jabatan</label>
                    <select class="form-control" name="Jabatan" required>
                        <option value="" hidden>-- Pilih Jabatan --</option>
                        @foreach ($jabatan as $data)
                            <option value="{{ $data->id_jabatan }}">{{ $data->nama_jabatan }}</option>
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