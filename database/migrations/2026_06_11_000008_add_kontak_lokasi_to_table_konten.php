<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('table_konten', function (Blueprint $table) {
            $table->string('kontak', 20)->nullable()->after('bannerProgram');
            $table->text('lokasi')->nullable()->after('kontak');
        });
    }

    public function down(): void
    {
        Schema::table('table_konten', function (Blueprint $table) {
            $table->dropColumn(['kontak', 'lokasi']);
        });
    }
};
