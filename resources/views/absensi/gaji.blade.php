@extends("layouts.main")
@section("content")
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<style>
  .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
  .toggle.ios .toggle-handle { border-radius: 20px; }
</style>
<div class="card">
    <div class="card-body">
        <div class="d-flex mb-3">
            <div class="card-title fw-semibold flex-grow-1">Gaji Karyawan</div>
        </div>
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div class="col-lg-4 col-sm-3">
                <div class="input-group d-flex">
                    <select class="form-select" name="bulan" id="bulan">
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
                        <option value="Konghucu">Desember</option>
                    </select>
                    <input type="number" class="form-control" value="2024" id="tahun"/>
                    <button class="btn btn-primary" id="cari">Cari</button>
                </div>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">Beralih ke jam kerja</label>
            </div>
        </div>
        <table class="table table-striped" id="myTable">
            <?php $no=1; ?>
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jabatan</th>
                    <th scope="col">Gaji Pokok</th>
                    <th scope="col">Uang Makan</th>
                    <th scope="col">Uang Lembur</th>
                    <th scope="col">Denda</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Thomas Setiawan</td>
                    <td>Direktur</td>
                    <td>50.000.000</td>
                    <td>2.600.000</td>
                    <td>10.000.000</td>
                    <td>(10.000)</td>
                    <td>62.600.000</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Cindy Tri Sella</td>
                    <td>Manajer</td>
                    <td>14.000.000</td>
                    <td>1.300.000</td>
                    <td>4.000.000</td>
                    <td>(10.000)</td>
                    <td>19.300.000</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Nicholas</td>
                    <td>Admin</td>
                    <td>4.000.000</td>
                    <td>1.300.000</td>
                    <td>700.000</td>
                    <td>(10.000)</td>
                    <td>6.000.000</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('extra_scripts')
<script>
$(document).ready(function() {
    const table = $('#myTable').DataTable();
    $('#cari').click(function(){
        // const btnCari = $(this).html("<div class='spinner-border spinner-border-sm'></div>").attr('disabled', '');
        var bulan = $('#bulan').val();
        var tahun = $('#tahun').val();

        // You can make an AJAX call here to fetch data based on bulan and tahun
        $.ajax({
            type: 'GET',
            url: '{{route("gaji")}}',
            data: {
                bulan: bulan,
                tahun: tahun
            },
            success: function(response, status, xhr) {
                // btnCari.html("Cari").removeAttr('disabled');
                if(xhr.status == 204){
                    table.clear().draw();
                }
            },
            error: function(xhr, status) {
                console.error(xhr);
            }
        });
    });
});
</script>
@endsection