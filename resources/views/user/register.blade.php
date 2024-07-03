@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Tambah Username</h5>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('save') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="id_karyawan" class="form-label">Id Karyawan</label>
                            <input type="text" class="form-control" id="id_karyawan" name="id_karyawan" required
                                value="{{ old('id_karyawan') }}">
                            @error('id_karyawan')
                                <label for="kode" class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required
                                value="{{ old('username') }}">
                            @error('username')
                                <label for="kode" class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Hak Akses</label>
                            <div class="form-check">
                                <input type="radio" id="perempuan" name="hak_akses" class="form-check-input"
                                    value="Manajer" @if (old('hak_akses') == 'General Manager') checked @endif>
                                <label class="form-check-label" for="manajer">General Manager</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="admin" name="hak_akses" class="form-check-input"
                                    value="Admin" @if (old('hak_akses') == 'Admin') checked @endif>
                                <label class="form-check-label" for="admin">Admin</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="director" name="hak_akses" class="form-check-input"
                                    value="Director" @if (old('hak_akses') == 'Director') checked @endif>
                                <label class="form-check-label" for="director">Director</label>
                            </div>
                            @error('hak_akses')
                                <label for="hak_akses" class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required
                                value="{{ old('password') }}">
                            @error('password')
                                <label for="password" class="text-danger">{{ $message }}</label>
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