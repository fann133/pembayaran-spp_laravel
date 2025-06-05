<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeJumlahColumnTypeOnTagihanAndBiayaTables extends Migration
{
    public function up()
    {
        Schema::table('tagihan', function (Blueprint $table) {
            $table->decimal('jumlah', 15, 2)->change();
        });

        Schema::table('biaya', function (Blueprint $table) {
            $table->decimal('jumlah', 15, 2)->change();
        });
    }

    public function down()
    {
        Schema::table('tagihan', function (Blueprint $table) {
            $table->string('jumlah', 255)->change();
        });

        Schema::table('biaya', function (Blueprint $table) {
            $table->string('jumlah', 255)->change();
        });
    }
}

