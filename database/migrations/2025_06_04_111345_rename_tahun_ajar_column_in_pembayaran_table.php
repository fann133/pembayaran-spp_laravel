<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->renameColumn('tahun_ajar', 'tahun_pelajaran');
        });
    }

    public function down(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->renameColumn('tahun_pelajaran', 'tahun_ajar');
        });
    }
};

