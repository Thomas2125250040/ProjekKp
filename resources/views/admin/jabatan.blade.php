@extends('layouts.main')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="input-group rounded w-50">
                <div class="d-flex align-items-center">
                    <h5 class="card-title fw-semibold" style="margin-bottom: 0">Daftar Jabatan</h5>
                </div>
                <input type="search" class="form-control rounded ms-3" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                <span class="input-group-text border-0" id="search-addon">
                    <i class="ti ti-search"></i>
                </span>
            </div>
            <a href="{{ route("jabatan.create") }}" class="btn btn-primary">Tambah</a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Jabatan</th>
                    <th scope="col">Gaji Pokok</th>
                    <th scope="col">Uang Makan</th>
                    <th scope="col">Uang Lembur</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1 ?>
                @forelse ($jabatan as $item => $row)
                <tr>
                    <td class="align-middle">{{ $no++ }}</td>
                    <td class="align-middle">{{ $row->nama }}</td>
                    <td class="align-middle">{{ $row->gaji_pokok }}</td>
                    <td class="align-middle">{{ $row->uang_makan }}</td>
                    <td class="align-middle">{{ $row->uang_lembur }}</td>
                    <td>
                        <a class="btn btn-primary fs-1">Edit</a>
                        <a class="btn btn-danger fs-1">Hapus</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">Tidak Ada Jabatan yang Ditemukan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
