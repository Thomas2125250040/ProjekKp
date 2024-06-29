@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Edit Username</h5>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('karyawan.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="kode_karyawan" class="form-label">Kode Karyawan</label>
                            <input type="text" class="form-control" id="kode_karyawan" name="kode_karyawan" required
                                value="{{ old('kode_karyawan') }}">
                            @error('kode_karyawan')
                                <label for="kode" class="text-danger">Kode karyawan sudah terdaftar. Silahkan ganti yang
                                    lain !</label>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="nama_karyawan" class="form-label">Username</label>
                            <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan" required
                                value="{{ old('nama_karyawan') }}">
                            @error('nama_karyawan')
                                <label for="kode" class="text-danger">Kode karyawan sudah terdaftar. Silahkan ganti yang
                                    lain !</label>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Hak Akses</label>
                            <div class="form-check">
                                <input type="radio" id="laki-laki" name="jenis_kelamin" class="form-check-input"
                                    value="Laki-laki" @if (old('jenis_kelamin', 'Laki-laki') == 'Laki-laki') checked @endif>
                                <label class="form-check-label" for="laki-laki">Director</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="perempuan" name="jenis_kelamin" class="form-check-input"
                                    value="Perempuan" @if (old('jenis_kelamin', 'Perempuan') == 'Perempuan') checked @endif>
                                <label class="form-check-label" for="perempuan">Manajer</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="perempuan" name="jenis_kelamin" class="form-check-input"
                                    value="Perempuan" @if (old('jenis_kelamin', 'Perempuan') == 'Perempuan') checked @endif>
                                <label class="form-check-label" for="perempuan">Admin</label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required
                                value="{{ old('password') }}">
                            @error('password')
                                <label for="kode" class="text-danger">Password minimal 8 karakter!</label>
                            @enderror
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