<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('table_anggota', function (Blueprint $table) {
            $table->string('namaUsaha')->nullable()->after('email');
            $table->string('fotoUsaha')->nullable()->after('namaUsaha');
            $table->string('fileKtp')->nullable()->after('fotoUsaha');
        });
    }

    public function down(): void
    {
        Schema::table('table_anggota', function (Blueprint $table) {
            $table->dropColumn(['namaUsaha', 'fotoUsaha', 'fileKtp']);
        });
    }
};
