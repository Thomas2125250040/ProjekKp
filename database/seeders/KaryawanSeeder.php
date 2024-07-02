<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('karyawan')->insert([
            [
                'id'=> "001",
                'id_jabatan' => "A01",
                'nama'=>"Nicholas",
                'email'=>"nicholas@gmail.com",
                'jenis_kelamin'=>"Laki-laki",
                'tempat_lahir'=> "Lubuklinggau",
                'tanggal_lahir'=> "2003-11-09",
                'alamat'=>"Jalan Letda A.Rozak ",
                'foto'=>"",
                'agama'=> "Buddha",
                'no_telp'=> "081271590161",
            ],
            [
                'id'=> "002",
                'id_jabatan' => "A02",
                'nama'=>"Thomas Setiawan",
                'email'=>"thomas@gmail.com",
                'jenis_kelamin'=>"Laki-laki",
                'tempat_lahir'=> "Palembang",
                'tanggal_lahir'=> "2003-10-08",
                'alamat'=>"KM.9",
                'foto'=>"",
                'agama'=> "Kristen",
                'no_telp'=> "082134682309",
            ],
            [
                'id'=> "003",
                'id_jabatan' => "A03",
                'nama'=>"Margaretha",
                'email'=>"margaretha@gmail.com",
                'jenis_kelamin'=>"Perempuan",
                'tempat_lahir'=> "Palembang",
                'tanggal_lahir'=> "1990-12-14",
                'alamat'=>"Alang Alang Lebar",
                'foto'=>"",
                'agama'=> "Katolik",
                'no_telp'=> "081234567890",
            ],
            [
                'id'=> "004",
                'id_jabatan' => "A04",
                'nama'=>"Karyawan-1",
                'email'=>"karyawan1@gmail.com",
                'jenis_kelamin'=>"Perempuan",
                'tempat_lahir'=> "Palembang",
                'tanggal_lahir'=> "2000-10-10",
                'alamat'=>"Jl. Buah",
                'foto'=>"",
                'agama'=> "Islam",
                'no_telp'=> "089987612342",
            ],
            [
                'id'=> "006",
                'id_jabatan' => "A05",
                'nama'=>"Karyawan-2",
                'email'=>"karyawan2@gmail.com",
                'jenis_kelamin'=>"Laki-laki",
                'tempat_lahir'=> "Padang",
                'tanggal_lahir'=> "1999-03-09",
                'alamat'=>"Jl. Sayur",
                'foto'=>"",
                'agama'=> "Islam",
                'no_telp'=> "085366768891",
            ],
        ]);
    }
}
