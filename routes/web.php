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
use App\Http\Middleware\antiLoginLagi;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\checkAdminDirector;
use Illuminate\Support\Facades\Route;

Route::get("/cetak", function () {
    return view('absensi.halamanCetakLaporan');
});

Route::middleware([antiLoginLagi::class])->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login-page');
    Route::post('/', [LoginController::class, 'login'])->name('login');
});

Route::middleware([checkHakAkses::class])->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/error', function () {
        return view('user.error');
    });

    Route::get('/laporan', [AbsensiController::class, 'laporan'])->name('laporan');
    Route::post('/laporan/filter', [AbsensiController::class, 'laporanFilter'])->name('laporan.filter');

    // Route::get('/cetak', [AbsensiController::class, 'showReport'])->name('report.show');
    Route::get('/print-pdf', [AbsensiController::class, 'generatePDF'])->name('print.pdf');
    Route::get('log-harian', [AbsensiController::class, 'logharian'])->name("logharian");

    Route::middleware([CheckAdminDirector::class])->group(function () {
        Route::get('/gaji', [AbsensiController::class, 'index'])->name('gaji.index');
        Route::post('/gaji/filter', [AbsensiController::class, 'filter'])->name('gaji.filter');
        Route::get('gaji', [AbsensiController::class, 'gaji'])->name('gaji');
        Route::get('register', [LoginController::class, 'register'])->name('register');
        Route::post('register', [LoginController::class, 'store'])->name('save');
        Route::resource('users', RegisterController::class);
        Route::resource('karyawan', KaryawanController::class);
        Route::resource('jabatan', JabatanController::class);
        Route::resource('hari-libur', HariLiburController::class);
        Route::get('search', [AbsensiController::class, 'search'])->name('absensi.search-karyawan');
        Route::get('absensi/masuk', [AbsensiController::class, 'masuk'])->name('absensi.masuk');
        Route::get('absensi/izin', [AbsensiController::class, 'izin'])->name('absensi.izin');
        Route::get('absensi/keluar', [AbsensiController::class, 'keluar'])->name('absensi.keluar');
        Route::get('absensi/buat', [AbsensiController::class, 'buat'])->name('absensi.buatSatu');
        Route::post('save/masuk', [AbsensiController::class, 'simpan_masuk'])->name('absensi.simpan-data-masuk');
        Route::post('save/izin', [AbsensiController::class, 'simpan_izin'])->name('absensi.simpan-data-izin');
        Route::post('save/keluar', [AbsensiController::class, 'simpan_keluar'])->name('absensi.simpan-data-keluar');
        Route::get('save/tutup', [AbsensiController::class, 'tutup_absensi'])->name('absensi.tutup-absensi');
    });

    // Route untuk Admin
    Route::middleware([CheckAdmin::class])->group(function () {

    });

    // Route untuk Director
    Route::middleware([CheckDirector::class])->group(function () {
        Route::get('absensi/ubah', [AbsensiController::class, 'editAbsensi'])->name('absensi.edit');
    });

    // Route untuk General Manager
    Route::middleware([CheckGeneralManager::class])->group(function () {

    });

    Route::get('test', function () {
        return view('test');
    });
});