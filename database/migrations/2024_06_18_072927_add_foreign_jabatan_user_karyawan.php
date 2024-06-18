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
        Schema::table('karyawan', function (Blueprint $table) {
            $table->string('kode_jabatan')->after('nama_karyawan');
            $table->foreign('kode_jabatan')->references('kode_jabatan')->on('jabatan')->onDelete('cascade')->onUpdate('cascade');
           // $table->foreign('kode_karyawan')->references('kode_karyawan')->on('user')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('karyawan', function (Blueprint $table) {
            //
        });
    }
};
