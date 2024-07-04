<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GajiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('gaji')->insert([
            [
                'tahun' => "2024",
                'bulan' => "11",
                'id_jabatan' => "A01",
                'gaji_pokok' => 10000000,
                'uang_makan' => 1000000,
                'uang_lembur' => 1000000,
            ],
            [
                'tahun' => "2024",
                'bulan' => "11",
                'id_jabatan' => "A02",
                'gaji_pokok' => 9000000,
                'uang_makan' => 900000,
                'uang_lembur' => 900000,
            ],
            [
                'tahun' => "2024",
                'bulan' => "11",
                'id_jabatan' => "A03",
                'gaji_pokok' => 8000000,
                'uang_makan' => 800000,
                'uang_lembur' => 800000,
            ],
            [
                'tahun' => "2024",
                'bulan' => "11",
                'id_jabatan' => "A04",
                'gaji_pokok' => 7000000,
                'uang_makan' => 700000,
                'uang_lembur' => 700000,
            ],
            [
                'tahun' => "2024",
                'bulan' => "11",
                'id_jabatan' => "A05",
                'gaji_pokok' => 6000000,
                'uang_makan' => 600000,
                'uang_lembur' => 600000,
            ],
            [
                'tahun' => "2024",
                'bulan' => "11",
                'id_jabatan' => "A06",
                'gaji_pokok' => 5000000,
                'uang_makan' => 500000,
                'uang_lembur' => 500000,
            ],
            [
                'tahun' => "2024",
                'bulan' => "12",
                'id_jabatan' => "A01",
                'gaji_pokok' => 15000000,
                'uang_makan' => 1000000,
                'uang_lembur' => 1000000,
            ],
            [
                'tahun' => "2024",
                'bulan' => "12",
                'id_jabatan' => "A02",
                'gaji_pokok' => 9500000,
                'uang_makan' => 900000,
                'uang_lembur' => 900000,
            ],
            [
                'tahun' => "2024",
                'bulan' => "12",
                'id_jabatan' => "A03",
                'gaji_pokok' => 8500000,
                'uang_makan' => 800000,
                'uang_lembur' => 800000,
            ],
            [
                'tahun' => "2024",
                'bulan' => "12",
                'id_jabatan' => "A04",
                'gaji_pokok' => 7500000,
                'uang_makan' => 700000,
                'uang_lembur' => 700000,
            ],
            [
                'tahun' => "2024",
                'bulan' => "12",
                'id_jabatan' => "A05",
                'gaji_pokok' => 6500000,
                'uang_makan' => 600000,
                'uang_lembur' => 600000,
            ],
            [
                'tahun' => "2024",
                'bulan' => "12",
                'id_jabatan' => "A06",
                'gaji_pokok' => 5500000,
                'uang_makan' => 50000,
                'uang_lembur' => 500000,
            ],
            [
                'tahun' => "2025",
                'bulan' => "01",
                'id_jabatan' => "A01",
                'gaji_pokok' => 15000000,
                'uang_makan' => 200000,
                'uang_lembur' => 2000000,
            ],
            [
                'tahun' => "2025",
                'bulan' => "01",
                'id_jabatan' => "A02",
                'gaji_pokok' => 9500000,
                'uang_makan' => 1000000,
                'uang_lembur' => 1000000,
            ],
            [
                'tahun' => "2025",
                'bulan' => "01",
                'id_jabatan' => "A03",
                'gaji_pokok' => 8500000,
                'uang_makan' => 900000,
                'uang_lembur' => 900000,
            ],
            [
                'tahun' => "2025",
                'bulan' => "01",
                'id_jabatan' => "A04",
                'gaji_pokok' => 7500000,
                'uang_makan' => 800000,
                'uang_lembur' => 800000,
            ],
            [
                'tahun' => "2025",
                'bulan' => "01",
                'id_jabatan' => "A05",
                'gaji_pokok' => 6500000,
                'uang_makan' => 700000,
                'uang_lembur' => 700000,
            ],
            [
                'tahun' => "2025",
                'bulan' => "01",
                'id_jabatan' => "A06",
                'gaji_pokok' => 5500000,
                'uang_makan' => 60000,
                'uang_lembur' => 600000,
            ],
           
        ]);
    }
}
