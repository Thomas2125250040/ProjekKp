<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function search() {
        $filter = request()->query();
        return Karyawan::where('nama_karyawan', 'like', "%{$filter['q']}%")->get();
    }

    public function index() {
        $karyawan = Karyawan::latest('nama_karyawan')->get();
        return view('admin.karyawan', compact('karyawan'));
    }

    public function create() {
        $jabatan = Jabatan::get();
        return view('admin.createKaryawan', compact('jabatan'));
    }

    public function store() {
        
    }
}
