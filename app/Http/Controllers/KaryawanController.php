<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawan = DB::select('select karyawan.* , jabatan.nama as nama_jabatan FROM karyawan join jabatan on jabatan.id = karyawan.id_jabatan;');
        $jabatan = DB::select('select * from jabatan');
        return view("admin.karyawan", ["karyawan" => $karyawan], ["jabatan" => $jabatan]);
    }

    public function create()
    {
        $jabatan = DB::select('select * from jabatan');
        return view('admin.createKaryawan', ["jabatan" => $jabatan]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'id_jabatan' => 'required',
            'nama' => 'required',
            'email' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'foto' => 'nullable|file|image',
            'agama' => 'required',
            'no_telp' => 'required',
        ]);

        $ext = $request->foto->getClientOriginalExtension();
        $nama_file = "foto-" . time() . "." . $ext;
        $path = $request->foto->storeAs('public', $nama_file);

        $karyawan = new Karyawan([
            'id' => $request->id,
            'id_jabatan' => $request->id_jabatan,
            'nama' => $request->nama,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'foto' => $nama_file,
            'agama' => $request->agama,
            'no_telp' => $request->no_telp,
        ]);

        $karyawan->save();
        return redirect()->route('karyawan.index')->with('success', 'Biodata "' . $request->nama . '" berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $karyawan = Karyawan::find($id);
        $jabatanOptions = Jabatan::pluck('nama', 'id');
        return view("admin.editKaryawan", compact('karyawan', 'jabatanOptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        $request->validate([
            'id' => 'required',
            'id_jabatan' => 'required',
            'nama' => 'required',
            'email' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'foto' => 'nullable|file|image',
            'agama' => 'required',
            'no_telp' => 'required',
        ]);

        $nama_file = $karyawan->foto;

        if ($request->hasFile('foto')) {
            $ext = $request->foto->getClientOriginalExtension();
            $nama_file = "foto-" . time() . "." . $ext;
            $path = $request->foto->storeAs('public', $nama_file);

            if (Storage::exists('public/' . $karyawan->foto)) {
                Storage::delete('public/' . $karyawan->foto);
            }
        } else {
            $nama_file = $karyawan->foto;
        }

        $karyawan->update([
            'id' => $request->id,
            'id_jabatan' => $request->id_jabatan,
            'nama' => $request->nama,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'foto' => $nama_file,
            'agama' => $request->agama,
            'no_telp' => $request->no_telp,
        ]);

        session(['foto' => $karyawan->foto]);

        return redirect('karyawan')->with("success", "Biodata " . $request->nama . " berhasil diperbarui.");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $karyawan = DB::table('karyawan')
            ->join('jabatan', 'karyawan.id_jabatan', '=', 'jabatan.id')
            ->select('karyawan.*', 'jabatan.nama as nama_jabatan')
            ->where('karyawan.id', $id)
            ->first();

        return view('Admin.showKaryawan', ['karyawan' => $karyawan]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karyawan $karyawan)
    {
        $karyawan->delete();
        return redirect('karyawan')->with('success', 'Biodata "' . $karyawan->nama . '" berhasil dihapus.');
    }

}
