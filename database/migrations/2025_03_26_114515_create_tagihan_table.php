<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tagihan', function (Blueprint $table) {
            $table->uuid('id_tagihan')->primary();
            $table->uuid('id_siswa');
            $table->string('nama');
            $table->string('nis')->unique();
            $table->uuid('id_biaya');
            $table->string('nama_pembayaran');
            $table->enum('jenis', ['SPP', 'NON-SPP']);
            $table->string('jumlah');
            $table->string('bulan');
            $table->enum('status', ['BELUM DIBAYAR', 'SUDAH DIBAYAR'])->default('BELUM DIBAYAR');
            $table->timestamps();

            // Foreign keys
            $table->foreign('id_siswa')->references('id_siswa')->on('siswas')->onDelete('cascade');
            $table->foreign('id_biaya')->references('id_biaya')->on('biaya')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tagihan');
    }
};

