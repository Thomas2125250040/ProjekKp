@extends('layouts.main')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex mb-3">
            <div class="card-title fw-semibold flex-grow-1">Absen Izin</div>
        </div>
        <div class="d-flex align-items-center justify-content-between flex-sm-wrap">
            <div class="mb-3"><?php
                echo strftime('%A,');
                echo date(' d-M-Y');?>
            </div>
        </div>
        <table class="table mt-4"id="myTable">
            <?php $no=1; ?>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Status</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Thomas Setiawan</td>
                    <td>Alpha</td>
                    <td><input type="text" class="form-control bg-light py-0 px-2"/></td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Cindy Tri Sella</td>
                    <td>Izin</td>
                    <td><input type="text" class="form-control bg-light py-0 px-2"/></td>
                    <td>-</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('extra_scripts')
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>
@endsection
