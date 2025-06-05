<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDecimalPrecisionOnPembayaranTable extends Migration
{
    public function up()
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->decimal('jumlah_tagihan', 15, 2)->change();
            $table->decimal('dibayar', 15, 2)->change();
            $table->decimal('piutang', 15, 2)->change();
        });
    }

    public function down()
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->decimal('jumlah_tagihan', 10, 2)->change();
            $table->decimal('dibayar', 10, 2)->change();
            $table->decimal('piutang', 10, 2)->change();
        });
    }
}

