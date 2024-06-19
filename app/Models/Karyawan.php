<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory, HasUuids;
    protected $table = "karyawan";
    protected $primaryKey = 'id_karyawan'; 
    public $incrementing = false; 
    protected $keyType = 'string'; 

    protected $fillable = [
        "kode_karyawan",
        "nama_karyawan",
        "kode_jabatan",
        "email",
        "password",
        "jenis_kelamin",
        "tempat_lahir",
        "tanggal_lahir",
        "alamat",
        "agama",
        "nomor_telepon"
    ];
}
