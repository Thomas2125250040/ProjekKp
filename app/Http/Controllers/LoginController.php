<?php

namespace App\Http\Controllers;

use App\Models\User;
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
         return redirect()->back()->with('error', 'Username or password salah!');
      }

   }

   public function register()
   {
      return view('user.register');
   }

   public function store(Request $request)
   {
      $data = $request->validate([
         'id_karyawan' => 'required|unique:App\Models\User',
         'username' => 'required|unique:App\Models\User',
         'password' => 'required|min:6',
         'hak_akses' => 'required|in:Admin,Director,General Manager'
      ]);

      $user = new User([
         'id_karyawan' => $request->id_karyawan,
         'username' => $request->username,
         'password' => Hash::make($request->password),
         'hak_akses' => $request->hak_akses
      ]);

      $user->save();

      return redirect()->back();
   }

   public function showListOfUsername()
   {
      return view('user.index');
   }

   public function edit()
   {
      return view();
   }

   public function logout(){
    Auth::logout(); // Menghapus sesi autentikasi pengguna
    Session::forget('hak_akses'); // Menghapus data hak_akses dari session
    Session::forget('username'); // Menghapus data username dari session
    Session::forget('nama'); // Menghapus data nama dari session
    Session::forget('foto'); // Menghapus data foto dari session

    return redirect('/')->with('success', 'Anda telah berhasil logout.');
   }
}
