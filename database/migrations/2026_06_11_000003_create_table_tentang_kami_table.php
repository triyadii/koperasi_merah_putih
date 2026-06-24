<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('table_tentang_kami', function (Blueprint $table) {
            $table->id();
            $table->text('sejarah');
            $table->text('latarBelakang');
            $table->text('Visi');
            $table->text('Misi');
            $table->text('nilai');
            $table->text('tujuanUtama');
            $table->text('dasarHukum');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('table_tentang_kami');
    }
};
