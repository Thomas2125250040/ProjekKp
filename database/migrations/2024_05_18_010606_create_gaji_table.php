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
        Schema::create('gaji', function (Blueprint $table) {
            $table->uuid('id_gaji')->primary();
            $table->foreignUuid('id_karyawan')->constrained('karyawan', 'id_karyawan')->unique();
            $table->date('periode_awal');
            $table->date('periode_akhir');
            $table->boolean('status');
            $table->binary('bukti_bayar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gaji');
    }
};
