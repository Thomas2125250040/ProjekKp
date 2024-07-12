<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class jabatanController extends Controller
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
            'id' => 'required|unique:jabatan,id',
            'nama' => 'required',
        ]);

        $jabatan = new Jabatan([
            'id' => $request->id,
            'nama' => $request->nama,
        ]);

        $jabatan->save();
        return redirect('jabatan')->with('success', 'Jabatan "' . $jabatan->nama . '" berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jabatan = Jabatan::find($id);
        return view("admin.editJabatan", ["jabatan" => $jabatan]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = $request->validate([
            'id' => 'required',
            'nama' => 'required',
        ]);

        Jabatan::find($id)->update($validasi);
        return redirect("jabatan")->with("success", 'Jabatan "' . $request->nama . '" berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jabatan $jabatan)
    {
        $jabatan->delete();
        return redirect()->route('jabatan.index')->with("success", 'Jabatan "' . $jabatan->nama . '" berhasil dihapus.');
    }

}
