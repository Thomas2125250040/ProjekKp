<?php

use App\Http\Controllers\jabatanController;
<<<<<<< Updated upstream
use App\Http\Controllers\LoginLogoutController;
=======
use App\Http\Controllers\LoginRegisterController;
>>>>>>> Stashed changes
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

<<<<<<< Updated upstream
Route::post('/login', [LoginLogoutController::class , 'login']);
=======
Route::post('/login', [LoginRegisterController::class , 'login']);
>>>>>>> Stashed changes
