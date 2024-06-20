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
Route::get('search-nama-karyawan', [KaryawanController::class, 'search']);

// Route::get('/karyawan', function () {
//     return view('pegawai');
// });

// Route::get('/create-karyawan', function () {
//     return view('admin.createKaryawan');
// });
//Route::get('/create-karyawan',[KaryawanController::class, 'create']);

// Route::group(['prefix'=>'jabatan'], function() {
//     Route::get('',[JabatanController::class, 'index'])->name('jabatan.index');
//     Route::get('create',[JabatanController::class, 'create'])->name('jabatan.create');
//     Route::get('{id_jabatan}/edit', [JabatanController::class, 'edit'])->name('jabatan.edit');
//     Route::patch('{id_jabatan}', [JabatanController::class, 'update'])->name('jabatan.update');;
//     Route::post('store',[JabatanController::class, 'store'])->name('jabatan.store');
//     Route::delete('{id_jabatan}', [JabatanController::class, 'destroy'])->name('jabatan.destroy');
// });

//Route::group(['prefix'=>'karyawan'], function() {
    //Route::get('',[KaryawanController::class, 'index'])->name('karyawan.index');
    // Route::get('create',[KaryawanController::class, 'create'])->name('karyawan.create');
    //Route::get('edit',[KaryawanController::class, 'edit'])->name('karyawan.edit');
   // Route::post('store',[KaryawanController::class, 'store'])->name('karyawan.store');
    //Route::get('search',[KaryawanController::class, 'search'])->name('karyawan.search');
//});

