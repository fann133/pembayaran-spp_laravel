<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('kelas', function (Blueprint $table) {
            // Hapus foreign key constraint terlebih dahulu
            $table->dropForeign(['id_guru']);

            // Baru hapus kolomnya
            $table->dropColumn('id_guru');
        });
    }

    public function down(): void
    {
        Schema::table('kelas', function (Blueprint $table) {
            $table->unsignedBigInteger('id_guru')->nullable();

            // Tambahkan kembali foreign key jika perlu
            $table->foreign('id_guru')->references('id')->on('gurus')->onDelete('set null');
        });
    }
};


