<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jabatan = Jabatan::all();
        return view("admin.jabatan", ["jabatan" => $jabatan]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.createJabatan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_jabatan' => 'required|unique:jabatan,id',
            'nama_jabatan' => 'required',
            'gaji_pokok' => 'required',
            'uang_makan' => 'required',
            'uang_lembur' => 'required'
        ]);

        $jabatan = new Jabatan([
            'id' => $request->id_jabatan,
            'nama' => $request->nama_jabatan,
            'gaji_pokok' => $request->gaji_pokok,
            'uang_makan' => $request->uang_makan,
            'uang_lembur' => $request->uang_lembur
        ]);

        $jabatan->save();
        return redirect('jabatan')->with('success', 'Jabatan "' . $jabatan->nama . '" berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_jabatan)
    {
        $jabatan = Jabatan::find($id_jabatan);
        return view("admin.editJabatan", ["jabatan" => $jabatan]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_jabatan)
    {
        $validasi = $request->validate([
            "kode_jabatan" => 'required',
            "nama_jabatan" => "required",
            "gaji_pokok" => "required",
        ]);

        $jabatanSebelum = Jabatan::find($id_jabatan);
        $namaJabatanSebelum = $jabatanSebelum->nama_jabatan;

        Jabatan::find($id_jabatan)->update($validasi);
        return redirect("jabatan")->with("success", "Jabatan $namaJabatanSebelum berhasil diperbarui.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jabatan $jabatan)
    {
        $jabatan->delete();
        return redirect()->route('jabatan.index')->with("success", 'Jabatan "'.$jabatan->nama.'" berhasil dihapus.');
    }

}
