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
        Schema::table('kelas', function (Blueprint $table) {
            $table->unique('pengampu_kelas'); // Membuat pengampu_kelas unik
        });
    }

    public function down()
    {
        Schema::table('kelas', function (Blueprint $table) {
            $table->dropUnique(['pengampu_kelas']);
        });
    }

};
