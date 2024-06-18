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
        Schema::create('jabatan', function (Blueprint $table) {
            //$table->string('nama')->unique();
            //$table->integer('gaji_pokok');
           // $table->mediumInteger('uang_makan');
           // $table->mediumInteger('uang_lembur');
           
            $table->uuid("id_jabatan")->primary();
            $table->char("kode_jabatan")->unique();
            $table->string("nama_jabatan");
            $table->integer('gaji_pokok');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jabatan');
    }
};
