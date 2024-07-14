<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Karyawan extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;
    protected $table = "karyawan";
    protected $keyType = 'string';
    protected $fillable = [
        "id",
        "id_jabatan",
        "nama", // Pastikan kolom nama ada di tabel karyawan
        "email",
        "jenis_kelamin",
        "tempat_lahir",
        "tanggal_lahir",
        "alamat",
        "foto",
        "agama",
        "no_telp"
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->setDescriptionForEvent(function(string $eventName) {
                return "{$this->nama} melakukan {$eventName} data {$this->getKey()}";
            });
    }
}
