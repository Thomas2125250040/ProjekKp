@extends('layouts.main')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-baseline mb-3">
            <div class="card-title fw-semibold flex-grow-1">Absen Masuk</div>
            <div class="card-title fs-3">
                <div id="timestamp"></div>
            </div>
        </div>
        <div class="text-center mb-3"><?php
                echo strftime('%A,');
                echo date(' d-M-Y');?>
        </div>
        <div class="row text-center">
            <div class="d-flex justify-content-center">
                <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                    aria-describedby="search-addon" id="input" style="width: 60%;" />
            </div>
            <div class="d-flex justify-content-center">
                <div id="read"></div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3">
            <table class="table table-striped mt-4" style="width: 90%">
                <?php $no=1; ?>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Waktu Masuk</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mt-4">
            <button class="btn btn-primary">Tambah</button>
        </div>
    </div>
</div>
<style>
    #read {
        width: 60%;
        position: absolute;
        z-index: 999;
        background: white;
        border-radius: 3px;
        box-shadow: 5px 5px 3px;
    }

    #read ul {
        border-top: 1px solid #999;
        padding: 15px 10px;
    }

    #read li {
        list-style: none;
        border-radius: 3px;
        padding: 15px 10px;
        cursor: pointer;
    }

    #read li:hover {
        background: rgba(13, 110, 253, 0.6);
        color: white;
    }

    .ti.ti-circle-x:hover {
        color: rgb(250, 137, 107);
    }
</style>
@endsection
@section('extra_scripts')
<script>
    $(document).ready(function () {
        setInterval(timestamp, 1000);
        $("#input").keyup(function () {
            var strcari = $("#input").val();
            if (strcari != "") {
                $("#read").html(
                    '<div class="d-inline-flex align-items-center"><div class="text-muted me-2">Mencari Data...</div> <div class="spinner-grow spinner-grow-sm bg-danger" role="status"></div></div>'
                    );
                $.ajax({
                    type: "get",
                    url: "{{ url('search-karyawan') }}",
                    data: "q=" + strcari,
                    success: function (data) {
                        $("#read").html(data);
                    }
                });
            } else {
                $("#read").html('');
            }
        })
    });

    function timestamp() {
        $.ajax({
            url: 'http://127.0.0.1:8000//timestamp.php',
            success: function (data) {
                $('#timestamp').html(data);
            },
        });
    }

    function addToTable(element) {
        console.log("clicked");
        const tbody = document.querySelector("table tbody");
        var newRow = document.createElement("tr");
        var rowNumber = tbody.rows.length + 1;
        const time = $('#timestamp');
        newRow.innerHTML = "<td scope='row'>" + rowNumber + "</td>"
        + "<td>" + element.innerHTML + "</td>"
        + "<td>" + $('#timestamp').text() +"</td>"
        + "<td><i class=\"ti ti-circle-x fs-6\" onclick=\"delRow(this)\"></i></td>";
        tbody.appendChild(newRow);
    }

    function delRow(element) {
        const row = element.closest('tr');
        row.remove();
        updateRowNumbers();
    }

    function updateRowNumbers() {
        const tbody = document.querySelector("table tbody");
        for (let i = 0; i < tbody.rows.length; i++) {
            tbody.rows[i].cells[0].textContent = i + 1;
        }
    }

</script>
@endsection
