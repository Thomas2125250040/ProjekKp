<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory, HasUuids;
    protected $table = "jabatan";
    protected $primaryKey = 'id_jabatan'; // Set the primary key to id_karyawan
    public $incrementing = false; // Disable auto-incrementing
    protected $keyType = 'string'; // Specify the key type

    protected $fillable = [
        "kode_jabatan",
        "nama_jabatan",
        "gaji_pokok"
        // "uang_makan",
        // "uang_lembur"
    ];
}
