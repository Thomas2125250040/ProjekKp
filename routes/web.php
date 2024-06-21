<?php

use App\Http\Controllers\AbsensiController;
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

Route::resource('absensi', AbsensiController::class);
Route::get('search-karyawan', [KaryawanController::class, 'search'])->name('karyawan.search');
Route::post('absensi/cache', [AbsensiController::class, 'cache'])->name('absensi.cache');

