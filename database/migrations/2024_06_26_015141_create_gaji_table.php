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
            // $table->char('tahun', 4);
            // $table->char('bulan', 2);
            // $table->primary(['tahun', 'bulan']);
            // $table->string('id_jabatan');
            // $table->foreign('id_jabatan')->references('id')->on('jabatan')->cascadeOnUpdate();
            // $table->integer('gaji_pokok');
            // $table->mediumInteger('uang_makan');
            // $table->mediumInteger('uang_lembur');
            // $table->timestamps();

            $table->increments('id');
            $table->char('tahun', 4);
            $table->char('bulan', 2);
            $table->string('id_jabatan');
            $table->foreign('id_jabatan')->references('id')->on('jabatan')->cascadeOnUpdate();
            $table->integer('gaji_pokok');
            $table->mediumInteger('uang_makan');
            $table->mediumInteger('uang_lembur');
            $table->timestamps();
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
