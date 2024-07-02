@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold">Tambah Data Jabatan</h5>
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('jabatan.store') }}">
                            @csrf
                            <div class="mb-4">
                                <label for="id" class="form-label">Id Jabatan</label>
                                <input type="text" class="form-control" id="id" name="id" required
                                    value="{{ old('id') }}">
                                @error('id_jabatan')
                                    <label for="kode" class="text-danger">Id Jabatan sudah terdaftar. Silahkan ganti yang
                                        lain !</label>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="nama" class="form-label">Nama Jabatan</label>
                                <input type="text" class="form-control" id="nama" name="nama" required
                                    value="{{ old('nama') }}">
                            </div>

                            <div class="mb-4">
                                <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
                                <input type="text" class="form-control" id="gaji_pokok" name="gaji_pokok" required
                                value="{{ old('gaji_pokok') }}">
                            </div>

                            <div class="mb-4">
                                <label for="uang_makan" class="form-label">Uang Makan</label>
                                <input type="text" class="form-control" id="uang_makan" name="uang_makan" required
                                value="{{ old('uang_makan') }}">
                            </div>

                            <div class="mb-4">
                                <label for="uang_lembur" class="form-label">Bayaran Lembur per jam</label>
                                <input type="text" class="form-control" id="uang_lembur" name="uang_lembur" required
                                value="{{ old('uang_lembur') }}">
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
