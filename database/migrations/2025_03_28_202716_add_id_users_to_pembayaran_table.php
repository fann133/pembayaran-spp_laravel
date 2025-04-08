<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->char('id_users', 36)->after('id_pembayaran'); // Menggunakan char(36)
            $table->foreign('id_users')->references('id_users')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->dropForeign(['id_users']);
            $table->dropColumn('id_users');
        });
    }
};

