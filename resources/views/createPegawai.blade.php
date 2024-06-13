@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Tambah Data Pegawai</h5>
            <div class="card">
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label for="namaPegawai" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="namaPegawai" pattern="[A-Za-z]+"
                                title="Nama Anda tidak valid."">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis kelamin</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Laki-laki
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"
                                    checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Perempuan
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="tglLahir" class="form-label">Tanggal lahir</label>
                            <input type="date" class="form-control" id="tglLahir">
                        </div>
                        <div class="mb-3">
                            <label for="disabledSelect" class="form-label">Jabatan</label>
                            <select id="disabledSelect" class="form-select">
                                <option>Disabled select</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
