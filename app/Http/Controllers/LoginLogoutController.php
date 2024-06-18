<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginLogoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function login(Request $request)
     {
         $request->validate([
             'username' => 'username',
             'password' => 'required'
         ]);
 
         $username = $request->username;
         $password = $request->password;
 
         $user = User::where('email', $email)->first();
 
         if ($user && Hash::check($password, $user->password)) {
             // Cek apakah kode_karyawan dimulai dengan huruf 'A'
             $role = (substr($user->kode_karyawan, 0, 1) === 'A') ? 'admin' : 'karyawan';
 
             if ($role === 'admin') {
                 // Redirect ke halaman admin jika peran adalah admin
                 Auth::login($user);
                 return redirect('/admin-dashboard');
             } elseif ($role === 'karyawan') {
                 // Redirect ke halaman karyawan jika peran adalah karyawan
                 Auth::login($user);
                 return redirect('/karyawan-dashboard');
             }
         }
 
         // Jika login gagal, kembalikan ke halaman login
         Session::flash('error');
         return redirect('/login');
     }

    public function index()
    {
        //
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
