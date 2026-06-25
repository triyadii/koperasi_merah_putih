<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('table_keuangan_kas', function (Blueprint $table) {
            $table->id();
            $table->string('nomorAnggota', 50);
            $table->string('namaAnggota', 255);
            $table->unsignedBigInteger('simpananPokok')->default(0);
            $table->unsignedBigInteger('simpananWajib')->default(0);
            $table->date('tanggalBayar');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->index('nomorAnggota');
            $table->index('tanggalBayar');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('table_keuangan_kas');
    }
};
