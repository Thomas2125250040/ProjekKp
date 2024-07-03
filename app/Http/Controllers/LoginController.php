<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

   public function index()
   {
      return view('user.login');
   }

   public function login(Request $request)
   {
      $request->validate([
         'username' => 'required',
         'password' => 'required',
      ]);

      // Retrieve username and password from the request
      $username = $request->username;
      $password = $request->password;

      $user = DB::table('users')
         ->join('karyawan', 'users.id_karyawan', '=', 'karyawan.id')
         ->select('users.*', 'karyawan.nama', 'karyawan.foto')
         ->where('users.username', $username)
         ->first();

      if ($user && Hash::check($password, $user->password)) {

         session(['hak_akses' => $user->hak_akses]);
         session(['username' => $user->username]);
         session(['nama' => $user->nama]);
         session(['foto' => $user->foto]);

         switch ($user->hak_akses) {
            case 'Admin':
               return redirect('laporan');
               break;
            case 'General Manager':
               return redirect('laporan');
               break;
            case 'Director':
               return redirect('laporan');
               break;
         }
      } else {
         return redirect()->back()->with('error', 'Username atau password salah!');
      }

   }

   // public function showListOfUsername()
   // {
   //    return view('user.index');
   // }

   public function logout()
   {
      Auth::logout();
      Session::forget('hak_akses');
      Session::forget('username');
      Session::forget('nama');
      Session::forget('foto');

      return redirect('/')->with('success', 'Anda telah berhasil logout.');
   }
}
