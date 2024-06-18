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
            <button type="button" class="btn btn-primary">Add</button>
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
                    <td class="align-middle">{{ $row->id }}</td>
                    <td class="align-middle">{{ $row->nama }}</td>
                    <td class="align-middle">{{ $row->gaji_pokok }}</td>
                    <td class="align-middle">{{ $row->uang_makan }}</td>
                    <td class="align-middle">{{ $row->uang_lembur }}</td>
                    <td class="d-flex">
                        <a class="btn btn-primary fs-1 me-1">Edit</a>
                        <form action="{{ route('jabatan.destroy', $row->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">Tidak Ada Jabatan yang Ditemukan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
