<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class KaryawanController extends Controller
{
    public function search()
    {
        $filter = request()->query();
        return Karyawan::where('nama_karyawan', 'like', "%{$filter['q']}%")->get();
    }

    public function index()
    {
        $karyawan = DB::select('select karyawan.id_karyawan, kode_karyawan, nama_karyawan, nama_jabatan, alamat, nomor_telepon from karyawan join jabatan on jabatan.kode_jabatan = karyawan.kode_jabatan');
        return view("admin.karyawan", ["karyawan" => $karyawan]);
    }

    public function create()
    {
        $jabatan = DB::select('select * from jabatan');
        return view('admin.createKaryawan', ["jabatan" => $jabatan]);
    }

    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'kode_karyawan' => 'required|unique:karyawan,kode_karyawan',
            'nama_karyawan' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'email' => 'required|email|unique:karyawan,email',
            'kode_jabatan' => 'required',
            'password' => 'required|min:6',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'nomor_telepon' => 'required',
        ]);

        // Create a new karyawan instance
        $karyawan = new Karyawan([
            'id_karyawan' => (string) \Str::uuid(),
            'kode_karyawan' => $request->kode_karyawan,
            'nama_karyawan' => $request->nama_karyawan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'email' => $request->email,
            'kode_jabatan' => $request->kode_jabatan,
            'password' => hash::make($request->password), // Ensure you hash the password
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'nomor_telepon' => $request->nomor_telepon,
        ]);

        // Save the karyawan to the database
        $karyawan->save();

        // Redirect with success message
        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil ditambahkan.');
    }



    public function edit($id_karyawan)
    {
        $karyawan = Karyawan::find($id_karyawan);
        $jabatanOptions = Jabatan::pluck('nama_jabatan', 'kode_jabatan');
        return view("admin.editKaryawan", compact('karyawan', 'jabatanOptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_karyawan)
    {
        $validasi = $request->validate([
            "email" => "required",
            "password" => "required|min:8",
            "kode_karyawan" => "required",
            "nama_karyawan" => "required",
            "kode_jabatan" => "required",
            "jenis_kelamin" => "required",
            "tempat_lahir" => "required",
            "tanggal_lahir" => "required",
            "alamat" => "required",
            "agama" => "required",
            "nomor_telepon" => "required",
        ]);
        Karyawan::find($id_karyawan)->update($validasi);
        return redirect("karyawan")->with("success", "Biodata " . $request->nama_karyawan . " berhasil diperbarui.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karyawan $karyawan)
    {
        $karyawan->delete();
        return redirect('karyawan')->with('success', 'Biodata ' . $karyawan->nama_karyawan . ' berhasil dihapus.');
    }
}
