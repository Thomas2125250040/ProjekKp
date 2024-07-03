<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\HariLiburController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\checkHakAkses;
use App\Http\Middleware\checkDirector;
use App\Http\Middleware\checkAdmin;
use App\Http\Middleware\checkGeneralManager;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\checkAdminDirector;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'index'])->name('login-page');
Route::post('/', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/error', function() {
    return view('user.error');
});

Route::middleware([checkHakAkses::class])->group(function () {

    Route::get('laporan', [AbsensiController::class, 'laporan'])->name("laporan");
    Route::get('log-harian', [AbsensiController::class, 'logharian'])->name("logharian");

    Route::middleware([CheckAdminDirector::class])->group(function () {
        Route::get('gaji', [AbsensiController::class, 'gaji'])->name('gaji');
        Route::get('register', [LoginController::class, 'register'])->name('register');
        Route::post('register', [LoginController::class, 'store'])->name('save');
        Route::resource('users', RegisterController::class);
    });

    // Route untuk Admin
    Route::middleware([CheckAdmin::class])->group(function () {
        Route::resource('karyawan', KaryawanController::class);
        Route::resource('jabatan', JabatanController::class);
        Route::resource('hari-libur', HariLiburController::class);
        Route::get('absensi/masuk', [AbsensiController::class, 'create']);
        Route::get('absensi/izin', [AbsensiController::class, 'absenIzin'])->name('absensi.izin');
        Route::get('absensi/keluar', [AbsensiController::class, 'absenKeluar'])->name('absensi.keluar');
    });

    // Route untuk Director
    Route::middleware([CheckDirector::class])->group(function () {
        Route::get('absensi/ubah', [AbsensiController::class, 'absensiEdit'])->name('absensi.edit');
    });

    // Route untuk General Manager
    Route::middleware([CheckGeneralManager::class])->group(function () {

    });
});
