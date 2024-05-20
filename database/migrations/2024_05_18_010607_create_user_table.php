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
        Schema::create('user', function (Blueprint $table) {
            $table->uuid('id_user')->primary();
            $table->string('username')->unique();
            $table->string('password');
            $table->binary('foto_profil');
            $table->tinyInteger('hak_akses');
            $table->foreignUuid('id_karyawan')->constrained('karyawan', 'id_karyawan')->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
