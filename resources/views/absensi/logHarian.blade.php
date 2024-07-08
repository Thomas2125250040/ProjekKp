{{-- @extends('layouts.main')
@section('content')
<!-- Stylesheets -->
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<div class="card">
    <div class="card-body">
        <div class="d-flex mb-4">
            <div class="card-title fw-semibold flex-grow-1">Log Harian</div>
            <a href="{{url('laporan')}}" class="btn btn-primary">Cetak</a>
        </div>
        <div class="d-flex mb-4">
            <select class="me-3 selectpicker" data-show-subtext="true" data-live-search="true" id="karyawanSelect">
                <option disabled="disabled" selected>-- Pilih Nama Karyawan --</option>
                @isset($karyawan)
                    @foreach($karyawan as $row)
                    <option data-subtext="{{$row->jabatan->nama}}">{{$row->nama}}</option>
                    @endforeach
                @endisset
            </select>
            <div style="width:250px;">
                <div id="reportrange" style="background: #fff; cursor: pointer; padding: 6px 12px; border: 1px solid #ccc; width: 100%" class="d-flex align-items-center justify-content-around">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-calendar">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M16 2a1 1 0 0 1 .993 .883l.007 .117v1h1a3 3 0 0 1 2.995 2.824l.005 .176v12a3 3 0 0 1 -2.824 2.995l-.176 .005h-12a3 3 0 0 1 -2.995 -2.824l-.005 -.176v-12a3 3 0 0 1 2.824 -2.995l.176 -.005h1v-1a1 1 0 0 1 1.993 -.117l.007 .117v1h6v-1a1 1 0 0 1 1 -1zm3 7h-14v9.625c0 .705 .386 1.286 .883 1.366l.117 .009h12c.513 0 .936 -.53 .993 -1.215l.007 -.16v-9.625z" />
                        <path d="M12 12a1 1 0 0 1 .993 .883l.007 .117v3a1 1 0 0 1 -1.993 .117l-.007 -.117v-2a1 1 0 0 1 -.117 -1.993l.117 -.007h1z" />
                    </svg>
                    <span></span>&nbsp;
                    <div class="caret"></div>
                </div>
            </div>
        </div>
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Tanggal</th>
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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript">
$(function() {
    var start = moment().subtract(29, 'days');
    var end = moment();
    const table = $('#myTable').DataTable({
        "order": [[0, 'desc']]
    });
    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);

    $('#karyawanSelect').on('change', function() {
        updateTable();
    });

    $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
        updateTable();
    });

    function updateTable() {
        var nama = $('#karyawanSelect').val();
        var dateRange = $('#reportrange').data('daterangepicker');
        var startDate = dateRange.startDate.format('YYYY-MM-DD');
        var endDate = dateRange.endDate.format('YYYY-MM-DD');
        $.ajax({
            type: 'get',
            url: '{{route('logharian')}}',
            data : {
                'nama': nama,
                'start': startDate,
                'end': endDate
            },
            success: function(data){
                table.clear();
                data.logAlpha.forEach(function(item){
                    const newRow = $("<tr>");
                    newRow.append(
                        $("<td>").text(item.tanggal),
                        $("<td>").text("-"),
                        $("<td>").text("-"),
                        $("<td>").text("Alpha")
                    );
                    newRow.addClass("bg-danger text-white");
                    table.row.add(newRow).draw();
                });
                data.logIzin.forEach(function(item){
                    const newRow = $("<tr>");
                    newRow.append(
                        $("<td>").text(item.tanggal),
                        $("<td>").text("-"),
                        $("<td>").text("-"),
                        $("<td>").text(item.keterangan_izin)
                    );
                    newRow.addClass("bg-secondary");
                    table.row.add(newRow).draw();
                });
                data.logMasuk.forEach(function(item){
                    const newRow = $("<tr>");
                    newRow.append(
                        $("<td>").text(item.tanggal),
                        $("<td>").text(item.waktu_masuk),
                        $("<td>").text(item.waktu_keluar),
                        $("<td>").text("-")
                    );
                    table.row.add(newRow).draw();
                });
                data.logLibur.forEach(function(item){
                    const newRow = $("<tr>");
                    newRow.append(
                        $("<td>").text(item.tanggal),
                        $("<td>").text("-"),
                        $("<td>").text("-"),
                        $("<td>").text(item.keterangan_libur)
                    );
                    table.row.add(newRow).draw();
                });
            },
            error: function(xhr, status, error) {
                alert(error);
            },
        });
    }

    $(window).on('load', function() {
        $('span.caret').css('border-top', '0');
        $('button.dropdown-toggle.selectpicker').css('border-radius', 0);
    });
});
</script>
@endsection --}}

@extends('layouts.main')
@section('content')
<!-- Stylesheets -->
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<div class="card">
    <div class="card-body">
        <div class="d-flex mb-4">
            <div class="card-title fw-semibold flex-grow-1">Log Harian</div>
            <form action="{{url('cetak')}}" method="GET" id="cetakForm">
                <input type="hidden" name="nama" id="cetakNama">
                <input type="hidden" name="start" id="cetakStart">
                <input type="hidden" name="end" id="cetakEnd">
                <button type="submit" class="btn btn-primary">Cetak</button>
            </form>
           
        </div>
        <div class="d-flex mb-4">
            <select class="me-3 selectpicker" data-show-subtext="true" data-live-search="true" id="karyawanSelect">
                <option disabled="disabled" selected>-- Pilih Nama Karyawan --</option>
                @isset($karyawan)
                    @foreach($karyawan as $row)
                    <option data-subtext="{{$row->jabatan->nama}}">{{$row->nama}}</option>
                    @endforeach
                @endisset
            </select>
            <div style="width:250px;">
                <div id="reportrange" style="background: #fff; cursor: pointer; padding: 6px 12px; border: 1px solid #ccc; width: 100%" class="d-flex align-items-center justify-content-around">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-calendar">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M16 2a1 1 0 0 1 .993 .883l.007 .117v1h1a3 3 0 0 1 2.995 2.824l.005 .176v12a3 3 0 0 1 -2.824 2.995l-.176 .005h-12a3 3 0 0 1 -2.995 -2.824l-.005 -.176v-12a3 3 0 0 1 2.824 -2.995l.176 -.005h1v-1a1 1 0 0 1 1.993 -.117l.007 .117v1h6v-1a1 1 0 0 1 1 -1zm3 7h-14v9.625c0 .705 .386 1.286 .883 1.366l.117 .009h12c.513 0 .936 -.53 .993 -1.215l.007 -.16v-9.625z" />
                        <path d="M12 12a1 1 0 0 1 .993 .883l.007 .117v3a1 1 0 0 1 -1.993 .117l-.007 -.117v-2a1 1 0 0 1 -.117 -1.993l.117 -.007h1z" />
                    </svg>
                    <span></span>&nbsp;
                    <div class="caret"></div>
                </div>
            </div>
        </div>
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Tanggal</th>
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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript">
$(function() {
    var start = moment().subtract(29, 'days');
    var end = moment();
    const table = $('#myTable').DataTable({
        "order": [[0, 'desc']]
    });
    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);

    $('#karyawanSelect').on('change', function() {
        updateTable();
    });

    $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
        updateTable();
    });

    $('#cetakForm').on('submit', function() {
        var nama = $('#karyawanSelect').val();
        var dateRange = $('#reportrange').data('daterangepicker');
        var startDate = dateRange.startDate.format('YYYY-MM-DD');
        var endDate = dateRange.endDate.format('YYYY-MM-DD');

        $('#cetakNama').val(nama);
        $('#cetakStart').val(startDate);
        $('#cetakEnd').val(endDate);
    });

    function updateTable() {
        var nama = $('#karyawanSelect').val();
        var dateRange = $('#reportrange').data('daterangepicker');
        var startDate = dateRange.startDate.format('YYYY-MM-DD');
        var endDate = dateRange.endDate.format('YYYY-MM-DD');
        $.ajax({
            type: 'get',
            url: '{{route('logharian')}}',
            data : {
                'nama': nama,
                'start': startDate,
                'end': endDate
            },
            success: function(data){
                table.clear();
                data.logAlpha.forEach(function(item){
                    const newRow = $("<tr>");
                    newRow.append(
                        $("<td>").text(item.tanggal),
                        $("<td>").text("-"),
                        $("<td>").text("-"),
                        $("<td>").text("Alpha")
                    );
                    newRow.addClass("bg-danger text-white");
                    table.row.add(newRow).draw();
                });
                data.logIzin.forEach(function(item){
                    const newRow = $("<tr>");
                    newRow.append(
                        $("<td>").text(item.tanggal),
                        $("<td>").text("-"),
                        $("<td>").text("-"),
                        $("<td>").text(item.keterangan_izin)
                    );
                    newRow.addClass("bg-secondary");
                    table.row.add(newRow).draw();
                });
                data.logMasuk.forEach(function(item){
                    const newRow = $("<tr>");
                    newRow.append(
                        $("<td>").text(item.tanggal),
                        $("<td>").text(item.waktu_masuk),
                        $("<td>").text(item.waktu_keluar),
                        $("<td>").text("-")
                    );
                    table.row.add(newRow).draw();
                });
                data.logLibur.forEach(function(item){
                    const newRow = $("<tr>");
                    newRow.append(
                        $("<td>").text(item.tanggal),
                        $("<td>").text("-"),
                        $("<td>").text("-"),
                        $("<td>").text(item.keterangan_libur)
                    );
                    table.row.add(newRow).draw();
                });
            },
            error: function(xhr, status, error) {
                alert(error);
            },
        });
    }

    $(window).on('load', function() {
        $('span.caret').css('border-top', '0');
        $('button.dropdown-toggle.selectpicker').css('border-radius', '0');
    });

});
</script>
@endsection

