<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Dompdf\Dompdf;
use App\Models\Absensi;
use App\Models\HariLibur;
use App\Models\KaryawanAbsensi;
use App\Models\KaryawanIzin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function revisi()
    {
        $test = Karyawan::with('karyawan_absensi')->get();
        $test2 = Karyawan::with('karyawan_izin')->get();
        dd($test, $test2);
        // return view('director.revisi');
    }

    public function update_revisi(Request $request)
    {
        $keterangan = $request->rowdata["keterangan"];
        $masuk = KaryawanAbsensi::find([
            $request->rowdata[0],
            $request->id_absensi
        ]);
        $izin = KaryawanIzin::find([
            $request->rowdata[0],
            $request->id_absensi
        ]);
        if (is_null($keterangan)) {
            if ($masuk) {
                $masuk->update([
                    "waktu_masuk" => $request->rowdata["waktu-masuk"],
                    "waktu_keluar" => $request->rowdata["waktu-keluar"]
                ]);
                return response()->json(["message" => "Data berhasil diupdate"]);
            } else if ($izin) {
                $izin->delete();
                $new_data = new KaryawanAbsensi([
                    "id_absensi" => $request->id_absensi,
                    "id_karyawan" => $request->rowdata[0],
                    "waktu_masuk" => $request->rowdata["waktu-masuk"],
                    "waktu_keluar" => $request->rowdata["waktu-keluar"]
                ]);
                $new_data->save();
                return response()->json(["message" => "Data berhasil diupdate"]);
            }
        } else {
            if ($masuk) {
                $masuk->delete();
                if (strtolower($keterangan) === "alpha") {
                    $new_data = new KaryawanIzin([
                        "id_absensi" => $request->id_absensi,
                        "id_karyawan" => $request->rowdata[0],
                        "izin" => 0,
                        "keterangan" => null
                    ]);
                    $new_data->save();
                    return response()->json(["message" => "Karyawan ditetapkan sebagai alpha"]);
                }
                $new_data = new KaryawanIzin([
                    "id_absensi" => $request->id_absensi,
                    "id_karyawan" => $request->rowdata[0],
                    "keterangan" => $keterangan
                ]);
                $new_data->save();
                return response()->json(["message" => "Data berhasil diupdate"]);
            } else if ($izin) {
                if (strtolower($keterangan) === "alpha") {
                    $izin->update([
                        "id_absensi" => $request->id_absensi,
                        "id_karyawan" => $request->rowdata[0],
                        "izin" => 0,
                        "keterangan" => null
                    ]);
                    return response()->json(["message" => "Karyawan ditetapkan sebagai alpha"]);
                }
                $izin->update([
                    "izin" => 1,
                    "keterangan" => $keterangan
                ]);
                return response()->json(["message" => "Data berhasil diupdate"]);
            }
        }

    }

    public function data_revisi()
    {
        $tanggal = request()->query()["tanggal"];
        if (is_null($tanggal)) {
            return response()->noContent();
        }
        $absensi = Absensi::where('tanggal', $tanggal)->first();
        if (is_null($absensi)) {
            return response()->json(["message" => "Data tidak ada."], 204);
        }
        if (!is_null($libur = $absensi->id_libur)) {
            $keterangan_libur = HariLibur::find($libur)->keterangan;
            return response()->json(["message" => $keterangan_libur], 202);
        }
        $masuk = KaryawanAbsensi::with('karyawan')->where('id_absensi', $absensi->id)->get()->map(function ($item) {
            return [
                "id" => $item->karyawan->id,
                "nama" => $item->karyawan->nama,
                "waktu_masuk" => $item->waktu_masuk,
                "waktu_keluar" => $item->waktu_keluar
            ];
        });
        $data_izin = KaryawanIzin::with('karyawan')->where('id_absensi', $absensi->id)->get();
        $izin = $data_izin->map(function ($item) {
            if ($item->izin === 1) {
                return [
                    "id" => $item->karyawan->id,
                    "nama" => $item->karyawan->nama,
                    "keterangan" => $item->keterangan
                ];
            }
        })->filter()->values();
        $alpha = $data_izin->map(function ($item) {
            if ($item->izin === 0) {
                return [
                    "id" => $item->karyawan->id,
                    "nama" => $item->karyawan->nama,
                ];
            }
        })->filter()->values();
        if ($masuk->isEmpty() && $izin->isEmpty() && $alpha->isEmpty()) {
            return response()->json(["message" => "Data tidak ada."], 204);
        }
        return response()->json([
            "id_absensi" => $absensi->id,
            "masuk" => $masuk,
            "izin" => $izin,
            "alpha" => $alpha
        ]);
    }

    public function edit_delete($id)
    {
        $id_absensi = Cache::get('id_absensi');
        $data_absensi = KaryawanAbsensi::find([
            $id,
            $id_absensi
        ]);
        if ($data_absensi) {
            $data_absensi->delete();
            return response()->json(["message" => "Data masuk berhasil dihapus"]);
        }
        $data_izin = KaryawanIzin::find([
            $id,
            $id_absensi
        ]);
        if ($data_izin) {
            $data_izin->delete();
            return response()->json(["message" => "Data izin berhasil dihapus"]);
        }
        return response()->json(["message" => "Data tidak ditemukan"]);
    }

    public function edit_update(Request $request)
    {
        $id_absensi = Cache::get('id_absensi');
        $id_karyawan = $request[0];
        $nama = $request[1];
        $masuk = $request["waktu-masuk"];
        $keluar = $request["waktu-keluar"];
        $keterangan = $request["keterangan"];
        if (is_null($keterangan)) {
            $karyawan_izin = KaryawanIzin::find([
                $id_karyawan,
                $id_absensi
            ]);
            if ($karyawan_izin) {
                $karyawan_izin->delete();
            }
            $karyawan = KaryawanAbsensi::find([
                $id_karyawan,
                $id_absensi
            ]);
            $karyawan->waktu_masuk = $masuk;
            $karyawan->waktu_keluar = $keluar;
            $karyawan->save();
            return response()->json(['message' => 'Berhasil update data masuk karyawan']);
        }
        $izin = KaryawanIzin::find([
            $id_karyawan,
            $id_absensi
        ]);
        $izin->keterangan = $keterangan;
        $izin->save();
        return response()->json(['message' => 'Berhasil update izin karyawan']);
    }

    public function masuk()
    {
        $id_absensi = Cache::get('id_absensi');
        if ($keterangan = $this->cek_libur()) {
            return view('absensi.absenMasuk')->with('libur', $keterangan);
        } else if (is_null($id_absensi)) {
            if ($this->cek_buka_absensi()) {
                return view('absensi.absenMasuk')->with('error', "Tidak ada data absensi untuk hari ini, apakah Anda ingin membuat satu?");
            }
            ;
            return view('absensi.absenMasuk')->with('tutup', "Absensi sudah ditutup.");
        }
        $masuk = KaryawanAbsensi::where('id_absensi', $id_absensi);
        $nama_masuk = collect(KaryawanAbsensi::with('karyawan')->where('id_absensi', $id_absensi)->get('id_karyawan')
        ->map(function ($item) {
            return $item ? $item->karyawan->nama : null;
        }));
        $data_izin = KaryawanIzin::with('karyawan')->where('id_absensi', $id_absensi)->get();
        $nama_izin = collect($data_izin->map(function ($item) {
            return $item ? $item->karyawan->nama : null;
        }));
        $existedName = $nama_masuk->merge($nama_izin)->filter()->unique();
        $alpha = Karyawan::whereNotIn('nama', $existedName)->get(['id', 'nama']);
        return view('absensi.absenMasuk', compact(['masuk', 'alpha']));
    }

    private function cek_buka_absensi()
    {
        date_default_timezone_set('Asia/Jakarta');
        $currentDate = now()->toDateString();
        $absen = Absensi::where('tanggal', $currentDate)->get();
        if ($absen->isEmpty()) {
            return true;
        }
        return false;
    }

    private function cek_libur()
    {
        $id_absensi = Cache::get('id_absensi');
        if (is_null($id_absensi)) {
            date_default_timezone_set('Asia/Jakarta');
            $currentDate = now()->toDateString();
            $libur = HariLibur::whereDate('tanggal_mulai', '<=', $currentDate)
                ->whereDate('tanggal_selesai', '>=', $currentDate)
                ->get(['id', 'keterangan']);
            if ($libur->isEmpty()) {
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

    public function buat()
    {
        date_default_timezone_set('Asia/Jakarta');
        $currentDate = now()->toDateString(); // Get the current date in 'Y-m-d' format
        $absen = new Absensi([
            'tanggal' => $currentDate
        ]);
        $absen->save();
        Cache::put('id_absensi', $absen->id);
        return redirect()->route('absensi.masuk');
    }


    public function editAbsensi()
    {
        $id_absensi = Cache::get('id_absensi');
        if ($keterangan = $this->cek_libur()) {
            return view('absensi.edit')->with('libur', $keterangan);
        } else if (is_null($id_absensi)) {
            if ($this->cek_buka_absensi()) {
                return view('absensi.edit')->with('error', "Tidak ada data absensi untuk hari ini, apakah Anda ingin membuat satu?");
            }
            return view('absensi.edit')->with('tutup', "Absensi sudah ditutup.");
        }
        $masuk = KaryawanAbsensi::with('karyawan')->where('id_absensi', $id_absensi)->get();
        $izin = KaryawanIzin::with('karyawan')->where('id_absensi', $id_absensi)->get();
        return view('absensi.edit', compact(['masuk', 'izin']));
    }

    public function simpan_masuk(Request $request)
    {
        $id_absensi = Cache::get('id_absensi');
        $new_data = $request->data;
        if (empty($new_data)) {
            return response()->json("", 400);
        }
        foreach ($new_data as $item) {
            $karyawan_absensi = new KaryawanAbsensi([
                'id_absensi' => $id_absensi,
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
            'id_absensi' => $id_absensi,
            'id_karyawan' => $id_karyawan,
            'izin' => 1,
            'keterangan' => $keterangan
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

    public function tutup_absensi()
    {
        $id_absensi = Cache::get('id_absensi');
        $nama_masuk = collect(KaryawanAbsensi::with('karyawan')->where('id_absensi', $id_absensi)->get('id_karyawan')
            ->map(function ($item) {
                return $item ? $item->karyawan->nama : null;
            }));
        $data_izin = KaryawanIzin::with('karyawan')->where('id_absensi', $id_absensi)->get();
        $nama_izin = collect($data_izin->map(function ($item) {
            return $item ? $item->karyawan->nama : null;
        }));
        $existedName = $nama_masuk->merge($nama_izin)->filter()->unique();
        $data_alpha = Karyawan::whereNotIn('nama', $existedName)->get(['id', 'nama']);
        foreach ($data_alpha as $item) {
            $karyawanAlpha = new KaryawanIzin([
                'id_absensi' => $id_absensi,
                'id_karyawan' => $item->id,
                'izin' => 0
            ]);
            $karyawanAlpha->save();
        }
        $keluar = KaryawanAbsensi::where('id_absensi', $id_absensi)->whereNull('waktu_keluar')->get();
        foreach ($keluar as $item) {
            $item->waktu_keluar = '17:00:00';
            $item->save();
        }
        Cache::forget('id_absensi');
        return redirect()->route('absensi.keluar');
    }

    public function keluar()
    {
        $id_absensi = Cache::get('id_absensi');
        if ($keterangan = $this->cek_libur()) {
            return view('absensi.absenKeluar')->with('libur', $keterangan);
        } else if (is_null($id_absensi)) {
            if ($this->cek_buka_absensi()) {
                return view('absensi.absenKeluar')->with('error', "Tidak ada data absensi untuk hari ini, apakah Anda ingin membuat satu?");
            }
            ;
            return view('absensi.absenKeluar')->with('tutup', "Absensi sudah ditutup.");
        }
        $data_masuk = KaryawanAbsensi::with('karyawan')->where('id_absensi', $id_absensi)->get();
        return view('absensi.absenKeluar', ['data_masuk' => $data_masuk]);
    }

    public function izin()
    {
        $id_absensi = Cache::get('id_absensi');
        if ($keterangan = $this->cek_libur()) {
            return view('absensi.absenIzin')->with('libur', $keterangan);
        } else if (is_null($id_absensi)) {
            if ($this->cek_buka_absensi()) {
                return view('absensi.absenIzin')->with('error', "Tidak ada data absensi untuk hari ini, apakah Anda ingin membuat satu?");
            }
            ;
            return view('absensi.absenIzin')->with('tutup', "Absensi sudah ditutup.");
        }
        $nama_masuk = collect(KaryawanAbsensi::with('karyawan')->where('id_absensi', $id_absensi)->get('id_karyawan')
            ->map(function ($item) {
                return $item ? $item->karyawan->nama : null;
            }));
        $data_izin = KaryawanIzin::with('karyawan')->where('id_absensi', $id_absensi)->get();
        $nama_izin = collect($data_izin->map(function ($item) {
            return $item ? $item->karyawan->nama : null;
        }));
        $existedName = $nama_masuk->merge($nama_izin)->filter()->unique();
        $data_alpha = Karyawan::whereNotIn('nama', $existedName)->get(['id', 'nama']);
        return view('absensi.absenIzin', ['alpha' => $data_alpha, 'izin' => $data_izin]);
    }

    public function laporan()
    {
        $laporan = DB::select("SELECT 
            karyawan.id, karyawan.nama AS nama_karyawan,
            COALESCE(hadir.jumlah_hadir, 0) AS jumlah_hadir,
            COALESCE(izin.jumlah_izin, 0) AS jumlah_izin,
            COALESCE(alpha.jumlah_alpha, 0) AS jumlah_alpha,
            COALESCE(terlambat.total_telat, 0) AS total_telat,
            COALESCE(lembur.total_lembur, 0) AS total_lembur
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
        LEFT JOIN (
            SELECT 
                karyawan_absensi.id_karyawan, 
                SUM(GREATEST(HOUR(waktu_keluar) - 17, 0)) AS total_lembur
            FROM 
                karyawan_absensi
            LEFT JOIN 
                absensi ON karyawan_absensi.id_absensi = absensi.id 
            WHERE 
                HOUR(waktu_keluar) > 17
                AND MONTH(absensi.tanggal) = ? 
                AND YEAR(absensi.tanggal) = ?
            GROUP BY 
                karyawan_absensi.id_karyawan
        ) AS lembur ON karyawan.id = lembur.id_karyawan
        LEFT JOIN (
            SELECT 
                karyawan_absensi.id_karyawan, 
                COUNT(*) AS total_telat
            FROM 
                karyawan_absensi
            LEFT JOIN 
                absensi ON karyawan_absensi.id_absensi = absensi.id 
            WHERE 
                TIME(waktu_masuk) > '08:00:00'
                AND MONTH(absensi.tanggal) = ? 
                AND YEAR(absensi.tanggal) = ?
            GROUP BY 
                karyawan_absensi.id_karyawan
        ) AS terlambat ON karyawan.id = terlambat.id_karyawan
        WHERE karyawan.deleted_at IS NULL
        ORDER BY 
            karyawan.nama;", ['01', date('Y'), '01', date('Y'), '01', date('Y'), '01', date('Y'), '01', date('Y')]);

        return view('absensi.laporan', compact('laporan'));
    }


    public function laporanFilter(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $laporan = DB::select("SELECT 
        karyawan.id, karyawan.nama AS nama_karyawan,
        COALESCE(hadir.jumlah_hadir, 0) AS jumlah_hadir,
        COALESCE(izin.jumlah_izin, 0) AS jumlah_izin,
        COALESCE(alpha.jumlah_alpha, 0) AS jumlah_alpha,
        COALESCE(terlambat.total_telat, 0) AS total_telat,
        COALESCE(lembur.total_lembur, 0) AS total_lembur
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
    LEFT JOIN (
        SELECT 
            karyawan_absensi.id_karyawan, 
            SUM(GREATEST(HOUR(waktu_keluar) - 17, 0)) AS total_lembur
        FROM 
            karyawan_absensi
        LEFT JOIN 
            absensi ON karyawan_absensi.id_absensi = absensi.id 
        WHERE 
            HOUR(waktu_keluar) > 17
            AND MONTH(absensi.tanggal) = ? 
            AND YEAR(absensi.tanggal) = ?
        GROUP BY 
            karyawan_absensi.id_karyawan
    ) AS lembur ON karyawan.id = lembur.id_karyawan
    LEFT JOIN (
        SELECT 
            karyawan_absensi.id_karyawan, 
            COUNT(*) AS total_telat
        FROM 
            karyawan_absensi
        LEFT JOIN 
            absensi ON karyawan_absensi.id_absensi = absensi.id 
        WHERE 
            TIME(waktu_masuk) > '08:00:00'
            AND MONTH(absensi.tanggal) = ? 
            AND YEAR(absensi.tanggal) = ?
        GROUP BY 
            karyawan_absensi.id_karyawan
    ) AS terlambat ON karyawan.id = terlambat.id_karyawan
    WHERE karyawan.deleted_at IS NULL
    ORDER BY 
        karyawan.nama;", [$bulan, $tahun, $bulan, $tahun, $bulan, $tahun, $bulan, $tahun, $bulan, $tahun]);

        return response()->json($laporan);
    }

    public function logHarian_single(){
        $date = request()->query()["tanggal"];
        $absen = Absensi::where('tanggal', $date)->first();
        $isLibur = $absen->id_libur;
        if ($isLibur !== null) {
            $libur = HariLibur::find($isLibur);
            return response()->json(["message" => $libur->keterangan]);
        }
        $masuk = KaryawanAbsensi::with('karyawan')->where('id_absensi', $absen->id)->get();
        dd($masuk);
        $izin = KaryawanIzin::with('karyawan')->where('id_absensi', $absen->id)->where('izin', 1)->get()->map(function ($item) {
            return [
                "nama" => $item->karyawan->nama,
                "keterangan" => $item->keterangan
            ];
        });
        $alpha = KaryawanIzin::with('karyawan')->where('id_absensi', $absen->id)->where('izin', 0)->get()->map(function ($item) {
            return [
                "nama" => $item->karyawan->nama
            ];
        });
        return response()->json([
            "masuk" => $masuk,
            "izin" => $izin,
            "alpha" => $alpha
        ]);
    }

    public function logHarian()
    {
        $params = request()->query();
        $nama = $params['nama'] ?? null;
        $start_date = $params['start'] ?? null;
        $end_date = $params['end'] ?? null;
        $karyawan = Karyawan::with('jabatan')->get(['id', 'nama', 'id_jabatan']);

        // If any required parameter is missing, return the view without querying the database
        if (is_null($nama) || is_null($start_date) || is_null($end_date)) {
            return view('absensi.logHarian', compact('karyawan'));
        }

        // Retrieve the ID of the selected karyawan
        $karyawanData = Karyawan::where('nama', $nama)->first();
        if (!$karyawanData) {
            // Handle the case where the karyawan is not found
            return view('absensi.logHarian', compact('karyawan'))->withErrors(['error' => 'Karyawan not found']);
        }
        $id_karyawan = $karyawanData->id;

        // Fetch the absensi records within the specified date range
        $kumpulan_id_absensi = Absensi::whereBetween('tanggal', [$start_date, $end_date])->get();

        $logMasuk = [];
        $logAlpha = [];
        $logIzin = [];
        $logLibur = [];

        foreach ($kumpulan_id_absensi as $item) {
            if (is_null($item->id_libur)) {
                // Check for izin
                $absensiIzin = KaryawanIzin::where('id_karyawan', $id_karyawan)->where('id_absensi', $item->id)->first();
                if ($absensiIzin) {
                    $logIzin[] = [
                        'tanggal' => $item->tanggal,
                        'keterangan_izin' => $absensiIzin->keterangan,
                    ];
                    continue;
                }

                // Check for absensi
                $absensiMasuk = KaryawanAbsensi::where('id_karyawan', $id_karyawan)->where('id_absensi', $item->id)->first();
                if ($absensiMasuk) {
                    $logMasuk[] = [
                        'tanggal' => $item->tanggal,
                        'waktu_masuk' => $absensiMasuk->waktu_masuk,
                        'waktu_keluar' => $absensiMasuk->waktu_keluar,
                    ];
                    continue;
                }

                // If no izin or absensi, mark as alpha
                $logAlpha[] = [
                    'tanggal' => $item->tanggal,
                ];
            } else {
                // Log as libur
                $libur = HariLibur::find($item->id_libur);
                $logLibur[] = [
                    'tanggal' => $item->tanggal,
                    'keterangan_libur' => $libur->keterangan,
                ];
            }
        }
        return response()->json([
            'logMasuk' => $logMasuk,
            'logIzin' => $logIzin,
            'logAlpha' => $logAlpha,
            'logLibur' => $logLibur
        ]);
    }

    public function generatePDF(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        // Convert month number to month name
        $monthNames = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        ];
        $monthName = $monthNames[$bulan];

        // Get current timestamp
        $currentTimestamp = Carbon::now('Asia/Jakarta')->translatedFormat('d F Y, H:i:s \W\I\B');

        // Fetch report data based on month and year
        $laporan = DB::select("SELECT 
        karyawan.id, karyawan.nama AS nama_karyawan,
        COALESCE(hadir.jumlah_hadir, 0) AS jumlah_hadir,
        COALESCE(izin.jumlah_izin, 0) AS jumlah_izin,
        COALESCE(alpha.jumlah_alpha, 0) AS jumlah_alpha,
        COALESCE(terlambat.total_telat, 0) AS total_telat,
        COALESCE(lembur.total_lembur, 0) AS total_lembur
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
    LEFT JOIN (
        SELECT 
            karyawan_absensi.id_karyawan, 
            SUM(GREATEST(HOUR(waktu_keluar) - 17, 0)) AS total_lembur
        FROM 
            karyawan_absensi
        LEFT JOIN 
            absensi ON karyawan_absensi.id_absensi = absensi.id 
        WHERE 
            HOUR(waktu_keluar) > 17
            AND MONTH(absensi.tanggal) = ? 
            AND YEAR(absensi.tanggal) = ?
        GROUP BY 
            karyawan_absensi.id_karyawan
    ) AS lembur ON karyawan.id = lembur.id_karyawan
    LEFT JOIN (
        SELECT 
            karyawan_absensi.id_karyawan, 
            COUNT(*) AS total_telat
        FROM 
            karyawan_absensi
        LEFT JOIN 
            absensi ON karyawan_absensi.id_absensi = absensi.id 
        WHERE 
            TIME(waktu_masuk) > '08:00:00'
            AND MONTH(absensi.tanggal) = ? 
            AND YEAR(absensi.tanggal) = ?
        GROUP BY 
            karyawan_absensi.id_karyawan
    ) AS terlambat ON karyawan.id = terlambat.id_karyawan
    WHERE karyawan.deleted_at IS NULL
    ORDER BY 
        karyawan.id;", [$bulan, $tahun, $bulan, $tahun, $bulan, $tahun, $bulan, $tahun, $bulan, $tahun]);

        $data = [
            'laporan' => $laporan,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'monthName' => $monthName,
            'currentTimestamp' => $currentTimestamp,
            'header' => 'CV. ANUGRAH ABADI',
            'title' => 'Laporan Absensi Karyawan'
        ];

        // Load the view and pass data
        $view = view('absensi.halamanCetakLaporan', $data)->render();

        // Generate PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('laporan_absensi.pdf');
    }

}

