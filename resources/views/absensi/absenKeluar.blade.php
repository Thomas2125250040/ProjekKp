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
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($data as $index => $row)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $row['name'] }}</td>
                        <td>{{ $row['masuk'] }}</td>
                        <td class="waktuKeluar">--:--:--</td>
                        <td><i class="ti ti-circle-x fs-6" onclick="delWaktuKeluar(this)"></i></td>
                    </tr>
                @empty
                    
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex align-items-end mt-4 flex-column">
            <button class="btn btn-primary py-2" style="width: 100px;">Kirim</button>
            <div></div>
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
function delWaktuKeluar() {

}
</script>
@endsection