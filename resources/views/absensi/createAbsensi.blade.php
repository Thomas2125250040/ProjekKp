@extends('layouts.main')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-baseline mb-3">
                <div class="card-title fw-semibold flex-grow-1">Tambah_absensi</div>
                <div class="card-title fs-3">
                    <div id="timestamp"></div>
                </div>
            </div>
            <div class="text-center mb-3"><?php
                echo strftime('%A,');
                echo date(' d-M-Y');?></div>
            <div class="row text-center">
                <div class="d-flex justify-content-center">
                    <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                            aria-describedby="search-addon" id="input" style="width: 60%;"/>
                </div>
                <div id="read">
                </div>
            </div>
            
        </div>
    </div>
@endsection
@section('extra_scripts')
<script>
    $(document).ready(function() {
        setInterval(timestamp, 1000);
        readData();
            $("#input").keyup(function () {
                var strcari = $("#input").val();
                if(strcari != ""){
                    $("#read").html('<div class="d-inline-flex align-items-center"><div class="text-muted me-2">Mencari Data...</div> <div class="spinner-grow spinner-grow-sm bg-danger" role="status"></div></div>');
                    $.ajax({
                        type: "get",
                        url : "{{ url('search-karyawan') }}",
                        data: "name=" + strcari,
                        success: function(data){
                            $("#read").html(data);
                        }
                    });
                } else {
                    readData();
                }
            })
    });

    function readData(){
        $.get("{{ url('read') }}", {}, function (data, status){
            $("#read").html(data);
        });
    }

    function timestamp() {
        $.ajax({
            url: 'http://127.0.0.1:8000//timestamp.php',
            success: function(data) {
                $('#timestamp').html(data);
            },
        });
    }
</script>
@endsection