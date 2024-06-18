<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class LoginRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function login(Request $request)
     {
         // Validasi input
         $request->validate([
             'kode_karyawan' => 'required',
             'password' => 'required'
         ]);
 
         $kode_karyawan = $request->kode_karyawan;
         $password = $request->password;
 
         // Ambil karyawan berdasarkan kode_karyawan
         $karyawan = Karyawan::where('kode_karyawan', $kode_karyawan)->first();
 
         // Cek apakah karyawan ditemukan dan password sesuai
         if ($karyawan && Hash::check($password, $karyawan->password)) {
            // Ambil kode_jabatan dari karyawan yang ditemukan
            $kode_jabatan = $karyawan->kode_jabatan;

            // Arahkan ke halaman berdasarkan kode_jabatan
            if ($kode_jabatan === 'A01') {
                return redirect('/director-dashboard');
            } else if ($kode_jabatan === 'A02') {
                return redirect('/gm-dashboard');
            } else if ($kode_jabatan === 'A07') {
                return redirect('/admin-dashboard');
            } else {
                return redirect('/register');
            }
         }
 
         // Jika login gagal, kembalikan ke halaman login dengan pesan error
         Session::flash('error', 'Login gagal. Periksa kode atau password dan coba kembali!');
         return redirect('/login');
     }

    
}
