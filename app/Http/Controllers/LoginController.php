<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
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

     public function showListOfUsername() {
      return view('user.index');
     }

     public function edit() {
        return view();
     }

    
}
