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
        $jabatan = DB::select('select * from jabatan');
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
            'kode_jabatan' => 'required|unique:jabatan,kode_jabatan',
            'nama_jabatan' => 'required',
            'gaji_pokok' => 'required',
        ]);

        $jabatan = new Jabatan([
            'id_jabatan' => (string) \Str::uuid(),
            'kode_jabatan' => $request->kode_jabatan,
            'nama_jabatan' => $request->nama_jabatan,
            'gaji_pokok' => $request->gaji_pokok,
        ]);

        $jabatan->save();

        return redirect()->route('jabatan.index')->with('success', 'Jabatan ' . $jabatan->nama_jabatan . '  berhasil ditambahkan !');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jabatan $jabatan)
    {
        $jabatan->delete();
        return redirect('jabatan')->with("success", "Jabatan " . $jabatan->nama_jabatan ."  berhasil dihapus !");
    }
}
