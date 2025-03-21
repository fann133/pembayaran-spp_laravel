<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('siswas', function (Blueprint $table) {
            // Hapus kolom status yang lama
            $table->dropColumn('status');
        });

        Schema::table('siswas', function (Blueprint $table) {
            // Tambahkan ulang kolom status tanpa default
            $table->enum('status', ['AKTIF', 'LULUS', 'PINDAHAN', 'KELUAR'])->after('category');
        });
    }

    public function down()
    {
        Schema::table('siswas', function (Blueprint $table) {
            // Hapus kolom status jika rollback
            $table->dropColumn('status');
        });

        Schema::table('siswas', function (Blueprint $table) {
            // Tambahkan kembali status tanpa default
            $table->enum('status', ['AKTIF', 'LULUS', 'PINDAHAN', 'KELUAR'])->after('category');
        });
    }
};
