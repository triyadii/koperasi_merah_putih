<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeuanganKasSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nomorAnggota' => 'ANG001',
                'namaAnggota' => 'Ahmad Fauzi',
                'simpananPokok' => 1000000,
                'simpananWajib' => 500000,
                'tanggalBayar' => '2026-01-15',
                'keterangan' => 'Pembayaran simpanan bulan Januari',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomorAnggota' => 'ANG001',
                'namaAnggota' => 'Ahmad Fauzi',
                'simpananPokok' => 0,
                'simpananWajib' => 500000,
                'tanggalBayar' => '2026-02-15',
                'keterangan' => 'Pembayaran simpanan bulan Februari',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomorAnggota' => 'ANG002',
                'namaAnggota' => 'Dewi Kusumawati',
                'simpananPokok' => 1000000,
                'simpananWajib' => 500000,
                'tanggalBayar' => '2026-01-15',
                'keterangan' => 'Pembayaran simpanan bulan Januari',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomorAnggota' => 'ANG002',
                'namaAnggota' => 'Dewi Kusumawati',
                'simpananPokok' => 0,
                'simpananWajib' => 500000,
                'tanggalBayar' => '2026-02-15',
                'keterangan' => 'Pembayaran simpanan bulan Februari',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomorAnggota' => 'ANG003',
                'namaAnggota' => 'Rudi Hartono',
                'simpananPokok' => 1500000,
                'simpananWajib' => 750000,
                'tanggalBayar' => '2026-01-20',
                'keterangan' => 'Pembayaran simpanan bulan Januari',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomorAnggota' => 'ANG003',
                'namaAnggota' => 'Rudi Hartono',
                'simpananPokok' => 0,
                'simpananWajib' => 750000,
                'tanggalBayar' => '2026-02-20',
                'keterangan' => 'Pembayaran simpanan bulan Februari',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('table_keuangan_kas')->insert($data);
    }
}
