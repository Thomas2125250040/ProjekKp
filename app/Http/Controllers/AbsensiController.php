<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Absensi;
use App\Models\HariLibur;
use App\Models\KaryawanAbsensi;
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
        $libur = HariLibur::whereDate('tanggal_mulai', '<=', $currentDate)
                    ->whereDate('tanggal_selesai', '>=', $currentDate)
                    ->get(['id', 'keterangan']);
        if ($absensi->isEmpty()){
            if (!$libur->isEmpty()) {
                $absen = new Absensi([
                    'id_libur' => $libur->first()->id,
                    'tanggal' => $currentDate
                ]);
                $absen->save();
                return view('absensi.absenMasuk')->with('libur', $libur->first()->keterangan);
            }
            return view('absensi.absenMasuk')->with('error', "Tidak ada data absensi untuk hari ini, apakah Anda ingin membuat satu?");
        } else if ($absensi->first()->id_libur){
            return view('absensi.absenMasuk')->with('libur', $libur->first()->keterangan);
        }
        return view('absensi.absenMasuk')->with('id_absensi', $absensi->first()->id);
    }

    public function buat(){
        date_default_timezone_set('Asia/Jakarta');
        $currentDate = now()->toDateString(); // Get the current date in 'Y-m-d' format
        $absen = new Absensi([
            'tanggal' => $currentDate
        ]);
        $absen->save();
        return redirect()->route('absensi.masuk');
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

    public function simpan_masuk(Request $request)
    {
        $id_absensi = $request->id_absensi;
        $new_data = $request->data;
        if (empty($new_data)) {
            return response()->json("",400);
        }
        foreach($new_data as $item){
            $karyawan_absensi = new KaryawanAbsensi([
                'id_absensi'=> $id_absensi,
                'id_karyawan' => $item['id'],
                'waktu_masuk' => $item['masuk']
            ]);
            $karyawan_absensi->save();
        }
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
        $params = request()->query();
        $id_absensi = $params['id'];
        $q = $params['q'];
        $data = Karyawan::where('nama', 'like', "%{$q}%")
            ->get(['id', 'nama']);
        if (count($data) >= 1) {
            return response()->json(['data' => $data]);
        } else {
            dd($data);
            return response()->json('--Nama karyawan tidak ditemukan--');
        }
    }

    public function logHarian()
    {
        return view('absensi.logHarian');
    }
}