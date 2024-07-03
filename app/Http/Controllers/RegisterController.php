<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = DB::select('select users.*, karyawan.nama from users,karyawan where karyawan.id = users.id_karyawan');
        return view("user.index", ["users" => $users]);
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
        return redirect('user')->with('success', 'Username "' . $users->username . '" berhasil ditambahkan.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.register');
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
        $users = User::findOrFail($id_karyawan);
        $users->delete();

        return redirect()->route('users.index')->with('success', 'Username "' . $users->username . '" berhasil dihapus.');
    }

}
