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
       // Schema::create('user', function (Blueprint $table) {
           
            //$table->binary('foto_profil');
            //$table->int('hak_akses');
            // $table->foreignUuid('id_karyawan')->constrained('karyawan', 'id_karyawan')->unique();
         //   $table->uuid('id_user')->primary();
         //   $table->char('kode_karyawan')->unique();
          //  $table->string('password');
//$table->timestamps();
       // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
