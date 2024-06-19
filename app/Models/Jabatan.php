<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory, HasUuids;
    protected $table = "jabatan";
    protected $primaryKey = 'id_jabatan'; 
    public $incrementing = false; 
    protected $keyType = 'string'; 

    protected $fillable = [
        "kode_jabatan",
        "nama_jabatan",
        "gaji_pokok"
        // "uang_makan",
        // "uang_lembur"
    ];
}
