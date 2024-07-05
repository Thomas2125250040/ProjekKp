@extends('layouts.main')
@section('content')
<style>
    .ti.ti-circle-x:hover {
        color: rgb(250, 137, 107);
    }
    .ti.ti-circle-x {
        cursor: pointer;
    }
</style>
<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-baseline mb-3">
            <div class="card-title fw-semibold flex-grow-1">Absen Keluar</div>
            <div class="card-title fs-3">
                <div id="timestamp"></div>
            </div>
        </div>
        <div class="text-center mb-3"><?php
                echo strftime('%A,');
                echo date(' d-M-Y');?>
        </div>
        <div class="d-flex justify-content-center">
            <table class="table table-striped mt-4" style="width: 90%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Waktu Masuk</th>
                        <th scope="col">Waktu Keluar</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($data as $index => $row)
                    <tr>
                        <td style="vertical-align: middle;">{{ $index + 1 }}</td>
                        <td style="vertical-align: middle;">{{ $row['nama'] }}</td>
                        <td style="vertical-align: middle;">{{ $row['masuk'] }}</td>
                        <td class="waktuKeluar" style="vertical-align: middle;"><div class="btn btn-danger fs-1 p-2 py-1" onclick="setJamKeluar(this)">Tambah</div></td>
                        <td class="status">-</td>
                        <td><i class="ti ti-circle-x fs-6" onclick="delWaktuKeluar(this)" style="vertical-align: middle"></i></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Silahkan Absen Masuk terlebih dahulu.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('extra_scripts')
<script>
$(document).ready(function () {
        setInterval(timestamp, 1000);
});
function timestamp() {
    $.ajax({
        url: 'http://127.0.0.1:8000//timestamp.php',
        success: function (data) {
            $('#timestamp').html(data);
        },
    });
}
$.ajaxSetup ({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function updateRowNumbers() {
    const tbody = document.querySelector("table tbody");
    for (let i = 0; i < tbody.rows.length; i++) {
        tbody.rows[i].cells[0].textContent = i + 1;
    }
}
function delWaktuKeluar(element) {
    const parent = element.parentNode.parentNode;
    const waktuKeluarCell = parent.querySelector('.waktuKeluar div');
    waktuKeluarCell.innerHTML = "Tambah";
    waktuKeluarCell.classList.remove("btn-success", "disabled");
    waktuKeluarCell.classList.add("btn-danger");
}
function setJamKeluar(element) {
    const timestamp = document.getElementById("timestamp").innerHTML;
    if (timestamp.trim() === "") {
        alert("Timestamp is empty. Cannot set Waktu Keluar.");
        return;
    }
    element.innerHTML = timestamp;
    element.classList.add("disabled");
    element.classList.remove("btn-danger");
    element.classList.add("btn-success");
}
function simpan() {
    
}
</script>
@endsection