<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('karyawan', function (Blueprint $table) {
            //$table->uuid('id_karyawan')->primary();
            //$table->string('nama')->unique();
           //$table->foreignUuid('id_jabatan')->constrained('jabatan', 'id');
            //$table->date('tanggal_lahir');

            $table->uuid("id_karyawan")->primary();
            $table->char("kode_karyawan")->unique();
            $table->string("nama_karyawan");
            $table->string('email')->unique();
            $table->string("password");
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->default("Laki-laki");
            $table->string("tempat_lahir");
            $table->date("tanggal_lahir");
            $table->string("alamat");
            $table->string("agama");
            $table->string("nomor_telepon");
            //$table->enum('hak_akses', ['1', '2', '3', '4'])->default("4");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};
