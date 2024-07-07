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
        </div>
        <div class="d-flex mb-4">
            <select class="me-3 selectpicker" data-show-subtext="true" data-live-search="true" id="karyawanSelect">
                @isset($karyawan)
                    @foreach($karyawan as $row)
                    <option data-subtext="{{$row->jabatan->nama}}">{{$row->nama}}</option>
                    @endforeach
                @endisset
                <span class="caret"></div>
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
                @isset($logMasuk)
                    @foreach($logMasuk as $masuk)
                    <tr>
                        <td>{{$masuk['tanggal']}}</td>
                        <td>{{$masuk['waktu_masuk']}}</td>
                        <td>{{$masuk['waktu_keluar']}}</td>
                        <td>-</td>
                    </tr>
                    @endforeach
                @endisset
                @isset($logIzin)
                    @foreach($logIzin as $izin)
                    <tr class="bg-light-primary">
                        <td>{{$izin['tanggal']}}</td>
                        <td>-</td>
                        <td>-</td>
                        <td>{{$izin['keterangan_izin']}}</td>
                    </tr>
                    @endforeach
                @endisset
                @isset($logAlpha)
                    @foreach($logAlpha as $alpha)
                    <tr class="bg-danger text-white">
                        <td>{{$alpha['tanggal']}}</td>
                        <td>-</td>
                        <td>-</td>
                        <td>Alpha</td>
                    </tr>
                    @endforeach
                @endisset
                @isset($logLibur)
                    @foreach($logLibur as $libur)
                    <tr class="bg-danger text-white">
                        <td>{{$libur['tanggal']}}</td>
                        <td>-</td>
                        <td>-</td>
                        <td>{{$libur['keterangan_libur']}}</td>
                    </tr>
                    @endforeach
                @endisset
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
    $('#myTable').DataTable({
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
        var url = '{{ route("logharian") }}' + '?nama=' + encodeURIComponent(nama) + '&start=' + encodeURIComponent(startDate) + '&end=' + encodeURIComponent(endDate);
        window.location.href = url;
    }
});
$(window).on('load', function() {
    $('span.caret').css('border-top', '0');
    $('button.dropdown-toggle.selectpicker').css('border-radius', 0);
});
</script>
@endsection