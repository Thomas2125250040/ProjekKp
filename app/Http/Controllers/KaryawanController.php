<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function search() {
        $filter = request()->query();
        return Karyawan::where('nama_karyawan', 'like', "%{$filter['q']}%")->get();
    }

    public function index() {
        
    }
}
