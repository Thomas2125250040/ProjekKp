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
        // Schema::disableForeignKeyConstraints();

        // Schema::create('bonus', function (Blueprint $table) {
        //     $table->uuid('id_bonus')->primary();
        //     $table->foreignUuid('id_gaji')->constrained('gaji', 'id_gaji');
        //     $table->mediumInteger('id_kategori_bonus')->unsigned();
        //     $table->foreign('id_kategori_bonus')->references('id_kategori_bonus')->on('kategori_bonus');
        //     $table->integer('jumlah');
        //     $table->text('keterangan');
        // });

        // Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bonus');
    }
};
