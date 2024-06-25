<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('absensi.createAbsensi');
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
    public function destroy(string $id)
    {
        //
    }

    public function cache(Request $request){
        $temp = $request->data;
        date_default_timezone_set('Asia/Jakarta');
        $current_time = Carbon::now();
        $next_midnight = Carbon::tomorrow()->startOfDay();
        $seconds_until_midnight = (int) abs($next_midnight->diffInSeconds($current_time));
        Cache::put("absen", $temp, $seconds_until_midnight);
        return "Data berhasil disimpan.";
    }

    public function getCache(){
        return Cache::get("absen");
    }

    public function absenKeluar(){
        $data = Cache::get("absen", []);
        return view('absensi.absenKeluar', compact('data'));
    }

    public function absenIzin() {
        return view('absensi.absenIzin');
    }

    public function absensiEdit() {
        return view('absensi.editAbsensi');
    }

    public function absensiLibur() {
        return view('absensi.hariLibur');
    }

    public function gaji() {
        return view('absensi.gaji');
    }

    public function laporan() {
        return view('absensi.laporan');
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

    public function test() {
        return view("absensi.test");
    }
}