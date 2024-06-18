<?php

use App\Http\Controllers\jabatanController;
use App\Http\Controllers\LoginLogoutController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('authentication-login');
});

Route::get('/register', function () {
    return view('authentication-register');
});

Route::get('/dashboard', function () {
    return view('index');
});

Route::get('/pegawai', function () {
    return view('pegawai');
});

Route::get('/create-pegawai', function () {
    return view('createPegawai');
});

Route::group(['prefix'=>'jabatan'], function() {
    Route::get('',[jabatanController::class, 'index'])->name('jabatan.index');
    Route::get('create',[jabatanController::class, 'create'])->name('jabatan.create');
    Route::get('edit',[jabatanController::class, 'edit'])->name('jabatan.edit');
    Route::post('store',[jabatanController::class, 'store'])->name('jabatan.store');
});

Route::post('/login', [LoginLogoutController::class , 'login']);