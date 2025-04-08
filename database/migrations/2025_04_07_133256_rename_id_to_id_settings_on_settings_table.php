<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class RenameIdToIdSettingsOnSettingsTable extends Migration
{
    public function up()
    {
        // 1. Tambahkan kolom uuid baru
        Schema::table('settings', function (Blueprint $table) {
            $table->uuid('id_settings')->nullable()->after('id');
        });

        // 2. Isi UUID ke id_settings
        DB::statement('UPDATE settings SET id_settings = UUID()');

        // 3. Hapus kolom id lama
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('id');
        });

        // 4. Jadikan id_settings sebagai primary key
        Schema::table('settings', function (Blueprint $table) {
            $table->primary('id_settings');
        });
    }

    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->increments('id')->first();
            $table->dropPrimary();
            $table->dropColumn('id_settings');
        });
    }
}
