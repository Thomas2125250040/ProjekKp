<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\HariLibur;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('authentication-login');
});

Route::get('/login', function () {
    return view('authentication-login');
});

Route::post('/login', [LoginController::class , 'login']);

Route::get('/director-dashboard', function () {
    return view('director.index');
});
Route::get('/admin-dashboard', function () {
    return view('admin.index');
});

Route::get('/gm-dashboard', function () {
    return view('gm.index');
});

Route::get('/rawr', function () {
    return view('admin.rawr');
});

Route::resource('karyawan', KaryawanController::class);
Route::resource('jabatan', JabatanController::class);

Route::group(['prefix'=>'absensi'], function(){
    Route::get('',[AbsensiController::class, 'index'])->name('absensi.index');
});

Route::get('absensi/masuk', [AbsensiController::class, 'create']);
Route::get('search-karyawan', [AbsensiController::class, 'search'])->name('absensi.search-karyawan');
Route::post('absensi/cache', [AbsensiController::class, 'cache'])->name('absensi.cache');
Route::get('absensi/get-cache', [AbsensiController::class, 'getCache'])->name('absensi.get-cache');
Route::get('absensi/keluar', [AbsensiController::class, 'absenKeluar'])->name('absensi.keluar');
Route::get('absensi/izin', [AbsensiController::class, 'absenIzin'])->name('absensi.izin');
Route::get('absensi/edit', [AbsensiController::class, 'absensiEdit'])->name('absensi.edit');
Route::get('gaji', [AbsensiController::class, 'gaji'])->name("gaji");
Route::get('laporan', [AbsensiController::class, 'laporan'])->name("laporan");
Route::get('log-harian', [AbsensiController::class, 'logHarian'])->name('log-harian');
Route::get('user/create', [LoginController::class, 'register'])->name('register');
Route::get('user/edit', [LoginController::class, 'edit'])->name('user.edit');
Route::get('test', [AbsensiController::class, 'test'])->name("test");
Route::get('hari-libur', [HariLibur::class, 'index'])->name('libur');
Route::get('hari-libur/create', [HariLibur::class, 'create'])->name('libur.create');
Route::get('absen/edit', [AbsensiController::class, 'edit'])->name('absensi.edit');