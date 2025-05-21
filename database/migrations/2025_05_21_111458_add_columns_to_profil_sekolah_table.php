<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('profil_sekolah', function (Blueprint $table) {
            $table->string('naungan')->after('id_profil');                         // Instansi Naungan
            $table->string('nsm')->after('npsn');                                  // NSM
            $table->string('akreditasi')->after('nsm');                            // Akreditasi
            $table->string('sk')->after('akreditasi');                             // SK Pendirian
            $table->string('kode_pos')->after('alamat_sekolah');                  // Kode Pos
            $table->string('nip')->after('kepala_sekolah');                       // NIP Kepala Sekolah
            $table->string('logo_naungan')->after('logo');                        // Logo Instansi Naungan
        });
    }

    public function down(): void
    {
        Schema::table('profil_sekolah', function (Blueprint $table) {
            $table->dropColumn([
                'naungan',
                'nsm',
                'akreditasi',
                'sk',
                'kode_pos',
                'nip',
                'logo_naungan'
            ]);
        });
    }
};
