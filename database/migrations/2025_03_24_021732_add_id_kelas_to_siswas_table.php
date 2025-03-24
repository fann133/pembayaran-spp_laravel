<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->uuid('id_kelas')->nullable()->after('nis');

            // Relasi ke tabel kelas
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('set null')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropForeign(['id_kelas']);
            $table->dropColumn('id_kelas');
        });
    }
};


