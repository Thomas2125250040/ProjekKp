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
            <select class="me-3 selectpicker" data-show-subtext="true" data-live-search="true">
                @foreach($karyawan as $row)
                <option data-subtext="{{$row->jabatan->nama}}">{{$row->nama}}</option>
                @endforeach
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
                    <th scope="col">#</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Waktu Masuk</th>
                    <th scope="col">Waktu Keluar</th>
                    <th scope="col">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>23-06-2024</td>
                    <td>08:00:23</td>
                    <td>17:01:20</td>
                    <td>-</td>
                </tr>
                <tr class="bg-danger text-white">
                    <th scope="row">3</th>
                    <td>25-06-2024</td>
                    <td>-</td>
                    <td>-</td>
                    <td>Alpha</td>
                </tr>
                <tr class="bg-light-primary">
                    <th scope="row">4</th>
                    <td>26-06-2024</td>
                    <td>I</td>
                    <td>I</td>
                    <td>Sakit perut karena kebanyakan makan pedas</td>
                </tr>
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
    $('#myTable').DataTable();
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
});
$(window).on('load', function() {
    $('span.caret').css('border-top', '0');
    $('button.dropdown-toggle.selectpicker').css('border-radius', 0);
});
</script>
@endsection