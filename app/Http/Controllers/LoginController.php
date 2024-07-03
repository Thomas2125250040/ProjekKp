<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
      $request->validate([
         'username' => 'required',
         'password' => 'required',
     ]);
     
     // Retrieve username and password from the request
     $username = $request->username;
     $password = $request->password;
     
     // Find the user based on the provided username
   //   $user = User::where('username', $username)->first();
   $user = DB::table('users')
            ->join('karyawan', 'users.id_karyawan', '=', 'karyawan.id')
            ->select('users.*', 'karyawan.nama', 'karyawan.foto')
            ->where('users.username', $username)
            ->first();
   //   dd($user);   
   if ($user && Hash::check($password, $user->password)) {
      // Set session values
      session(['hak_akses' => $user->hak_akses]);
      session(['username' => $user->username]);
      session(['nama' => $user->nama]);
      session(['foto' => $user->foto]);
  
  
      // Redirect based on user's role
      switch ($user->hak_akses) {
          case 'Admin':
              return redirect('karyawan');
              break;
          case 'General Manager':
              return redirect('jabatan');
              break;
          case 'Director':
              return redirect('gaji');
              break;
          default:
              return redirect('laporan');
              break;
      }
  } else {
      // Handle invalid credentials or other login failures
      return redirect()->back()->with('error', 'Invalid username or password');
  }
     
   // 
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
         'hak_akses' => 'required|in:Admin,Director,Manajer'
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


}
