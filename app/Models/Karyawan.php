<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Karyawan extends Model
{
    use HasFactory,SoftDeletes;
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
        return $this->belongsTo(Jabatan::class, 'id_jabatan');
    }

    public function karyawan_absensi(){
        return $this->hasMany(KaryawanAbsensi::class);
    }

    public function karyawan_izin(){
        return $this->hasMany(KaryawanIzin::class);
    }

    public function delete()
    {
        $this->karyawan_absensi->delete();
        $this->karyawan_izin->delete();
        parent::delete();
    }
}
