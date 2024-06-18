<?php

use App\Http\Controllers\jabatanController;
use App\Http\Controllers\LoginRegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('authentication-login');
});

Route::get('/login', function () {
    return view('authentication-login');
});

Route::get('/register', function () {
    return view('authentication-register');
});

Route::get('/director-dashboard', function () {
    return view('director.index');
});
Route::get('/admin-dashboard', function () {
    return view('admin.index');
});

Route::get('/gm-dashboard', function () {
    return view('gm.index');
});


Route::get('/karyawan', function () {
    return view('pegawai');
});

Route::get('/create-karyawan', function () {
    return view('admin.createKaryawan');
});

Route::group(['prefix'=>'jabatan'], function() {
    Route::get('',[jabatanController::class, 'index'])->name('jabatan.index');
    Route::get('create',[jabatanController::class, 'create'])->name('jabatan.create');
    Route::get('edit',[jabatanController::class, 'edit'])->name('jabatan.edit');
    Route::post('store',[jabatanController::class, 'store'])->name('jabatan.store');
});

Route::post('/login', [LoginRegisterController::class , 'login']);

