<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->uuid('users_id')->nullable()->after('nis'); // Tambah kolom users_id
            $table->foreign('users_id')->references('id_users')->on('users')->onDelete('cascade'); // Tambah FK
        });
    }

    public function down()
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropForeign(['users_id']); // Hapus FK
            $table->dropColumn('users_id'); // Hapus kolom
        });
    }
};

