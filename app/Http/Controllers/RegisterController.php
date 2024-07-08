<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = DB::select('select users.*, karyawan.nama from users,karyawan where karyawan.id = users.id_karyawan');
        $karyawan = DB::select('select * from karyawan');
        return view("user.index", ["users" => $users], ["karyawan" => $karyawan]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_karyawan' => 'required|unique:App\Models\User',
            'username' => 'required|unique:App\Models\User',
            'password' => 'required|min:6',
            'hak_akses' => 'required|in:Admin,Director,General Manager'
        ]);

        $users = new User([
            'id_karyawan' => $request->id_karyawan,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'hak_akses' => $request->hak_akses
        ]);

        $users->save();
        return redirect('users')->with('success', 'Username "' . $users->username . '" berhasil ditambahkan.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = DB::select('select * from karyawan');
        return view('user.register', ["users" => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::find($id);
        return view("user.edit", ["users" => $users]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'id_karyawan' => 'required',
            'username' => 'required',
            'password' => 'required|min:6',
            'hak_akses' => 'required'
        ]);

        User::find($id)->update($data);
        return redirect("users")->with("success", 'Username "' . $request->username . '" berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id_karyawan)
    {
        // Ambil id karyawan dari session pengguna yang sedang login
        $loggedInIdKaryawan = session('id_karyawan');
    
        // Ambil data user berdasarkan id_karyawan
        $user = User::where('id_karyawan', $id_karyawan)->firstOrFail();
    
        // Pengecekan apakah pengguna sedang mencoba menghapus data dirinya sendiri
        if ($user->id_karyawan == $loggedInIdKaryawan) {
            // Hapus data karyawan
            $user->delete();
    
            // Logout user (hapus session)
            session()->flush(); // Hapus semua data sesi
    
            // Redirect ke halaman login dengan pesan sukses
            return redirect()->route('login')->with('success', 'Username Anda telah dihapus. Silahkan gunakan akun lain.');
        }
    
        // Hapus data karyawan
        $user->delete();
    
        return redirect("users")->with("success", 'Username berhasil dihapus.'); 
    }
}
