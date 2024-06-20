@extends('layouts.main')
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-3" style="margin-bottom: 0">Tambah_absensi</h5>
            <div>
                <h6><?php echo date('d-m-Y')?></h6>
                <h6 id="timestamp"></h6>
            </div>
            <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                        aria-describedby="search-addon" />
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
                    $("#read").html('<p class="text-muted"> Menunggu Mencari Data..</p>');
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