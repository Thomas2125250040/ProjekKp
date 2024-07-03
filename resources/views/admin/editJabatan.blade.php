@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Ubah Data Jabatan</h5>
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('jabatan.update', $jabatan->id) }}">
                            @csrf
                            @method('PATCH')
                            <div class="mb-4">
                                <label for="id_jabatan" class="form-label">Id Jabatan</label>
                                <input type="text" class="form-control" id="id" name="id" required
                                    value="{{ $jabatan->id }}">
                                @error('id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="nama" class="form-label">Nama Jabatan</label>
                                <input type="text" class="form-control" id="nama" name="nama" required
                                    value="{{ $jabatan->nama }}">
                                @error('nama')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
                                <input type="text" class="form-control" id="gaji_pokok" name="gaji_pokok" required
                                    value="{{ $jabatan->gaji_pokok }}">
                                @error('gaji_pokok')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="uang_makan" class="form-label">Uang Makan per Hari </label>
                                <input type="text" class="form-control" id="uang_makan" name="uang_makan" required
                                    value="{{ $jabatan->uang_makan }}">
                                @error('uang_makan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="uang_lembur" class="form-label">Uang Lembur per Jam</label>
                                <input type="text" class="form-control" id="uang_lembur" name="uang_lembur" required
                                    value="{{ $jabatan->uang_lembur }}">
                                @error('uang_lembur')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
