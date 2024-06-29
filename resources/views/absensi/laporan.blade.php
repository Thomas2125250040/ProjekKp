@extends('layouts.main')
@section('content')
<style>
  a.log-harian:hover {
    color: dimgray;
    cursor: pointer;
  }
</style>
<div class="card">
  <div class="card-body">
      <div class="d-flex mb-4 justify-content-between">
          <div class="card-title fw-semibold flex-grow-1">Laporan</div>
          <a class="log-harian">Log Harian ></a>
      </div>
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <div class="form-check">
              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
              <label class="form-check-label" for="flexRadioDefault1">
                Bulanan
              </label>
          </div>
          <div class="form-check">
              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
              <label class="form-check-label" for="flexRadioDefault2">
                Tahunan
              </label>
          </div>
        </div>
        <div class="custom-date">
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
      <div class="d-flex mt-4 justify-content-center">
        <div class="card">
          <div class="card-body" style="width: 200px;">
            <h5 class="card-title">Jumlah Alpha</h5>
            <h6 class="card-subtitle mb-2 text-muted">25</h6>
          </div>
        </div>
        <div class="card">
          <div class="card-body" style="width: 200px;">
            <h5 class="card-title">Jumlah Izin</h5>
            <h6 class="card-subtitle mb-2 text-muted">25</h6>
          </div>
        </div>
        <div class="card">
          <div class="card-body" style="width: 200px;">
            <h5 class="card-title">Total Jam Kerja</h5>
            <h6 class="card-subtitle mb-2 text-muted">25 jam</h6>
          </div>
        </div>
        <div class="card">
          <div class="card-body" style="width: 200px;">
            <h5 class="card-title">Jam Lembur</h5>
            <h6 class="card-subtitle mb-2 text-muted">25 jam</h6>
          </div>
        </div>
      </div>
      <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary mt-4">Cetak Laporan</button>
      </div>
  </div>
</div>
@endsection