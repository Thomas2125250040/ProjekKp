@extends("layouts.main")
@section("content")
<div class="card">
    <div class="card-body">
        <div class="d-flex mb-3">
            <div class="card-title fw-semibold flex-grow-1">Gaji Karyawan</div>
        </div>
        <div class="mb-3 d-flex align-items-center justify-content-between">
            <div class="col-lg-4 col-sm-3">
                <div class="input-group d-flex">
                    <select class="form-select" id="bulan" name="bulan">
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                        <!-- dan seterusnya -->
                    </select>
                    <input type="number" class="form-control" id="tahun" value="{{ date('Y') }}"/>
                    <button class="btn btn-primary" id="filter-btn">Cari</button>
                </div>
            </div>
        </div>
        {{-- <table id="myTable" class="display"> --}}
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jabatan</th>
                    <th scope="col">Gaji Pokok</th>
                    <th scope="col">Uang Makan</th>
                    <th scope="col">Uang Lembur</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody id="gaji-table-body">
                @foreach($gaji as $key => $g)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $g->nama }}</td>
                        <td>{{ $g->jabatan }}</td>
                        <td>{{ $g->gaji_pokok }}</td>
                        <td>{{ $g->uang_makan }}</td>
                        <td>{{ $g->uang_lembur }}</td>
                        <td>{{ $g->gaji_pokok + $g->uang_makan + $g->uang_lembur }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#filter-btn').click(function() {
            var bulan = $('#bulan').val();
            var tahun = $('#tahun').val();

            $.ajax({
                url: '{{ route('gaji.filter') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    bulan: bulan,
                    tahun: tahun
                },
                success: function(response) {
                    var tbody = $('#gaji-table-body');
                    tbody.empty();

                    $.each(response, function(index, gaji) {
                        tbody.append(
                            '<tr>' +
                            '<td>' + (index + 1) + '</td>' +
                            '<td>' + gaji.nama + '</td>' +
                            '<td>' + gaji.jabatan + '</td>' +
                            '<td>' + gaji.gaji_pokok + '</td>' +
                            '<td>' + gaji.uang_makan + '</td>' +
                            '<td>' + gaji.uang_lembur + '</td>' +
                            '<td>' + (gaji.gaji_pokok + gaji.uang_makan + gaji.uang_lembur) + '</td>' +
                            '</tr>'
                        );
                    });
                }
            });
        });
    });
</script>
@section('extra_scripts')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
@endsection

