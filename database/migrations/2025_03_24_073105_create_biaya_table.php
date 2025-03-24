<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration {
    public function up()
    {
        Schema::create('biaya', function (Blueprint $table) {
            $table->uuid('id_biaya')->primary()->default(Str::uuid());
            $table->string('jenis', 100);
            $table->string('kode', 50)->unique();
            $table->text('deskripsi')->nullable();
            $table->string('jumlah', 50);
            $table->enum('status', ['LUNAS', 'BELUM LUNAS'])->default('BELUM LUNAS');
            $table->enum('kategori', ['Atas', 'Menengah', 'Bawah']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('biaya');
    }
};

