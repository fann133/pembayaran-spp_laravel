<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('gurus', function (Blueprint $table) {
            // Kolom users_id sebagai foreign key yang terhubung ke tabel users
            $table->uuid('users_id')->nullable()->after('id_guru');
            $table->foreign('users_id')->references('id_users')->on('users')->onDelete('set null');

            // Kolom status dengan tipe enum
            $table->enum('status', ['TETAP', 'HONOR', 'MAGANG'])->after('agama')->default('HONOR');

            // Kolom role_id dengan tipe enum
            $table->enum('role_id', ['3', '4', '5'])->after('status')->default('3');
        });
    }

    public function down()
    {
        Schema::table('gurus', function (Blueprint $table) {
            $table->dropForeign(['users_id']);
            $table->dropColumn(['users_id', 'status', 'role_id']);
        });
    }
};

