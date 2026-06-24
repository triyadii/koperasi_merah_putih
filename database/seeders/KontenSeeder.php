<?php

namespace Database\Seeders;

use App\Models\Konten;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class KontenSeeder extends Seeder
{
    public function run(): void
    {
        // Buat placeholder logo SVG
        $svgLogo = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200">'
            . '<rect width="200" height="200" rx="20" fill="#CC0000"/>'
            . '<text x="100" y="90" font-size="48" font-weight="bold" text-anchor="middle" fill="#FFFFFF" font-family="Arial">KMP</text>'
            . '<text x="100" y="135" font-size="14" text-anchor="middle" fill="#FFCCCC" font-family="Arial">Koperasi</text>'
            . '<text x="100" y="158" font-size="14" text-anchor="middle" fill="#FFCCCC" font-family="Arial">Merah Putih</text>'
            . '</svg>';
        Storage::disk('public')->put('konten/logo-koperasi.svg', $svgLogo);

        Konten::create([
            'namaKoperasi'  => 'Koperasi Merah Putih',
            'logoKoperasi'  => 'konten/logo-koperasi.svg',
            'tagline'       => '<p>Bersatu untuk <strong>Sejahtera</strong> — Koperasi Merah Putih hadir untuk meningkatkan kesejahteraan anggota dan masyarakat sekitar melalui layanan keuangan yang terpercaya, transparan, dan berkeadilan.</p>',
            'bannerProgram' => '<h3>Program Unggulan Kami</h3>'
                . '<ul>'
                . '<li><strong>Simpan Pinjam</strong> — Fasilitas simpanan dan pinjaman dengan bunga rendah dan proses mudah.</li>'
                . '<li><strong>Modal Usaha</strong> — Dukungan permodalan untuk anggota yang ingin mengembangkan usaha kecil dan menengah.</li>'
                . '<li><strong>Asuransi Koperasi</strong> — Perlindungan jiwa dan kesehatan bagi seluruh anggota aktif.</li>'
                . '<li><strong>Pelatihan Kewirausahaan</strong> — Program rutin untuk meningkatkan kapasitas dan keterampilan anggota.</li>'
                . '</ul>'
                . '<p>Bergabunglah bersama ribuan anggota yang telah merasakan manfaat nyata dari Koperasi Merah Putih.</p>',
            'kontak'        => '081234567890',
            'lokasi'        => 'https://maps.google.com/?q=Koperasi+Merah+Putih+Jakarta',
        ]);
    }
}
