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
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'index'])->name('login-page');
Route::post('/', [LoginController::class, 'login'])->name('login');
Route::get('register', [LoginController::class, 'register'])->name('register');
Route::post('register', [LoginController::class, 'store'])->name('save');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Route::resource('karyawan', KaryawanController::class);
// Route::resource('jabatan', JabatanController::class);
// Route::resource('hari-libur', HariLiburController::class);
// Route::get('absensi/masuk', [AbsensiController::class, 'create']);
// Route::get('search-karyawan', [AbsensiController::class, 'search'])->name('absensi.search-karyawan');
// Route::post('absensi/cache', [AbsensiController::class, 'cache'])->name('absensi.cache');
// Route::get('absensi/get-cache', [AbsensiController::class, 'getCache'])->name('absensi.get-cache');
// Route::get('absensi/keluar', [AbsensiController::class, 'absenKeluar'])->name('absensi.keluar');
// Route::get('absensi/izin', [AbsensiController::class, 'absenIzin'])->name('absensi.izin');
// Route::get('absensi/edit', [AbsensiController::class, 'absensiEdit'])->name('absensi.edit');
// Route::get('gaji', [AbsensiController::class, 'gaji'])->name("gaji");
// Route::get('laporan', [AbsensiController::class, 'laporan'])->name("laporan");
// Route::get('log-harian', [AbsensiController::class, 'logHarian'])->name('log-harian');
// Route::get('user/create', [LoginController::class, 'register'])->name('register');
// Route::get('user/edit', [LoginController::class, 'edit'])->name('user.edit');
// Route::get('test', [AbsensiController::class, 'test'])->name("test");
// Route::get('absen/edit', [AbsensiController::class, 'edit'])->name('absensi.edit');

// Route::middleware([checkHakAkses::class . ':Admin'])->group(function () {
//     Route::resource('karyawan', KaryawanController::class);
//     Route::resource('jabatan', JabatanController::class);
//     Route::resource('hari-libur', HariLiburController::class);
//     Route::get('absensi/masuk', [AbsensiController::class, 'create']);
//     Route::get('absensi/izin', [AbsensiController::class, 'absenIzin'])->name('absensi.izin');
//     Route::get('absensi/keluar', [AbsensiController::class, 'absenKeluar'])->name('absensi.keluar');
//     Route::get('user/create', [LoginController::class, 'register'])->name('register');
// });

// Route::middleware([checkHakAkses::class . ':Director'])->group(function () {
//     Route::get('absensi/ubah', [AbsensiController::class, 'absensiEdit'])->name('absensi.edit');
// });

// Route::middleware([checkHakAkses::class . ':Admin,Director, General Manager'])->group(function () {
//     Route::get('laporan', [AbsensiController::class, 'laporan'])->name("laporan");
// });

// Route::middleware([checkHakAkses::class . ':Admin,Director'])->group(function () {
//     Route::get('gaji', [AbsensiController::class, 'gaji'])->name("gaji");
// });

// Route untuk Admin
// Route::middleware([CheckAdmin::class])->group(function () {
//     Route::resource('karyawan', KaryawanController::class);
//     Route::resource('jabatan', JabatanController::class);
//     Route::resource('hari-libur', HariLiburController::class);
//     Route::get('absensi/masuk', [AbsensiController::class, 'create']);
//     Route::get('absensi/izin', [AbsensiController::class, 'absenIzin'])->name('absensi.izin');
//     Route::get('absensi/keluar', [AbsensiController::class, 'absenKeluar'])->name('absensi.keluar');
//     Route::get('laporan', [AbsensiController::class, 'laporan'])->name("laporan");
//     Route::get('gaji', [AbsensiController::class, 'gaji'])->name("gaji");
//     Route::get('user/create', [LoginController::class, 'register'])->name('register');
// });

// // Route untuk Director
// Route::middleware([CheckDirector::class])->group(function () {
//     Route::get('absensi/ubah', [AbsensiController::class, 'absensiEdit'])->name('absensi.edit');
//     Route::get('gaji', [AbsensiController::class, 'gaji'])->name("gaji");
//     Route::get('laporan', [AbsensiController::class, 'laporan'])->name("laporan");
// });

// // Route untuk General Manager
// Route::middleware([CheckGeneralManager::class])->group(function () {
//     Route::get('laporan', [AbsensiController::class, 'laporan'])->name("laporan");
// });


Route::middleware([checkHakAkses::class])->group(function () {

    Route::get('laporan', [AbsensiController::class, 'laporan'])->name("laporan");
    Route::get('log-harian', [AbsensiController::class, 'logharian'])->name("logharian");
    
    // Route untuk Admin
    Route::middleware([CheckAdmin::class])->group(function () {
        Route::resource('karyawan', KaryawanController::class);
        Route::resource('jabatan', JabatanController::class);
        Route::resource('hari-libur', HariLiburController::class);
        Route::get('absensi/masuk', [AbsensiController::class, 'create']);
        Route::get('absensi/izin', [AbsensiController::class, 'absenIzin'])->name('absensi.izin');
        Route::get('absensi/keluar', [AbsensiController::class, 'absenKeluar'])->name('absensi.keluar');
        Route::get('gaji', [AbsensiController::class, 'gaji'])->name("gaji");
        Route::get('user/create', [LoginController::class, 'register'])->name('register');
    });

    // Route untuk Director
    Route::middleware([CheckDirector::class])->group(function () {
        Route::get('absensi/ubah', [AbsensiController::class, 'absensiEdit'])->name('absensi.edit');
        Route::get('gaji', [AbsensiController::class, 'gaji'])->name("gaji");
       
    });

    // Route untuk General Manager
    Route::middleware([CheckGeneralManager::class])->group(function () {
  
    });
});



// Route::middleware(['auth'])->group(function () {
//     Route::resource('karyawan', KaryawanController::class);
//     Route::resource('jabatan', JabatanController::class);
//     Route::resource('hari-libur', HariLiburController::class);
//     Route::get('gaji', [AbsensiController::class, 'gaji'])->name("gaji");
//     Route::get('laporan', [AbsensiController::class, 'laporan'])->name("laporan");
//     Route::get('log-harian', [AbsensiController::class, 'logHarian'])->name('log-harian');
//     Route::get('user/edit', [LoginController::class, 'edit'])->name('user.edit');
//     Route::get('test', [AbsensiController::class, 'test'])->name("test");
//     Route::get('absen/edit', [AbsensiController::class, 'edit'])->name('absensi.edit');
// });