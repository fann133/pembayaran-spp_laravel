<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->uuid('id_kelas')->primary();
            $table->string('nama');
            $table->string('kode_kelas')->unique();
            $table->text('deskripsi')->nullable();
            $table->uuid('id_guru')->nullable();
            $table->timestamps();

            // Relasi ke tabel gurus
            $table->foreign('id_guru')->references('id_guru')->on('gurus')->onDelete('set null')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kelas');
    }
};


