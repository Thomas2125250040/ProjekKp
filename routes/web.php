<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\HariLiburController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'index'])->name('login-page');
Route::post('/', [LoginController::class, 'login'])->name('login');
Route::get('register', [LoginController::class, 'register'])->name('register');
Route::post('register', [LoginController::class, 'store'])->name('save');
Route::resource('karyawan', KaryawanController::class);
Route::resource('jabatan', JabatanController::class);
Route::resource('hari-libur', HariLiburController::class);
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
Route::get('absen/edit', [AbsensiController::class, 'edit'])->name('absensi.edit');

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