<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('table_anggota', function (Blueprint $table) {
            $table->id();
            $table->string('namaLengkap');
            $table->string('tempatLahir', 100);
            $table->date('tanggalLahir');
            $table->enum('jenisKelamin', ['Laki-laki', 'Perempuan']);
            $table->string('agama', 50);
            $table->enum('statusPerkawinan', ['Belum Menikah', 'Menikah', 'Cerai Hidup', 'Cerai Mati']);
            $table->string('kewarganegaraan', 50)->default('WNI');
            $table->string('nomorKTP', 20)->unique();
            $table->string('nomorKK', 20);
            $table->text('alamatKTP');
            $table->text('alamatDomisili')->nullable();
            $table->string('nomorHP', 20);
            $table->string('email')->nullable();
            $table->string('pekerjaan', 100)->nullable();
            $table->string('namaTempatKerja')->nullable();
            $table->text('alamatTempatKerja')->nullable();
            $table->string('jabatan', 100)->nullable();
            $table->unsignedBigInteger('penghasilan')->nullable();
            $table->unsignedBigInteger('simpananWajib');
            $table->string('nomorRekening', 50)->nullable();
            $table->string('foto')->nullable();
            $table->enum('statusAnggota', ['pending', 'aktif', 'nonaktif'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('table_anggota');
    }
};
