<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class AbsensiController extends Controller
{
    public function create()
    {
        return view('absensi.absenMasuk');
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('absensi.absenEdit');
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
    public function destroy(string $id)
    {
        //
    }

    public function cache(Request $request)
    {
        $temp = $request->data;
        date_default_timezone_set('Asia/Jakarta');
        $current_time = Carbon::now();
        $next_midnight = Carbon::tomorrow()->startOfDay();
        $seconds_until_midnight = (int) abs($next_midnight->diffInSeconds($current_time));
        Cache::put("absen", $temp, $seconds_until_midnight);
        return "Data berhasil disimpan.";
    }

    public function getCache()
    {
        return Cache::get("absen");
    }

    public function absenKeluar()
    {
        $data = Cache::get("absen", []);
        return view('absensi.absenKeluar', compact('data'));
    }

    public function absenIzin()
    {
        return view('absensi.absenIzin');
    }

    public function absensiEdit()
    {
        return view('absensi.editAbsensi');
    }

    // public function gaji() {
    //     return view('absensi.gaji');
    // }

    // public function laporan() {
    //     return view('absensi.laporan');
    // }

    public function laporan()
    {
        return view('absensi.laporan');
    }


    public function gaji()
    {
        $gaji = DB::select("SELECT karyawan.nama, jabatan.nama as jabatan, gaji.gaji_pokok, gaji.uang_makan, gaji.uang_lembur FROM karyawan, jabatan, gaji WHERE karyawan.id_jabatan = jabatan.id AND jabatan.id = gaji.id_jabatan AND gaji.bulan = ? AND gaji.tahun = ?", ['01', date('Y')]);

        return view('absensi.gajis', compact('gaji'));
    }

    public function filter(Request $request)
{
    $bulan = $request->input('bulan');
    $tahun = $request->input('tahun');

    $gaji = DB::select("SELECT karyawan.nama, jabatan.nama as jabatan, gaji.gaji_pokok, gaji.uang_makan, gaji.uang_lembur FROM karyawan, jabatan, gaji WHERE karyawan.id_jabatan = jabatan.id AND jabatan.id = gaji.id_jabatan AND gaji.bulan = ? AND gaji.tahun = ?", [$bulan, $tahun]);

    return response()->json($gaji);
}


    public function search()
    {
        $filter = request()->query();
        $cache = Cache::get("absen", []);
        $cachedNames = collect($cache)->pluck('name')->toArray();
        $data = Karyawan::where('nama_karyawan', 'like', "%{$filter['q']}%")
            ->whereNotIn('nama_karyawan', $cachedNames)
            ->pluck('nama_karyawan');
        if (count($data) >= 1) {
            return response()->json(['data' => $data]);
        } else {
            return response()->json('--Nama karyawan tidak ditemukan--');
        }
    }

    public function logHarian()
    {
        return view('absensi.logHarian');
    }

    public function test()
    {
        return view("absensi.test");
    }
}