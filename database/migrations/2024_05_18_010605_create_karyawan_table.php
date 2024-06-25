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
            $table->string('id')->primary();
            $table->string('id_jabatan');
            $table->foreign('id_jabatan')->references('id')->on('jabatan')->cascadeOnUpdate();
            $table->string("nama")->unique();
            $table->string('email')->unique();
            $table->string("password");
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string("tempat_lahir");
            $table->date("tanggal_lahir");
            $table->string("alamat");
            $table->string('foto')->nullable();
            $table->enum('agama', ['Kristen', 'Islam', 'Buddha', 'Hindu', 'Konghucu', 'Katolik']);
            $table->string("no_telp", 13)->unique();
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
