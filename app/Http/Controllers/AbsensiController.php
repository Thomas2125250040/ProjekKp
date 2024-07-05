<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Absensi;
use App\Models\HariLibur;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class AbsensiController extends Controller
{
    public function masuk()
    {
        date_default_timezone_set('Asia/Jakarta');
        $currentDate = now()->toDateString(); // Get the current date in 'Y-m-d' format
        $absensi = Absensi::whereDate('tanggal', $currentDate)->get();
        if ($absensi->isEmpty()){
            $libur = HariLibur::whereDate('tanggal_mulai', '<=', $currentDate)
                    ->whereDate('tanggal_selesai', '>=', $currentDate)
                    ->get(['id']);
            if (!$libur->isEmpty()) {
                $absen = new Absensi([
                    'id_libur' => $libur->first()->id,
                    'tanggal' => $currentDate
                ]);
                $absen->save();
            }
        }
        return view('absensi.absenMasuk')->with('error', "Tidak ada data absensi untuk hari ini, apakah Anda ingin membuat satu?");
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
        $new_data = $request->data;
        if (empty($new_data)) {
            return response()->json("",400);
        }
        date_default_timezone_set('Asia/Jakarta');
        $current_time = Carbon::now();
        $next_midnight = Carbon::tomorrow()->startOfDay();
        $seconds_until_midnight = (int) abs($next_midnight->diffInSeconds($current_time));
        $old_data = Cache::get('absen');
        // If there's no old data, initialize it as an empty array
        if (is_null($old_data)) {
            $old_data = [];
        }
        // Merge old data with new data
        $merged_data = array_merge($old_data, $new_data);
        Cache::put('absen', $merged_data, $seconds_until_midnight);
        return "Data berhasil disimpan.";
    }

    public function get_cache()
    {
        return Cache::get('absen');
    }

    public function keluar()
    {
        $data = Cache::get('absen', []);
        return view('absensi.absenKeluar', compact('data'));
    }

    public function izin()
    {
        $data_masuk = collect(Cache::get('absen', []));
        $data_izin = collect(Cache::get('izin', []));
        $nama_masuk = $data_masuk->pluck('nama');
        $nama_izin = $data_izin->pluck('nama');
        $data_alpha = Karyawan::whereNotIn('nama', $nama_masuk->merge($nama_izin))->get(['id', 'nama']);
        return view('absensi.absenIzin', ['alpha' => $data_alpha, 'izin' => $data_izin]);
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
        $cachedNames = collect($cache)->pluck('nama')->toArray();
        $data = Karyawan::where('nama', 'like', "%{$filter['q']}%")
            ->whereNotIn('nama', $cachedNames)
            ->get(['id', 'nama']);
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
}