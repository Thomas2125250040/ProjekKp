@extends('layouts.main')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex mb-4">
            <div class="card-title fw-semibold flex-grow-1">Log Harian</div>
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
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Waktu Masuk</th>
                <th scope="col">Waktu Keluar</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>23-06-2024</td>
                <td>08:00:23</td>
                <td>17:01:20</td>
                <td>-</td>
                <td><i class="ti ti-clock-edit"></i></td>
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
                <td><i class="ti ti-pencil-plus"></i></td>
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