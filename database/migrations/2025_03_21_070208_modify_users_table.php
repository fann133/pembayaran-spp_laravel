<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus constraint unique jika sudah ada
            $table->dropUnique('users_username_unique');

            // Tambahkan kembali unique constraint pada username
            $table->string('username')->unique()->change();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Kembalikan ke keadaan sebelum migrasi
            $table->dropUnique(['username']);
            $table->string('username')->change(); // Hilangkan unique
        });
    }
};

