<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->string('category', 50)->change();
        });
    }

    public function down()
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->enum('category', ['atas', 'menengah', 'bawah'])->change();
        });
    }
};

