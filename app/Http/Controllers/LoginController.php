<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

     public function index()
     {
         return view('user.login');
     }

    public function login(Request $request)
     {
         // Validasi input
        $credentials = $request->validate([
             'username' => 'required',
             'password' => 'required'
         ]);

         if (auth()->attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('jabatan');
         }

         return redirect()->back()->withErrors(['username' => 'Invalid Credentials']);
     }

     public function register() {
        return view('user.register');
     }

     public function store(Request $request) {
         $data = $request->validate([
            'id_karyawan' => 'required|unique:App\Models\User',
            'username' => 'required|unique:App\Models\User',
            'password' => 'required|min:6',
            'hak_akses' => 'required|in:Admin,Director,Manajer'
         ]);

         $user = new User([
            'id_karyawan' => $request->id_karyawan,
            'username' => $request->username,
            'password'=> Hash::make($request->password),
            'hak_akses' => $request->hak_akses
         ]);

         $user->save();

         return redirect()->back();
     }

     public function showListOfUsername() {
      return view('user.index');
     }

     public function edit() {
        return view();
     }

    
}
