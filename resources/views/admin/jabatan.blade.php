@extends('layouts.main')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="input-group rounded w-50">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title fw-semibold" style="margin-bottom: 0">Data Jabatan</h5>
                    </div>
                    {{-- <input type="search" class="form-control rounded ms-3" placeholder="Search" aria-label="Search"
                        aria-describedby="search-addon" /> --}}
                    {{-- <span class="input-group-text border-0" id="search-addon">
                        <i class="ti ti-search"></i>
                    </span> --}}
                </div>
                <a href="{{ route('jabatan.create') }}" class="btn btn-primary">Tambah</a>
            </div>
            @if (Session::get('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Kode Jabatan</th>
                        <th scope="col">Nama Jabatan</th>
                        <th scope="col">Gaji Pokok</th>
                        <th scope="col">Uang Makan</th>
                        <th scope="col">Uang Lembur</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Manajer</td>
                        <td>10.000.000</td>
                        <td>70.000</td>
                        <td>100.000</td>
                        <td>
                            <form method="POST" action="">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="submit" class="btn btn-danger fs-1 hapus_jabatan" data-toggle="tooltip"
                                    title='Delete' data-nama=''>Hapus</button>
                                <a href=""
                                    class="btn btn-primary fs-1">Ubah</a>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Kepala Gudang</td>
                        <td>8.000.000</td>
                        <td>80.000</td>
                        <td>50.000</td>
                        <td>
                            <form method="POST" action="">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="submit" class="btn btn-danger fs-1 hapus_jabatan" data-toggle="tooltip"
                                    title='Delete' data-nama=''>Hapus</button>
                                <a href=""
                                    class="btn btn-primary fs-1">Ubah</a>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Admin</td>
                        <td>4.000.000</td>
                        <td>60.000</td>
                        <td>30.000</td>
                        <td>
                            <form method="POST" action="">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="submit" class="btn btn-danger fs-1 hapus_jabatan" data-toggle="tooltip"
                                    title='Delete' data-nama=''>Hapus</button>
                                <a href=""
                                    class="btn btn-primary fs-1">Ubah</a>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
