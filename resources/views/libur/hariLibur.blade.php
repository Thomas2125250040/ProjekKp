@extends('layouts.main')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="input-group rounded w-50">
                <div class="d-flex align-items-center">
                    <h5 class="card-title fw-semibold" style="margin-bottom: 0">Hari Libur</h5>
                </div>
            </div>
            <a href="{{ route('jabatan.create') }}" class="btn btn-primary">Tambah</a>
        </div>
        <table class="table table-striped mt-4">
            <?php $no=1; ?>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Tanggal Mulai</th>
                    <th scope="col">Tanggal Selesai</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Tahun Baru 2024 Masehi</td>
                    <td>01-01-2024</td>
                    <td>01-01-2024</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Isra Mi’raj Nabi Muhammad SAW</td>
                    <td>08-02-2024</td>
                    <td>08-02-2024</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Cuti Bersama Tahun Baru Imlek</td>
                    <td>09-02-2024</td>
                    <td>10-02-2024</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('extra_scripts')
@endsection
