<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->uuid('id_pembayaran')->primary();
            $table->uuid('id_tagihan');
            $table->uuid('id_siswa');
            $table->string('nama');
            $table->string('nis');
            $table->string('kelas');
            $table->string('nama_pembayaran');
            $table->enum('jenis', ['SPP', 'NON-SPP']);
            $table->decimal('jumlah_tagihan', 10, 2);
            $table->decimal('dibayar', 10, 2);
            $table->decimal('piutang', 10, 2);
            $table->enum('status', ['LUNAS', 'BELUM LUNAS']);
            $table->timestamps();

            $table->foreign('id_tagihan')->references('id_tagihan')->on('tagihan')->onDelete('cascade');
            $table->foreign('id_siswa')->references('id_siswa')->on('siswas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
};

