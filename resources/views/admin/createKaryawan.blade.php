@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Tambah Data Pegawai</h5>
            <div class="card">
                <div class="card-body">
                    <form>
                        <div class="mb-4">
                            <label for="namaPegawai" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="namaPegawai" pattern="[A-Za-z]+"
                                title="Nama Anda tidak valid">
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Jenis kelamin</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioLaki-laki" checked>
                                <label class="form-check-label" for="flexRadioLaki-laki">
                                    Laki-laki
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioPerempuan">
                                <label class="form-check-label" for="flexRadioPerempuan">
                                    Perempuan
                                </label>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="tglLahir" class="form-label">Tanggal lahir</label>
                            <input type="date" class="form-control" id="tglLahir">
                        </div>
                        <fieldset id="fieldset">
                            <label for="disabledSelect" class="form-label">Jabatan</label>
                            <select id="disabledSelect" class="form-select">
                                @forelse ($jabatan as $row)
                                    <option>{{ $row->nama_jabatan }}</option>
                                @empty
                                    <option>-- Belum ada data jabatan --</option>
                                @endforelse
                            </select>
                        </fieldset>
                        @if($jabatan->isEmpty())
                            <div id="error-message" class="text-danger fs-2 mb-5"><i class="ti ti-x"></i> Data jabatan tidak tersedia. Silakan tambahkan data jabatan terlebih dahulu.</div>
                        @else
                            <script>
                                document.getElementById('fieldset').classList.add("mb-5");
                            </script>
                        @endif
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
                        <div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        console.log("Script executed");
        @if($jabatan->isEmpty())
            console.log("Jabatan empty");
            document.getElementById('fieldset').setAttribute('disabled', '');
            document.getElementById('submitBtn').setAttribute('disabled', '');
        @endif
    });
</script>
@endsection
