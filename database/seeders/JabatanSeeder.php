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
                'id_jabatan'=>Str::uuid(),
                'kode_jabatan'=>"A01",
                'nama_jabatan'=>"Director",
                'gaji_pokok'=> 10000000,
            ],
            [
                'id_jabatan'=>Str::uuid(),
                'kode_jabatan'=>"A02",
                'nama_jabatan'=>"General Manager",
                'gaji_pokok'=>9000000,
            ],
            [
                'id_jabatan'=>Str::uuid(),
                'kode_jabatan'=>"A03",
                'nama_jabatan'=>"Accounting and Finance",
                'gaji_pokok'=> 6500000,
            ],
            [
                'id_jabatan'=>Str::uuid(),
                'kode_jabatan'=>"A04",
                'nama_jabatan'=>"Sales Manager",
                'gaji_pokok'=>7000000,
            ],
            [
                'id_jabatan'=>Str::uuid(),
                'kode_jabatan'=>"A05",
                'nama_jabatan'=>"Warehouse Manager",
                'gaji_pokok'=> 6000000,
            ],
            [
                'id_jabatan'=>Str::uuid(),
                'kode_jabatan'=>"A06",
                'nama_jabatan'=>"Sales Supervisor",
                'gaji_pokok'=> 5000000,
            ],
            [
                'id_jabatan'=>Str::uuid(),
                'kode_jabatan'=>"A07",
                'nama_jabatan'=>"Staff Administration",
                'gaji_pokok'=>4000000,
            ],
            [
                'id_jabatan'=>Str::uuid(),
                'kode_jabatan'=>"A08",
                'nama_jabatan'=>"Salesman",
                'gaji_pokok'=> 3000000,
            ],
            [
                'id_jabatan'=>Str::uuid(),
                'kode_jabatan'=>"A09",
                'nama_jabatan'=>"Driver",
                'gaji_pokok'=>1500000,
            ],
            [
                'id_jabatan'=>Str::uuid(),
                'kode_jabatan'=>"A10",
                'nama_jabatan'=>"Helper",
                'gaji_pokok'=> 1000000,
            ],
            
        ]);
    }
}
