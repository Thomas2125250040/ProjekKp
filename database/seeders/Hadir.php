<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Hadir extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('karyawan_absensi')->insert([
            [
                'id_karyawan' => "001",
                'id_absensi' => "1",
                'waktu_masuk' => "10:00:00",
                'waktu_keluar' => "17:00:00"
            ],
            [
                'id_karyawan' => "002",
                'id_absensi' => "1",
                'waktu_masuk' => "10:00:00",
                'waktu_keluar' => "17:00:00"
            ],
            [
                'id_karyawan' => "003",
                'id_absensi' => "1",
                'waktu_masuk' => "10:00:00",
                'waktu_keluar' => "17:00:00"
            ],
            [
                'id_karyawan' => "004",
                'id_absensi' => "1",
                'waktu_masuk' => "10:00:00",
                'waktu_keluar' => "17:00:00"
            ],
            [
                'id_karyawan' => "005",
                'id_absensi' => "1",
                'waktu_masuk' => "10:00:00",
                'waktu_keluar' => "17:00:00"
            ],
            [
                'id_karyawan' => "003",
                'id_absensi' => "2",
                'waktu_masuk' => "10:00:00",
                'waktu_keluar' => "17:00:00"
            ],
            [
                'id_karyawan' => "005",
                'id_absensi' => "2",
                'waktu_masuk' => "10:00:00",
                'waktu_keluar' => "17:00:00"
            ],
            [
                'id_karyawan' => "002",
                'id_absensi' => "3",
                'waktu_masuk' => "10:00:00",
                'waktu_keluar' => "17:00:00"
            ],
            [
                'id_karyawan' => "004",
                'id_absensi' => "3",
                'waktu_masuk' => "10:00:00",
                'waktu_keluar' => "17:00:00"
            ],
            [
                'id_karyawan' => "003",
                'id_absensi' => "4",
                'waktu_masuk' => "10:00:00",
                'waktu_keluar' => "17:00:00"
            ],
            [
                'id_karyawan' => "004",
                'id_absensi' => "4",
                'waktu_masuk' => "10:00:00",
                'waktu_keluar' => "17:00:00"
            ],
            [
                'id_karyawan' => "005",
                'id_absensi' => "4",
                'waktu_masuk' => "10:00:00",
                'waktu_keluar' => "17:00:00"
            ],
            [
                'id_karyawan' => "001",
                'id_absensi' => "5",
                'waktu_masuk' => "10:00:00",
                'waktu_keluar' => "17:00:00"
            ],
            [
                'id_karyawan' => "002",
                'id_absensi' => "5",
                'waktu_masuk' => "10:00:00",
                'waktu_keluar' => "17:00:00"
            ],
            [
                'id_karyawan' => "003",
                'id_absensi' => "5",
                'waktu_masuk' => "10:00:00",
                'waktu_keluar' => "17:00:00"
            ],
            [
                'id_karyawan' => "004",
                'id_absensi' => "5",
                'waktu_masuk' => "10:00:00",
                'waktu_keluar' => "17:00:00"
            ],
            [
                'id_karyawan' => "005",
                'id_absensi' => "5",
                'waktu_masuk' => "10:00:00",
                'waktu_keluar' => "17:00:00"
            ],
        ]);
    }
}
