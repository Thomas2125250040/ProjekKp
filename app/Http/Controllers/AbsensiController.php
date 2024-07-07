<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Absensi;
use App\Models\HariLibur;
use App\Models\KaryawanAbsensi;
use App\Models\KaryawanIzin;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class AbsensiController extends Controller
{
    public function masuk()
    {
        $id_absensi = Cache::get('id_absensi');
        if($keterangan = $this->cek_libur()){
            return view('absensi.absenMasuk')->with('libur', $keterangan);
        }
        else if (is_null($id_absensi)){
            return view('absensi.absenMasuk')->with('error', "Tidak ada data absensi untuk hari ini, apakah Anda ingin membuat satu?");
        }
        return view('absensi.absenMasuk');
    }

    private function cek_libur()
    {
        $id_absensi = Cache::get('id_absensi');
        if (is_null($id_absensi)){
            date_default_timezone_set('Asia/Jakarta');
            $currentDate = now()->toDateString();
            $libur = HariLibur::whereDate('tanggal_mulai', '<=', $currentDate)
                    ->whereDate('tanggal_selesai', '>=', $currentDate)
                    ->get(['id', 'keterangan']);
            if ($libur->isEmpty()){
                return null;
            } else {
                $absen = new Absensi([
                    'id_libur' => $libur->first()->id,
                    'tanggal' => $currentDate
                ]);
                $absen->save();
                Cache::put('id_absensi', $absen->id);
                return $libur->first()->keterangan;
            }
        }
        $absensi = Absensi::find($id_absensi);
        if ($id = $absensi->id_libur) {
            return HariLibur::find($id)->keterangan;
        }
        return null;
    }


    public function buat(){
        date_default_timezone_set('Asia/Jakarta');
        $currentDate = now()->toDateString(); // Get the current date in 'Y-m-d' format
        $absen = new Absensi([
            'tanggal' => $currentDate
        ]);
        $absen->save();
        Cache::put('id_absensi', $absen->id);
        return redirect()->route('absensi.masuk');
    }

    public function edit(string $id)
    {
        return view('absensi.absenEdit');
    }

    public function simpan_masuk(Request $request)
    {
        $id_absensi = Cache::get('id_absensi');
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

    public function simpan_izin(Request $request)
    {
        $id_karyawan = $request->id_karyawan;
        $id_absensi = Cache::get('id_absensi');
        $keterangan = $request->keterangan;
        $izin = new KaryawanIzin([
            'id_absensi'=> $id_absensi,
            'id_karyawan'=> $id_karyawan,
            'izin'=> 1,
            'keterangan'=> $keterangan
        ]);
        $izin->save();
        return "Data berhasil disimpan";
    }

    public function simpan_keluar(Request $request)
    {
        $id_karyawan = $request->id_karyawan;
        $id_absensi = Cache::get('id_absensi');
        $karyawan_absensi = KaryawanAbsensi::find([
            $id_karyawan,
            $id_absensi
        ]);
        $karyawan_absensi->waktu_keluar = $request->waktu_keluar;
        $karyawan_absensi->save();
        return "Data berhasil disimpan";
    }

    public function keluar()
    {
        $id_absensi = Cache::get('id_absensi');
        $data_masuk = KaryawanAbsensi::with('karyawan')->where('id_absensi', $id_absensi)->get();
        return view('absensi.absenKeluar', ['data_masuk' =>$data_masuk]);
    }

    public function izin()
    {
        $id_absensi = Cache::get('id_absensi');
        if($keterangan = $this->cek_libur()){
            return view('absensi.absenIzin')->with('libur', $keterangan);
        }
        else if (is_null($id_absensi)){
            return view('absensi.absenIzin')->with('error', "Tidak ada data absensi untuk hari ini, apakah Anda ingin membuat satu?");
        }
        $nama_masuk = collect(KaryawanAbsensi::with('karyawan')->where('id_absensi', $id_absensi)->get('id_karyawan')
                    ->map(function($item){
                        return $item ? $item->karyawan->nama : null;
                    }));
        $data_izin = KaryawanIzin::with('karyawan')->where('id_absensi', $id_absensi)->get();
        $nama_izin = collect($data_izin->map(function($item){
                        return $item ? $item->karyawan->nama : null;
                    }));
        $existedName = $nama_masuk->merge($nama_izin)->filter()->unique();
        $data_alpha = Karyawan::whereNotIn('nama', $existedName)->get(['id', 'nama']);
        return view('absensi.absenIzin', ['alpha' => $data_alpha, 'izin' => $data_izin]);
    }

    public function laporan()
    {
        return view('absensi.laporan');
    }

    // public function laporans(){
    //     $laporan = DB::select("SELECT k.nama AS nama_karyawan, COUNT(DISTINCT CASE WHEN a.id IS NOT NULL THEN ka.id_absensi END) AS jumlah_hadir, SUM(CASE WHEN ai.id IS NOT NULL AND ki.izin = 1 THEN 1 ELSE 0 END) AS jumlah_izin, SUM(CASE WHEN ai.id IS NOT NULL AND ki.izin = 0 THEN 1 ELSE 0 END) AS jumlah_alpha FROM karyawan k LEFT JOIN karyawan_absensi ka ON k.id = ka.id_karyawan LEFT JOIN absensi a ON ka.id_absensi = a.id AND MONTH(a.tanggal) = 07 AND YEAR(a.tanggal) = 2024 LEFT JOIN karyawan_izin ki ON k.id = ki.id_karyawan LEFT JOIN absensi ai ON ki.id_absensi = ai.id AND MONTH(ai.tanggal) = 07 AND YEAR(ai.tanggal) = 2024 GROUP BY k.nama ORDER BY k.nama; ");

    //     return view("absensi.laporans" , ["laporan" => $laporan]);
    // }

    // public function laporans(Request $request) {
    //     $bulan = $request->input('bulan', date('m'));  // Default to current month if not provided
    //     $tahun = $request->input('tahun', date('Y'));  // Default to current year if not provided
    
    //     $laporan = DB::select("
    //         SELECT k.nama AS nama_karyawan, 
    //             COUNT(DISTINCT CASE WHEN a.id IS NOT NULL THEN ka.id_absensi END) AS jumlah_hadir, 
    //             SUM(CASE WHEN ai.id IS NOT NULL AND ki.izin = 1 THEN 1 ELSE 0 END) AS jumlah_izin, 
    //             SUM(CASE WHEN ai.id IS NOT NULL AND ki.izin = 0 THEN 1 ELSE 0 END) AS jumlah_alpha 
    //         FROM karyawan k 
    //         LEFT JOIN karyawan_absensi ka ON k.id = ka.id_karyawan 
    //         LEFT JOIN absensi a ON ka.id_absensi = a.id AND MONTH(a.tanggal) = ? AND YEAR(a.tanggal) = ? 
    //         LEFT JOIN karyawan_izin ki ON k.id = ki.id_karyawan 
    //         LEFT JOIN absensi ai ON ki.id_absensi = ai.id AND MONTH(ai.tanggal) = ? AND YEAR(ai.tanggal) = ? 
    //         GROUP BY k.nama 
    //         HAVING jumlah_hadir > 0 OR jumlah_izin > 0 OR jumlah_alpha > 0 
    //         ORDER BY k.nama
    //     ", [$bulan, $tahun, $bulan, $tahun]);
    
    //     return view("absensi.laporans", ["laporan" => $laporan]);
    // }
    public function laporans()
{
    // $laporan = DB::select("
    //     SELECT karyawan.nama AS nama_karyawan, 
    //         COUNT(DISTINCT CASE WHEN absensi.id IS NOT NULL THEN karyawan_absensi.id_absensi END) AS jumlah_hadir, 
    //         SUM(CASE WHEN absensi_izin.id IS NOT NULL AND karyawan_izin.izin = 1 THEN 1 ELSE 0 END) AS jumlah_izin, 
    //         SUM(CASE WHEN absensi_izin.id IS NOT NULL AND karyawan_izin.izin = 0 THEN 1 ELSE 0 END) AS jumlah_alpha 
    //     FROM karyawan 
    //     LEFT JOIN karyawan_absensi ON karyawan.id = karyawan_absensi.id_karyawan 
    //     LEFT JOIN absensi ON karyawan_absensi.id_absensi = absensi.id 
    //         AND MONTH(absensi.tanggal) = ? 
    //         AND YEAR(absensi.tanggal) = ? 
    //     LEFT JOIN karyawan_izin ON karyawan.id = karyawan_izin.id_karyawan 
    //     LEFT JOIN absensi absensi_izin ON karyawan_izin.id_absensi = absensi_izin.id 
    //         AND MONTH(absensi_izin.tanggal) = ? 
    //         AND YEAR(absensi_izin.tanggal) = ? 
    //     GROUP BY karyawan.nama 
    //     ORDER BY karyawan.nama
    // ", ['01', date('Y'), '01', date('Y')]);

    $laporan = DB::select("SELECT 
    karyawan.nama AS nama_karyawan,
    COALESCE(hadir.jumlah_hadir, 0) AS jumlah_hadir,
    COALESCE(izin.jumlah_izin, 0) AS jumlah_izin,
    COALESCE(alpha.jumlah_alpha, 0) AS jumlah_alpha
FROM 
    karyawan
LEFT JOIN (
    SELECT 
        karyawan_absensi.id_karyawan, 
        COUNT(DISTINCT karyawan_absensi.id_absensi) AS jumlah_hadir
    FROM 
        karyawan_absensi
    LEFT JOIN 
        absensi ON karyawan_absensi.id_absensi = absensi.id 
    WHERE 
        MONTH(absensi.tanggal) = ? AND YEAR(absensi.tanggal) = ?
    GROUP BY 
        karyawan_absensi.id_karyawan
) AS hadir ON karyawan.id = hadir.id_karyawan
LEFT JOIN (
    SELECT 
        karyawan_izin.id_karyawan, 
        COUNT(*) AS jumlah_izin
    FROM 
        karyawan_izin
    LEFT JOIN 
        absensi ON karyawan_izin.id_absensi = absensi.id
    WHERE 
        karyawan_izin.izin = 1 
        AND MONTH(absensi.tanggal) = ? 
        AND YEAR(absensi.tanggal) = ?
    GROUP BY 
        karyawan_izin.id_karyawan
) AS izin ON karyawan.id = izin.id_karyawan
LEFT JOIN (
    SELECT 
        karyawan_izin.id_karyawan, 
        COUNT(*) AS jumlah_alpha
    FROM 
        karyawan_izin
    LEFT JOIN 
        absensi ON karyawan_izin.id_absensi = absensi.id
    WHERE 
        karyawan_izin.izin = 0 
        AND MONTH(absensi.tanggal) = ?
        AND YEAR(absensi.tanggal) = ?
    GROUP BY 
        karyawan_izin.id_karyawan
) AS alpha ON karyawan.id = alpha.id_karyawan
ORDER BY 
    karyawan.nama;",['01', date('Y'),'01', date('Y'),'01', date('Y')]);

    return view('absensi.laporans', compact('laporan'));
}

public function laporansFilter(Request $request)
{
    $bulan = $request->input('bulan');
    $tahun = $request->input('tahun');

    $laporan = DB::select("SELECT 
    karyawan.nama AS nama_karyawan,
    COALESCE(hadir.jumlah_hadir, 0) AS jumlah_hadir,
    COALESCE(izin.jumlah_izin, 0) AS jumlah_izin,
    COALESCE(alpha.jumlah_alpha, 0) AS jumlah_alpha
FROM 
    karyawan
LEFT JOIN (
    SELECT 
        karyawan_absensi.id_karyawan, 
        COUNT(DISTINCT karyawan_absensi.id_absensi) AS jumlah_hadir
    FROM 
        karyawan_absensi
    LEFT JOIN 
        absensi ON karyawan_absensi.id_absensi = absensi.id 
    WHERE 
        MONTH(absensi.tanggal) = ? AND YEAR(absensi.tanggal) = ?
    GROUP BY 
        karyawan_absensi.id_karyawan
) AS hadir ON karyawan.id = hadir.id_karyawan
LEFT JOIN (
    SELECT 
        karyawan_izin.id_karyawan, 
        COUNT(*) AS jumlah_izin
    FROM 
        karyawan_izin
    LEFT JOIN 
        absensi ON karyawan_izin.id_absensi = absensi.id
    WHERE 
        karyawan_izin.izin = 1 
        AND MONTH(absensi.tanggal) = ? 
        AND YEAR(absensi.tanggal) = ?
    GROUP BY 
        karyawan_izin.id_karyawan
) AS izin ON karyawan.id = izin.id_karyawan
LEFT JOIN (
    SELECT 
        karyawan_izin.id_karyawan, 
        COUNT(*) AS jumlah_alpha
    FROM 
        karyawan_izin
    LEFT JOIN 
        absensi ON karyawan_izin.id_absensi = absensi.id
    WHERE 
        karyawan_izin.izin = 0 
        AND MONTH(absensi.tanggal) = ?
        AND YEAR(absensi.tanggal) = ?
    GROUP BY 
        karyawan_izin.id_karyawan
) AS alpha ON karyawan.id = alpha.id_karyawan
ORDER BY 
    karyawan.nama;", [$bulan, $tahun, $bulan, $tahun,$bulan, $tahun]);

    return response()->json($laporan);
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
        $q = $params['q'];
        $exist_on_page = collect($params['data'] ?? [])->pluck('nama');
        $id_absensi = Cache::get('id_absensi');
        $nama_masuk = collect(KaryawanAbsensi::with('karyawan')->where('id_absensi', $id_absensi)->get('id_karyawan', 'nama')
                    ->map(function($item){
                        return $item ? $item->karyawan->nama : null;
                    }));
        $nama_izin = collect(KaryawanIzin::with('karyawan')->where('id_absensi', $id_absensi)->get('id_karyawan', 'nama')
                    ->map(function($item){
                        return $item ? $item->karyawan->nama : null;
                    }));
        $existedName = $nama_masuk->merge($nama_izin)->merge($exist_on_page)->filter()->unique();
        $data = Karyawan::where('nama', 'like', "%{$q}%")
            ->whereNotIn('nama', $existedName)
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