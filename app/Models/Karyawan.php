<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $table = "karyawan";
    protected $keyType = 'string';
    protected $fillable = [
        "id",
        "nama",
        "gaji_pokok",
        "uang_makan",
        "uang_lembur"
    ];
}
