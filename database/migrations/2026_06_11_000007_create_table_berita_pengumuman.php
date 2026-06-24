<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('table_berita', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('tag', 100)->nullable();
            $table->text('keterangan');
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->string('gambar')->nullable();
            $table->timestamps();
        });

        Schema::create('table_pengumuman', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('keterangan');
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('table_pengumuman');
        Schema::dropIfExists('table_berita');
    }
};
