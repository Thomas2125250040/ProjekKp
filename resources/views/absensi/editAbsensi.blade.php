@extends('layouts.main')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex mb-3">
            <div class="card-title fw-semibold flex-grow-1">Edit Absensi</div>
        </div>
        <div class="d-flex align-items-center justify-content-between flex-sm-wrap">
            <div class="mb-3"><?php
                echo strftime('%A,');
                echo date(' d-M-Y');?>
            </div>
            <div class="col-lg-3 col-sm-4">
                <div class="input-group d-flex flex-nowrap">
                    <div class="form-outline" data-mdb-input-init>
                        <input type="search" id="form1" class="form-control" placeholder="Search"/>
                    </div>
                    <button type="button" class="btn btn-primary py-0" data-mdb-ripple-init>
                        <i class="ti ti-search"></i>
                    </button>
                </div>
            </div>
        </div>
        <table class="table table-striped mt-4">
            <?php $no=1; ?>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Status</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Thomas Setiawan</td>
                    <td><div class="btn btn-danger py-0 col-7">Alpha</div></td>
                    <td><input type="text" class="form-control bg-light py-0 px-2"/></td>
                    <td><i class="ti ti-edit"></i></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Cindy Tri Sella</td>
                    <td><div class="btn btn-danger py-0 col-7">Alpha</div></td>
                    <td><input type="text" class="form-control bg-light py-0 px-2"/></td>
                    <td><i class="ti ti-edit"></i></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Nicholas</td>
                    <td><div class="btn btn-primary py-0 col-7">Izin</div></td>
                    <td><input type="text" class="form-control bg-light py-0 px-2" disabled value="Sakit perut akibat kebanyakan makan pedas"/></td>
                    <td><i class="ti ti-edit"></i></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('extra_scripts')
@endsection
