@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Tambah Data Jabatan</h5>
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('jabatan.store') }}">
                            @csrf
                            <div class="mb-4">
                                <label for="kode_jabatan" class="form-label">Kode Jabatan</label>
                                <input type="text" class="form-control" id="kode_jabatan" name="kode_jabatan" required
                                    value="{{ old('kode_jabatan') }}">
                                @error('kode_jabatan')
                                    <label for="kode" class="text-danger">Kode Jabatan sudah terdaftar. Silahkan ganti yang
                                        lain !</label>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
                                <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" required
                                    value="{{ old('nama_jabatan') }}">
                            </div>

                            <div class="mb-4">
                                <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
                                <input type="text" class="form-control" id="gaji_pokok" name="gaji_pokok" required>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
