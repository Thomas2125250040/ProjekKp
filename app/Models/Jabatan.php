<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;
    protected $table = "jabatan";
    protected $keyType = 'string';

    protected $fillable = [
        "id",
        "nama",
        "gaji_pokok",
        "uang_makan",
        "uang_lembur"
    ];
}
