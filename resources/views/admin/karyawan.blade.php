@extends('layouts.main')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title fw-semibold" style="margin-bottom: 0">Data Karyawan</h5>

                @if (count($jabatan) == 0)
                    <button class="btn btn-primary" disabled>Tambah</button>
                    <div class="alert alert-warning">
                        Tidak ada data jabatan, harap tambahkan data jabatan dahulu!
                    </div>
                @else
                    <a href="{{ route('karyawan.create') }}" class="btn btn-primary">Tambah</a>
                @endif
            </div>
            @if (Session::get('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Kode</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jabatan</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">No. Telepon</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($karyawan as $item)
                        <tr>
                            <td>{{ $item->kode_karyawan }}</td>
                            <td>{{ $item->nama_karyawan }}</td>
                            <td>{{ $item->nama_jabatan }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->nomor_telepon }}</td>
                            <td>
                                <form method="POST" action="{{ route('karyawan.destroy', $item->id_karyawan) }}">
                                    @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button type="submit" class="btn btn-danger fs-1 hapus_karyawan" data-toggle="tooltip"
                                        title='Delete' data-nama='{{ $item->nama_karyawan }}'>Hapus</button>
                                    <a href="{{ route('karyawan.edit', $item->id_karyawan) }}"
                                        class="btn btn-primary fs-1">Ubah</a>
                                    <a href="{{ route('karyawan.show', $item->id_karyawan) }}"
                                        class="btn btn-warning fs-1 ">Detail</a>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">Tidak ada data Karyawan!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
