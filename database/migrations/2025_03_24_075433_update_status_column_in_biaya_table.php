<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('biaya', function (Blueprint $table) {
            $table->enum('status', ['AKTIF', 'NON AKTIF'])->default('AKTIF')->change();
        });
    }

    public function down()
    {
        Schema::table('biaya', function (Blueprint $table) {
            $table->enum('status', ['LUNAS', 'BELUM BAYAR'])->default('BELUM BAYAR')->change();
        });
    }
};

