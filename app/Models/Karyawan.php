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
        "id_jabatan",
        "nama",
        "email",
        "jenis_kelamin",
        "tempat_lahir",
        "tanggal_lahir",
        "alamat",
        "foto",
        "agama",
        "no_telp"
    ];
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan')->select(['id', 'nama']);
    }
}
