@extends("layouts.main")
@section("content")
<div class="card">
    <div class="card-body">
        <div class="d-flex mb-3">
            <div class="card-title fw-semibold flex-grow-1">Gaji Karyawan</div>
        </div>
        <div class="d-flex align-items-center justify-content-between">
            <div class="mb-3"><?php
                echo strftime('%A,');
                echo date(' d-M-Y');?>
            </div>
            <div class="col-lg-4 col-sm-3">
                <div class="input-group d-flex">
                    <select class="form-select" name="bulan">
                        <option value="Islam">Januari</option>
                        <option value="Katolik">Februari</option>
                        <option value="Kristen">Maret</option>
                        <option value="Hindu">April</option>
                        <option value="Buddha">Mei</option>
                        <option value="Konghucu">Juni</option>
                        <option value="Konghucu">Juli</option>
                        <option value="Konghucu">Agustus</option>
                        <option value="Konghucu">September</option>
                        <option value="Konghucu">Oktober</option>
                        <option value="Konghucu">November</option>
                        <option value="Konghucu">Desember</option>
                    </select>
                    <input type="number" class="form-control" value="2024"/>
                </div>
            </div>
        </div>
        <table class="table table-striped mt-4">
            <?php $no=1; ?>
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
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Thomas Setiawan</td>
                    <td>Direktur</td>
                    <td>50.000.000</td>
                    <td>2.600.000</td>
                    <td>10.000.000</td>
                    <td>62.600.000</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Cindy Tri Sella</td>
                    <td>Manajer</td>
                    <td>14.000.000</td>
                    <td>1.300.000</td>
                    <td>4.000.000</td>
                    <td>19.300.000</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Nicholas</td>
                    <td>Admin</td>
                    <td>4.000.000</td>
                    <td>1.300.000</td>
                    <td>700.000</td>
                    <td>6.000.000</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection