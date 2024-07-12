<?php

// class LaporanAbsensiExport implements FromCollection
// {
//     /**
//     * @return \Illuminate\Support\Collection
//     */
//     public function collection()
//     {
//         return Karyawan::all();
//     }
// }

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;

class LaporanAbsensiExport implements FromView
{
    protected $bulan;
    protected $tahun;

    public function __construct($bulan, $tahun)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function view(): View
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
        ORDER BY 
            karyawan.id;", [$this->bulan, $this->tahun, $this->bulan, $this->tahun, $this->bulan, $this->tahun, $this->bulan, $this->tahun, $this->bulan, $this->tahun]);

        return view('absensi.export_laporan_absensi', compact('laporan'));
    }
}

