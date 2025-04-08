<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('tagihan', function (Blueprint $table) {
            $table->string('kode')->after('id_biaya')->nullable()->comment('Kode dari tabel biaya');
        });

        Schema::table('pembayaran', function (Blueprint $table) {
            $table->string('kode')->after('id_tagihan')->nullable()->comment('Kode dari tabel biaya');
        });
    }

    public function down()
    {
        Schema::table('tagihan', function (Blueprint $table) {
            $table->dropColumn('kode');
        });

        Schema::table('pembayaran', function (Blueprint $table) {
            $table->dropColumn('kode');
        });
    }
};

