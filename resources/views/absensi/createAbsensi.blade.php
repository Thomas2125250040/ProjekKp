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
    });

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