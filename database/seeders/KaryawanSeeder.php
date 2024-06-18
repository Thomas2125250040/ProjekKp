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
                'id_karyawan'=>Str::uuid(),
                'kode_karyawan'=>"12345",
                'nama_karyawan'=>"NicholasDirector",
                'kode_jabatan'=> "A01",
                'email'=>"nicholas@gmail.com",
                'password'=>Hash::make(12345678),
                'jenis_kelamin'=>"Laki-laki",
                'tempat_lahir'=> "Lubuklinggau",
                'tanggal_lahir'=> "2003-11-09",
                'alamat'=>"Jalan Letda A.Rozak Simpang 3 M.Isa",
                'agama'=> "Budha",
                'nomor_telepon'=> "081271590161",
            ],
            [
                'id_karyawan'=>Str::uuid(),
                'kode_karyawan'=>"54321",
                'nama_karyawan'=>"ThomasGM",
                'kode_jabatan'=> "A02",
                'email'=>"thomas@gmail.com",
                'password'=>Hash::make(12345678),
                'jenis_kelamin'=>"Laki-laki",
                'tempat_lahir'=> "Palembang",
                'tanggal_lahir'=> "2005-12-12",
                'alamat'=>"Jalan KM.9",
                'agama'=> "Katolik",
                'nomor_telepon'=> "081234567890",
            ],
            [
                'id_karyawan'=>Str::uuid(),
                'kode_karyawan'=>"13542",
                'nama_karyawan'=>"MargarethaAdmin",
                'kode_jabatan'=> "A07",
                'email'=>"margaretha@gmail.com",
                'password'=>Hash::make(12345678),
                'jenis_kelamin'=>"Perempuan",
                'tempat_lahir'=> "Palembang",
                'tanggal_lahir'=> "1999-06-09",
                'alamat'=>"Jalan Bypass Alang-Alang Lebar No.99",
                'agama'=> "Kristen",
                'nomor_telepon'=> "089876543210",
            ],
            [
                'id_karyawan'=>Str::uuid(),
                'kode_karyawan'=>"15243",
                'nama_karyawan'=>"Karyawan",
                'kode_jabatan'=> "A05",
                'email'=>"karyawan@gmail.com",
                'password'=>Hash::make(12345678),
                'jenis_kelamin'=>"Perempuan",
                'tempat_lahir'=> "Padang",
                'tanggal_lahir'=> "2000-01-25",
                'alamat'=>"Jalan Riau No 97 RT. 1 Lubuklinggau Barat II",
                'agama'=> "Islam",
                'nomor_telepon'=> "081928374650",
            ],
            [
                'id_karyawan'=>Str::uuid(),
                'kode_karyawan'=>"13524",
                'nama_karyawan'=>"NicholasThomasAdmin",
                'kode_jabatan'=> "A07",
                'email'=>"nt@gmail.com",
                'password'=>Hash::make(12345678),
                'jenis_kelamin'=>"Laki-laki",
                'tempat_lahir'=> "Palembang",
                'tanggal_lahir'=> "1990-09-15",
                'alamat'=>"Jalan Merapi No 87 Ilir 17 Palembang",
                'agama'=> "Islam",
                'nomor_telepon'=> "080918273645",
            ],
        ]);
    }
}
