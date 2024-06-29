@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Ubah Hari Libur</h5>
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('karyawan.store') }}">
                            @csrf
                            <div class="mb-4">
                                <label for="nama_karyawan" class="form-label">Keterangan</label>
                                <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan" required
                                    value="{{ old('nama_karyawan') }}">
                                @error('nama_karyawan')
                                    <label for="kode" class="text-danger">Kode karyawan sudah terdaftar. Silahkan ganti yang
                                        lain !</label>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="tanggal_lahir" class="form-label">Tanggal Mulai</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required
                                    value="{{ old('tanggal_lahir') }}">
                            </div>

                            <div class="mb-4">
                                <label for="tanggal_lahir" class="form-label">Tanggal Selesai</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required
                                    value="{{ old('tanggal_lahir') }}">
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
