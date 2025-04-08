<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('nama_aplikasi')->default('INFAQKU');
            $table->string('ikon_sidebar')->default('fa-dollar-sign');
            $table->string('warna_sidebar')->default('bg-gradient-primary');
            $table->string('footer')->default('Copyright © Pembayaran SPP');
            $table->string('logo')->nullable(); // Simpan path ke file logo
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }

};
