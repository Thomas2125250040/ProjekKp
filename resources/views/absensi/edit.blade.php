@extends('layouts.main')
@section('exclude_jquery', '')
@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css" />
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
        <table cellpadding="0" cellspacing="0" border="0" class="dataTable table table-striped" id="example">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Nama</th>
                <th scope="col">Waktu Masuk</th>
                <th scope="col">Waktu Keluar</th>
                <th scope="col">Keterangan</th>
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
                </tr>
                @endforeach
              @endisset
            </tbody>
          </table>
    </div>
</div>
@endsection
@section('extra_scripts')
<style>
  .modal-header {
    padding: 15px;
    align-items: center;
    border-bottom: 1px solid #e5e5e5;
    display: block;
  }

  button.close {
    -webkit-appearance: none;
    padding: 0;
    cursor: pointer;
    background: transparent;
    border: 0;
    display: block;
    font-size: 22px;
  }
  .close {
    float: right;
    font-size: 21px;
    font-weight: bold;
    line-height: 1;
    color: #000;
    text-shadow: 0 1px 0 #fff;
    filter: alpha(opacity = 20);
    opacity: .2;
}
</style>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js" ></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.js" ></script>
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.js" ></script>
<script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js" ></script>
<script src="../assets/js/dataTables.altEditor.free.js" ></script>
<script>
$(document).ready(function() {
var columnDefs = [{
  title: "Id",
  type: "readonly"
}, {
  title: "Nama",
  type: "text",
  required: true,
  unique: true,
  name: "nama"
}, {
  title: "Waktu masuk",
  required: true,
  type: "time"
}, {
  title: "Waktu keluar",
  type: "time"
}, {
  title: "Keterangan",
  type: "text"
}];

var myTable;

myTable = $('#example').DataTable({
  "sPaginationType": "full_numbers",
  columns: columnDefs,
  dom: 'Bfrtip',      
  select: 'single',
  responsive: true,
  altEditor: true,     
  buttons: [{
    text: 'Add',
    name: 'add'       
  },
  {
    extend: 'selected',
    text: 'Edit',
    name: 'edit'        
  },
  {
    extend: 'selected', 
    text: 'Delete',
    name: 'delete'    
  }]});
});
</script>
@endsection