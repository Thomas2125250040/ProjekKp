@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body bg-light-primary">
            <h5 class="card-title fw-semibold mb-4">Edit Data Pegawai</h5>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('jabatan.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="namaPegawai" class="form-label">Nama Jabatan</label>
                            <input type="text" class="form-control" id="namaPegawai" pattern="[A-Za-z]+"
                                title="Nama Anda tidak valid" name="nama">
                        </div>
                        <div class="mb-3">
                            <label for="gajiPokok" class="form-label">Gaji Pokok</label>
                            <input type="text" class="form-control" id="gajiPokok" pattern="[0-9]+"
                                title="Gaji Pokok tidak valid" name="gajiPokok">
                        </div>
                        <div class="mb-3">
                            <label for="uangMakan" class="form-label">Uang Makan</label>
                            <input type="text" class="form-control" id="uangMakan" pattern="[0-9]+"
                                title="Uang Makan tidak valid." name="uangMakan">
                        </div>
                        <div class="mb-3">
                            <label for="uangLembur" class="form-label">Uang Lembur</label>
                            <input type="text" class="form-control" id="uangLembur" pattern="[0-9]+"
                                title="Uang Lembur tidak valid." name="uangLembur">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
