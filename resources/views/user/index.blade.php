@extends('layouts.main')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                    <h5 class="card-title fw-semibold" style="margin-bottom: 0">Data User</h5>
                </div>
                <a href="{{ url('users/create') }}" class="btn btn-primary">Tambah</a>
            </div>
            @if (Session::get('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Nama Karyawan</th>
                        <th>Hak Akses User</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($users as $row)
                    <tr>
                        <td>{{ $row->username }}</td>
                        <td>{{ $row->nama }}</td>
                        <td>{{ $row->hak_akses }}</td>
                        <td>
                            <form method="POST" action="{{ route('users.destroy', $row->id_karyawan) }}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger fs-1 hapus_user" data-toggle="tooltip"
                                    title='Delete' data-nama='{{ $row->nama }}'>Hapus</button>
                                <a href="{{ route('users.edit', $row->id_karyawan) }}"
                                    class="btn btn-primary fs-1">Ubah</a>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('extra_scripts')
<script>
$(document).ready( function () {
    $('#myTable').DataTable();
});
</script>
@endsection