<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('tagihan', function (Blueprint $table) {
            $table->string('kelas')->nullable()->after('nis'); // Menambahkan kolom kelas setelah nis
        });
    }

    public function down()
    {
        Schema::table('tagihan', function (Blueprint $table) {
            $table->dropColumn('kelas');
        });
    }
};
