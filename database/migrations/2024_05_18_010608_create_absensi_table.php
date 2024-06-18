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
        // Schema::create('absensi', function (Blueprint $table) {
        //     $table->uuid('id_absensi')->primary();
        //     $table->foreignUuid('id_karyawan')->constrained('karyawan', 'id_karyawan');
        //     $table->time('waktu_masuk');
        //     $table->time('waktu_pulang');
        //     $table->date('tanggal');
        //     $table->char('status');
        //     $table->text('keterangan')->nullable();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
