@extends('layouts.main')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title fw-semibold" style="margin-bottom: 0">Data Pegawai</h5>
            <a href="{{ route('karyawan.create') }}" class="btn btn-primary">Add</a>
        </div>
        @if (session('Success'))
        <div class="alert alert-success">
            {{ session('Success') }}
        </div>
        @endif
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Umur</th>
                    <th scope="col">Jabatan</th>
                    <th scope="col">Lama Bekerja</th>
                    <th scope="col">Gaji Pokok</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>@fat</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                    <td>@fat</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                    <td>@fat</td>
                    <td>@fat</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
