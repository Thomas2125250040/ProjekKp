@extends('layouts.main')
@section('content')
<style>
  .status-kirim:hover {
    color: rgb(93, 135, 255);
  }
</style>
<div class="card">
    <div class="card-body">
        <div class="d-flex mb-3">
            <div class="card-title fw-semibold flex-grow-1">Edit Absensi</div>
        </div>
        @isset($error)
            <div class="alert alert-danger d-flex justify-content-between align-items-center mb-4">
                {{$error}}
                <a class="btn btn-danger ms-3" href="{{route('absensi.buatSatu')}}">Buat Absensi</a>
            </div>
        @endisset
        @isset($libur)
            <h3 class="text-danger text-center">{{$libur}}</h3>
        @endisset
        @isset($tutup)
            <div class="alert alert-danger mb-4">
                {{$tutup}}
            </div>
        @endisset
        <table class="table" id="myTable">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Nama</th>
                <th scope="col">Waktu Masuk</th>
                <th scope="col">Waktu Keluar</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @isset($masuk)
                @foreach($masuk as $item)
                <tr>
                  <td>{{$item->id_karyawan}}</td>
                  <td>{{$item->karyawan->nama}}</td>
                  <td>{{$item->waktu_masuk}}</td>
                  <td>{{$item->waktu_keluar}}</td>
                  <td></td>
                  <td><i class="ti ti-edit status-kirim" onclick="editRow(this)"></i></td>
                </tr>
                @endforeach
              @endisset
              @isset($izin)
                @foreach($izin as $item)
                <tr>
                  <td>{{$item->id_karyawan}}</td>
                  <td>{{$item->karyawan->nama}}</td>
                  <td>-</td>
                  <td>-</td>
                  <td>{{$item->keterangan}}</td>
                  <td><i class="ti ti-edit status-kirim" onclick="editRow(this)"></i></td>
                </tr>
                @endforeach
              @endisset
            </tbody>
          </table>
    </div>
</div>
@endsection
@section('extra_scripts')
<script>
  $(function(){
    $('#myTable').DataTable();
    // $.ajax({
    //   type: 'POST',
    //   url: '{{route("gaji")}}',
    // });
  });
</script>
@endsection