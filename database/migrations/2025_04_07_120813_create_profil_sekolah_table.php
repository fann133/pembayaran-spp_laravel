<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateProfilSekolahTable extends Migration
{
    public function up()
    {
        Schema::create('profil_sekolah', function (Blueprint $table) {
            $table->uuid('id_profil')->primary(); // pakai UUID sebagai primary key
            $table->string('nama_sekolah');
            $table->string('kepala_sekolah');
            $table->string('npsn')->nullable();
            $table->text('alamat_sekolah');
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('telepon')->nullable();
            $table->string('tahun_pelajaran');
            $table->string('logo')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('profil_sekolah');
    }
}

