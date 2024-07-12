@extends('layouts.main')
@section('content')
<style>
    #tanggal {
        border-top-right-radius: 0px;
        border-bottom-right-radius: 0px;
    }
    #search-btn {
        border-top-left-radius: 0px;
        border-bottom-left-radius: 0px;
    }
</style>
<div class="card">
    <div class="card-body">
        <div class="d-flex mb-4">
            <div class="card-title fw-semibold flex-grow-1">Revisi</div>
        </div>
        <div class="d-flex mb-4 col-3">
            <input type="date" class="form-control" id="tanggal">
            <button class="btn btn-primary" id="search-btn" onclick="search()"><i class="ti ti-search"></i></button>
        </div>
        <table class="table" id="myTable">
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
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('extra_scripts')
<script type="text/javascript">
let table;
$(function() {
    table = $('#myTable').DataTable({
        "order": [[0, 'desc']]
    });
    
});

function search(){
    const tanggal = $('#tanggal').val();
    $.ajax({
        type: "GET",
        url: "{{route('data-revisi')}}",
        data: {tanggal: tanggal},
        statusCode: {
            202: function(data){
                alert("Libur : " + data.message);
            },
            204: function(){
                alert("Data tidak ditemukan.");
            }
        },
        success: function(data, status, xhr){
            if (xhr.status === 204 || xhr.status === 202) {
                return;
            }
            data.masuk.forEach(function(item){
                const newRow = $("<tr>");
                newRow.append(
                    $("<td>").text(item.id),
                    $("<td>").text(item.nama),
                    $("<td>").text(item.waktu_masuk),
                    $("<td>").text(item.waktu_keluar),
                    $("<td>")
                );
                table.row.add(newRow).draw();
            });
            data.izin.forEach(function(item){
                const newRow = $("<tr>");
                newRow.append(
                    $("<td>").text(item.id),
                    $("<td>").text(item.nama),
                    $("<td>"),
                    $("<td>"),
                    $("<td>").text(item.keterangan)
                );
                table.row.add(newRow).draw();
            });
            data.alpha.forEach(function(item){
                const newRow = $("<tr>");
                newRow.append(
                    $("<td>").text(item.id),
                    $("<td>").text(item.nama),
                    $("<td>").text("-"),
                    $("<td>").text("-"),
                    $("<td>").text("Alpha")
                );
                table.row.add(newRow).draw();
            });
        },
        error: function(xhr, status, error){

        }
    });
}
</script>
@endsection

