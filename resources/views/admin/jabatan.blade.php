@extends('layouts.main')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="input-group rounded w-50">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title fw-semibold" style="margin-bottom: 0">Daftar Jabatan</h5>
                    </div>
                    <input type="search" class="form-control rounded ms-3" placeholder="Search" aria-label="Search"
                        aria-describedby="search-addon" />
                    <span class="input-group-text border-0" id="search-addon">
                        <i class="ti ti-search"></i>
                    </span>
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
                        {{-- <th scope="col">Uang Makan</th>
                    <th scope="col">Uang Lembur</th> --}}
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jabatan as $item => $row)
                        <tr>
                            <td class="align-middle">{{ $row->kode_jabatan }}</td>
                            <td class="align-middle">{{ $row->nama_jabatan }}</td>
                            <td class="align-middle">{{ $row->gaji_pokok }}</td>
                            {{-- <td class="align-middle">{{ $row->uang_makan }}</td>
                    <td class="align-middle">{{ $row->uang_lembur }}</td> --}}

                            <td>
                                <form method="POST" action="{{ route('jabatan.destroy', $row->id_jabatan) }}">
                                    @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button type="submit" class="btn btn-danger fs-1 hapus_jabatan" data-toggle="tooltip"
                                        title='Delete' data-nama='{{ $row->nama_jabatan }}'>Hapus</button>
                                    <a href="{{ route('jabatan.edit', $row->id_jabatan) }}"
                                        class="btn btn-primary fs-1">Ubah</a>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">Tidak ada data jabatan!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
