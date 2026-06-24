<?php

namespace Database\Seeders;

use App\Models\UnitUsaha;
use Illuminate\Database\Seeder;

class UnitUsahaSeeder extends Seeder
{
    public function run(): void
    {
        $units = [
            [
                'namaUsaha'  => 'Unit Simpan Pinjam',
                'keterangan' => '<p><strong>Unit Simpan Pinjam (USP)</strong> adalah unit usaha utama Koperasi Merah Putih yang melayani kebutuhan simpanan dan pinjaman anggota.</p>'
                    . '<h4>Layanan Simpanan</h4>'
                    . '<ul>'
                    . '<li>Simpanan Pokok — dibayarkan satu kali saat menjadi anggota</li>'
                    . '<li>Simpanan Wajib — dibayarkan rutin setiap bulan</li>'
                    . '<li>Simpanan Sukarela — tabungan bebas dengan bunga kompetitif</li>'
                    . '</ul>'
                    . '<h4>Layanan Pinjaman</h4>'
                    . '<ul>'
                    . '<li>Pinjaman Konsumtif — untuk kebutuhan rumah tangga, pendidikan, dan kesehatan</li>'
                    . '<li>Pinjaman Produktif — untuk modal usaha dengan bunga mulai 1% per bulan</li>'
                    . '<li>Pinjaman Darurat — proses cepat 1×24 jam untuk kebutuhan mendesak</li>'
                    . '</ul>',
            ],
            [
                'namaUsaha'  => 'Toko Sembako Koperasi',
                'keterangan' => '<p><strong>Toko Sembako Koperasi</strong> menyediakan kebutuhan pokok sehari-hari bagi anggota dan masyarakat sekitar dengan harga terjangkau dan kualitas terjamin.</p>'
                    . '<p>Produk yang tersedia meliputi beras, gula, minyak goreng, tepung terigu, susu, telur, dan berbagai kebutuhan dapur lainnya. Anggota koperasi mendapatkan harga khusus dan dapat berbelanja secara kredit dengan pemotongan langsung dari simpanan.</p>'
                    . '<p>Jam operasional: Senin–Sabtu pukul 07.00–17.00 WIB.</p>',
            ],
            [
                'namaUsaha'  => 'Jasa Laundry Bersih',
                'keterangan' => '<p><strong>Jasa Laundry Bersih</strong> adalah unit usaha pencucian pakaian profesional milik Koperasi Merah Putih yang telah melayani lebih dari 200 pelanggan tetap.</p>'
                    . '<p>Layanan yang tersedia:</p>'
                    . '<ul>'
                    . '<li>Cuci + Setrika reguler (estimasi 2–3 hari)</li>'
                    . '<li>Cuci kilat 6 jam (tersedia setiap hari)</li>'
                    . '<li>Dry cleaning untuk pakaian khusus dan jas</li>'
                    . '<li>Cuci sepatu dan tas</li>'
                    . '</ul>'
                    . '<p>Anggota koperasi mendapatkan diskon 15% untuk semua layanan.</p>',
            ],
            [
                'namaUsaha'  => 'Rental Kendaraan',
                'keterangan' => '<p><strong>Unit Rental Kendaraan</strong> menyediakan armada kendaraan sewa untuk kebutuhan anggota koperasi dan masyarakat umum.</p>'
                    . '<p>Armada yang tersedia:</p>'
                    . '<ul>'
                    . '<li>3 unit Avanza (7 penumpang)</li>'
                    . '<li>2 unit Innova (8 penumpang)</li>'
                    . '<li>1 unit Bus Mini Elf (15 penumpang)</li>'
                    . '</ul>'
                    . '<p>Tersedia dengan atau tanpa pengemudi. Anggota aktif mendapatkan tarif preferensial dan prioritas pemesanan. Reservasi minimal H-1.</p>',
            ],
            [
                'namaUsaha'  => 'Katering & Konsumsi',
                'keterangan' => '<p><strong>Unit Katering & Konsumsi</strong> melayani kebutuhan makanan untuk berbagai acara, mulai dari rapat internal, pernikahan, arisan, hingga acara resmi korporat.</p>'
                    . '<p>Menu tersedia:</p>'
                    . '<ul>'
                    . '<li>Nasi kotak mulai Rp 15.000/box</li>'
                    . '<li>Prasmanan untuk 50–500 orang</li>'
                    . '<li>Snack box dan minuman</li>'
                    . '<li>Paket aneka kue tradisional</li>'
                    . '</ul>'
                    . '<p>Pemesanan minimal 50 porsi dengan notice H-3. Gratis ongkir untuk area Jakarta dan sekitarnya (min. 100 porsi).</p>',
            ],
        ];

        foreach ($units as $unit) {
            UnitUsaha::create($unit);
        }
    }
}
