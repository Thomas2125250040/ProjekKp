<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory, HasUuids;
    protected $table = "jabatan";

    protected $fillable = [
        "kode_jabatan",
        "nama_jabatan",
        "gaji_pokok"
        // "uang_makan",
        // "uang_lembur"
    ];
}
