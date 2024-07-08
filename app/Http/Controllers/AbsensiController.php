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
use Dompdf\Options;


class AbsensiController extends Controller
{
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
        return view('absensi.absenMasuk');
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
    karyawan.nama;", ['01', date('Y'), '01', date('Y'), '01', date('Y')]);

        return view('absensi.laporan', compact('laporan'));
    }

    public function laporanFilter(Request $request)
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
    karyawan.nama;", [$bulan, $tahun, $bulan, $tahun, $bulan, $tahun]);

        return response()->json($laporan);
    }


    public function gaji()
    {
        $params = request()->query();
        $bulan = $params['bulan'] ?? null;
        $tahun = $params['tahun'] ?? null;
        if (is_null($bulan) || is_null($tahun)) {
            return view('absensi.gaji');
        }
        $awal_bulan = Carbon::create($tahun, $bulan)->startOfMonth();
        $akhir_bulan = Carbon::create($tahun, $bulan)->endOfMonth();
        $kumpulan_id_absensi = Absensi::whereBetween('tanggal', [$awal_bulan, $akhir_bulan])->whereNull('id_libur')->get();
        if ($kumpulan_id_absensi->isEmpty()) {
            return response()->noContent();
        }
        $array_hariKerja = [];
        $kumpulan_karyawan = Karyawan::all();
        foreach ($kumpulan_karyawan as $karyawan) {
            $hariKerja = 0;
            $lembur = 0;
            $terlambat = 0;
            foreach ($kumpulan_id_absensi as $absensi) {
                $karyawanAbsen = KaryawanAbsensi::find([
                    $karyawan->id,
                    $absensi->id
                ]);
                if ($karyawanAbsen) {
                    $hariKerja++;
                    $waktu_keluar = Carbon::parse($karyawanAbsen->waktu_keluar);
                    $time1700 = Carbon::createFromTime(17, 0, 0);
                    if ($waktu_keluar->greaterThan($time1700)) {
                        $lembur += 1;
                    }
                    $waktuMasuk = Carbon::parse($karyawanAbsen->waktu_masuk);
                    $time0800 = Carbon::createFromTime(8, 0, 0);
                    if ($waktuMasuk->greaterThan($time0800)) {
                        $terlambat += 1;
                    }
                }
            }
            $dendaTelat = Cache::get('denda_telat', 50000);
            $array_hariKerja[] = [
                'id' => $karyawan->id,
                'nama' => $karyawan->nama,
                'jabatan' => $karyawan->jabatan->nama,
                'gaji_pokok' => $karyawan->jabatan->gaji_pokok,
                'uang_makan' => $karyawan->jabatan->uang_makan,
                'uang_lembur' => $karyawan->jabatan->uang_lembur,
                'denda_telat' => $dendaTelat,
                'total_masuk' => $hariKerja,
                'total_telat' => $terlambat,
                'total_lembur' => $lembur
            ];
        }
        return response()->json($array_hariKerja);

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
            ->map(function ($item) {
                return $item ? $item->karyawan->nama : null;
            }));
        $nama_izin = collect(KaryawanIzin::with('karyawan')->where('id_absensi', $id_absensi)->get('id_karyawan', 'nama')
            ->map(function ($item) {
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

        // Dapatkan data laporan berdasarkan bulan dan tahun
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
        karyawan.nama;", [$bulan, $tahun, $bulan, $tahun, $bulan, $tahun]);

        $data = [
            'laporan' => $laporan,
            'bulan' => $bulan,
            'tahun' => $tahun,
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

    public function cetak(Request $request)
    {
        $nama = $request->input('nama');
        $start = Carbon::parse($request->input('start'))->startOfDay();
        $end = Carbon::parse($request->input('end'))->endOfDay();

        $karyawan = Karyawan::where('nama', $nama)->first();
        if (!$karyawan) {
            return redirect()->back()->withErrors(['error' => 'Karyawan not found']);
        }
        $id_karyawan = $karyawan->id;

        $kumpulan_id_absensi = Absensi::whereBetween('tanggal', [$start, $end])
            ->orderBy('tanggal', 'asc') // Urutkan berdasarkan tanggal
            ->get();

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

        // Gabungkan semua data log menjadi satu array dan urutkan berdasarkan tanggal
        $combinedLogs = array_merge($logAlpha, $logIzin, $logMasuk, $logLibur);
        usort($combinedLogs, function ($a, $b) {
            return strtotime($a['tanggal']) - strtotime($b['tanggal']);
        });

        // Render view PDF dengan data yang sudah diurutkan
        $html = view('absensi.logharian_pdf', compact('combinedLogs', 'nama'))->render();

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        return $dompdf->stream('laporan_log_harian.pdf');
    }

}