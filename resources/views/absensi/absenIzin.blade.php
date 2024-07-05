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
                    <th scope="col">Id</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Status</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
            @foreach($alpha as $row)
            <tr class="align-middle">
                <td></td>
                <td>{{$row->id}}</td>
                <td>{{$row->nama}}</td>
                <td class="text-center">Alpha</td>
                <td><input type="text" class="form-control bg-light"/></td>
                <td>-</td>
            </tr>
            @endforeach
            @foreach($izin as $row)
            <tr class="align-middle">
                <td></td>
                <td>{{$row->id}}</td>
                <td>{{$row->nama}}</td>
                <td class="text-center">Izin</td>
                <td><input type="text" class="form-control bg-light"/></td>
                <td>-</td>
            </tr>
            @endforeach
                
                
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('extra_scripts')
<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            "createdRow": function(row, data, dataIndex) {
                    $(row).children().eq(0).html(dataIndex + 1);
            }
        });
        // Add event listener for 'Enter' key press on input fields
        $('#myTable').on('keypress', 'input', function(e) {
            if (e.which == 13) { // Enter key pressed
                var inputField = $(this);
                var keterangan = inputField.val();
                

                
            }
        });
    });
</script>
@endsection
