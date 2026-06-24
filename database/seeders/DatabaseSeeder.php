<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();
        DB::table('table_konten')->truncate();
        DB::table('table_tentang_kami')->truncate();
        DB::table('table_unit_usaha')->truncate();
        DB::table('table_anggota')->truncate();
        DB::table('table_berita')->truncate();
        DB::table('table_pengumuman')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $this->call([
            UserSeeder::class,
            KontenSeeder::class,
            TentangKamiSeeder::class,
            UnitUsahaSeeder::class,
            AnggotaSeeder::class,
            BeritaSeeder::class,
            PengumumanSeeder::class,
        ]);
    }
}
