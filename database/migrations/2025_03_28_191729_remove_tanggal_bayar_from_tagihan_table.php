<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('tagihan', function (Blueprint $table) {
            $table->dropColumn('tanggal_bayar'); // Hapus kolom
        });
    }

    public function down()
    {
        Schema::table('tagihan', function (Blueprint $table) {
            $table->date('tanggal_bayar')->nullable()->after('status'); // Jika rollback, tambahkan lagi
        });
    }
};

