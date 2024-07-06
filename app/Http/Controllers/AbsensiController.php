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

    public function keluar()
    {
        return view('absensi.absenKeluar', compact('data'));
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
        $nama_masuk = KaryawanAbsensi::with('karyawan')->where('id_absensi', $id_absensi)->get('id_karyawan')
                    ->map(function($item){
                        return $item ? $item->karyawan->nama : null;
                    });
        $data_izin = KaryawanIzin::with('karyawan')->where('id_absensi', $id_absensi)->get();
        $nama_izin = $data_izin->map(function($item){
                        return $item ? $item->karyawan->nama : null;
                    });
        $existedName = $nama_masuk->merge($nama_izin)->filter()->unique();
        $data_alpha = Karyawan::whereNotIn('nama', $existedName)->get(['id', 'nama']);
        return view('absensi.absenIzin', ['alpha' => $data_alpha, 'izin' => $data_izin]);
    }

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
        $q = $params['q'];
        $exist_on_page = collect($params['data'] ?? [])->pluck('nama');
        $id_absensi = Cache::get('id_absensi');
        $nama_masuk = KaryawanAbsensi::with('karyawan')->where('id_absensi', $id_absensi)->get('id_karyawan', 'nama')
                    ->map(function($item){
                        return $item ? $item->karyawan->nama : null;
                    })->pluck('nama');
        $nama_izin = KaryawanIzin::with('karyawan')->where('id_absensi', $id_absensi)->get('id_karyawan', 'nama')
                    ->map(function($item){
                        return $item ? $item->karyawan->nama : null;
                    })->pluck('nama');
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