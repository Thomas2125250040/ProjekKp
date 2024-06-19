@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Ubah Data Jabatan</h5>
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('jabatan.update', [$jabatan->id_jabatan]) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label for="kode_jabatan" class="form-label">Kode Jabatan</label>
                                <input type="text" class="form-control" id="kode_jabatan" name="kode_jabatan" required
                                    value="{{ $jabatan->kode_jabatan }}">
                            </div>

                            <div class="mb-4">
                                <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
                                <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" required
                                    value="{{ $jabatan->nama_jabatan }}">
                            </div>

                            <div class="mb-4">
                                <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
                                <input type="text" class="form-control" id="gaji_pokok" name="gaji_pokok" required
                                value="{{ $jabatan->gaji_pokok }}">
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
