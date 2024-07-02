<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jabatan')->insert([
            [
                'id'=>"A01",
                'nama'=>"Director",
                'gaji_pokok'=> 10000000,
                'uang_makan'=> 1000000,
                'uang_lembur'=>1000000,
            ],
            [
                'id'=>"A02",
                'nama'=>"General Manager",
                'gaji_pokok'=> 9000000,
                'uang_makan'=> 900000,
                'uang_lembur'=>900000,
            ],
            [
                'id'=>"A03",
                'nama'=>"Staff Administration",
                'gaji_pokok'=> 8000000,
                'uang_makan'=> 800000,
                'uang_lembur'=>800000,
            ],
            [
                'id'=>"A04",
                'nama'=>"Accounting and Finance",
                'gaji_pokok'=> 7000000,
                'uang_makan'=> 700000,
                'uang_lembur'=>700000,
            ],
            [
                'id'=>"A05",
                'nama'=>"Sales Manager",
                'gaji_pokok'=> 6000000,
                'uang_makan'=> 600000,
                'uang_lembur'=>600000,
            ],
            [
                'id'=>"A06",
                'nama'=>"Warehouse Manager",
                'gaji_pokok'=> 5000000,
                'uang_makan'=> 500000,
                'uang_lembur'=>500000,
            ],
            [
                'id'=>"A07",
                'nama'=>"Sales Supervisor",
                'gaji_pokok'=> 4000000,
                'uang_makan'=> 400000,
                'uang_lembur'=>400000,
            ],
            [
                'id'=>"A08",
                'nama'=>"Salesman",
                'gaji_pokok'=> 3000000,
                'uang_makan'=> 300000,
                'uang_lembur'=>300000,
            ],
            [
                'id'=>"A09",
                'nama'=>"Driver",
                'gaji_pokok'=> 2000000,
                'uang_makan'=> 200000,
                'uang_lembur'=>200000,
            ],
            [
                'id'=>"A10",
                'nama'=>"Helper",
                'gaji_pokok'=> 1000000,
                'uang_makan'=> 100000,
                'uang_lembur'=>100000,
            ],
            
        ]);
    }
}
