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
            <div class="col-lg-3 col-sm-4">
                <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                    <i class="ti ti-calendar"></i>&nbsp;
                    <span></span> <i class="fa fa-caret-down"></i>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <select class="selectpicker" data-show-subtext="true" data-live-search="true">
                <option data-subtext="Rep California">Tom Foolery</option>
                <option data-subtext="Sen California">Bill Gordon</option>
                <option data-subtext="Sen Massachusetts">Elizabeth Warren</option>
                <option data-subtext="Rep Alabama">Mario Flores</option>
                <option data-subtext="Rep Alaska">Don Young</option>
                <option data-subtext="Rep California" disabled="disabled">Marvin Martinez</option>
            </select>
        </div>
        <table class="table">
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
                <tr>
                    <th scope="row">2</th>
                    <td>24-06-2024</td>
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
                <tr>
                    <th scope="row">5</th>
                    <td>27-06-2024</td>
                    <td>08:00:23</td>
                    <td>17:01:20</td>
                    <td>-</td>
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
</script>
@endsection
