<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('kelas', function (Blueprint $table) {
            $table->char('pengampu_kelas', 36)->nullable()->after('deskripsi');
            $table->foreign('pengampu_kelas')->references('id_guru')->on('gurus')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('kelas', function (Blueprint $table) {
            $table->dropForeign(['pengampu_kelas']);
            $table->dropColumn('pengampu_kelas');
        });
    }
};

