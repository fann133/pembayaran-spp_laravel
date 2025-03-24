<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('biaya', function (Blueprint $table) {
            $table->string('nama')->after('id_biaya'); // Tambah kolom nama
            $table->enum('jenis', ['SPP', 'NON-SPP'])->default('SPP')->change(); // Ubah jenis ke ENUM
        });
    }

    public function down()
    {
        Schema::table('biaya', function (Blueprint $table) {
            $table->dropColumn('nama'); // Hapus kolom nama jika rollback
            $table->string('jenis')->change(); // Ubah kembali jenis ke string
        });
    }
};

