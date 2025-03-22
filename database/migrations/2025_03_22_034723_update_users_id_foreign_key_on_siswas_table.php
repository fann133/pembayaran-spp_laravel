<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('siswas', function (Blueprint $table) {
            // Hapus foreign key lama (jika ada)
            $table->dropForeign(['users_id']);

            // Tambah foreign key baru dengan cascade on delete
            $table->foreign('users_id')
                  ->references('id_users')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('siswas', function (Blueprint $table) {
            // Hapus foreign key yang baru
            $table->dropForeign(['users_id']);

            // Tambahkan kembali foreign key sebelumnya (set null)
            $table->foreign('users_id')
                  ->references('id_users')
                  ->on('users')
                  ->onDelete('set null');
        });
    }
};
