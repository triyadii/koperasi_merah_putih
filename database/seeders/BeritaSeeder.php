<?php

namespace Database\Seeders;

use App\Models\Berita;
use Illuminate\Database\Seeder;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        $beritas = [
            [
                'judul'      => 'Koperasi Merah Putih Raih Penghargaan Koperasi Berprestasi 2024',
                'tag'        => 'prestasi',
                'keterangan' => '<p>Koperasi Merah Putih berhasil meraih penghargaan <strong>Koperasi Berprestasi Tingkat Provinsi DKI Jakarta</strong> yang diserahkan langsung oleh Gubernur DKI Jakarta dalam rangkaian peringatan Hari Koperasi Nasional ke-77.</p>'
                    . '<p>Penghargaan ini diberikan atas komitmen koperasi dalam meningkatkan kesejahteraan anggota, pengelolaan keuangan yang transparan, dan inovasi layanan digital yang memudahkan akses bagi 1.200 lebih anggota aktif.</p>'
                    . '<p>"Penghargaan ini adalah milik seluruh anggota dan pengurus yang telah berjuang bersama selama hampir dua dekade. Ini bukan akhir, tapi awal dari tekad kami untuk terus berkembang lebih baik," ujar Ketua Koperasi, Bapak H. Supriyanto.</p>'
                    . '<p>Acara penganugerahan penghargaan berlangsung di Gedung Balaikota DKI Jakarta, dihadiri ratusan perwakilan koperasi se-Jakarta.</p>',
                'status'     => 'published',
            ],
            [
                'judul'      => 'Rapat Anggota Tahunan (RAT) 2024 Sukses Diselenggarakan',
                'tag'        => 'kegiatan',
                'keterangan' => '<p>Rapat Anggota Tahunan (RAT) Koperasi Merah Putih Tahun Buku 2024 telah berhasil diselenggarakan pada Sabtu, 25 Januari 2025 bertempat di Aula Serba Guna Kelurahan Cempaka Putih.</p>'
                    . '<p>RAT dihadiri oleh 892 anggota dari total 1.247 anggota aktif, atau setara dengan 71,5% kehadiran — melampaui kuorum yang ditetapkan dalam Anggaran Dasar.</p>'
                    . '<h4>Hasil RAT 2024</h4>'
                    . '<ul>'
                    . '<li>Laporan keuangan tahun buku 2024 diterima dan disahkan</li>'
                    . '<li>Sisa Hasil Usaha (SHU) sebesar Rp 1,2 miliar dibagikan kepada anggota</li>'
                    . '<li>Program kerja dan RAPBK tahun 2025 disetujui</li>'
                    . '<li>Pemilihan pengurus dan pengawas baru periode 2025–2028</li>'
                    . '</ul>',
                'status'     => 'published',
            ],
            [
                'judul'      => 'Program Pinjaman Modal Usaha Mikro Dibuka Kembali',
                'tag'        => 'program',
                'keterangan' => '<p>Memasuki triwulan kedua 2025, Koperasi Merah Putih kembali membuka program <strong>Pinjaman Modal Usaha Mikro (PMUM)</strong> dengan total alokasi dana sebesar Rp 3 miliar untuk 150 penerima manfaat.</p>'
                    . '<p>Program ini dirancang khusus untuk membantu anggota yang memiliki usaha mikro dan kecil agar dapat mengembangkan bisnisnya dengan modal yang terjangkau.</p>'
                    . '<h4>Syarat dan Ketentuan</h4>'
                    . '<ul>'
                    . '<li>Anggota aktif minimal 1 tahun</li>'
                    . '<li>Memiliki usaha yang berjalan minimal 6 bulan</li>'
                    . '<li>Plafon pinjaman Rp 5 juta – Rp 30 juta</li>'
                    . '<li>Bunga 0,8% per bulan (flat)</li>'
                    . '<li>Tenor 12–36 bulan</li>'
                    . '</ul>'
                    . '<p>Pendaftaran dibuka mulai 1 April hingga 30 April 2025. Formulir tersedia di kantor koperasi atau dapat diunduh melalui website.</p>',
                'status'     => 'published',
            ],
            [
                'judul'      => 'Pelatihan Literasi Keuangan untuk Anggota Muda',
                'tag'        => 'kegiatan',
                'keterangan' => '<p>Dalam rangka meningkatkan pemahaman keuangan anggota, Koperasi Merah Putih menyelenggarakan <strong>Pelatihan Literasi Keuangan</strong> yang ditujukan bagi anggota berusia 17–35 tahun.</p>'
                    . '<p>Pelatihan ini menghadirkan narasumber berpengalaman dari Otoritas Jasa Keuangan (OJK) dan praktisi keuangan syariah. Materi yang disampaikan mencakup manajemen keuangan rumah tangga, perencanaan investasi, dan pengelolaan utang yang sehat.</p>'
                    . '<p>Pelatihan diselenggarakan selama dua hari pada 15–16 Maret 2025 dan diikuti oleh 85 peserta. Seluruh peserta menerima sertifikat kelulusan dan paket starter kit perencanaan keuangan dari koperasi.</p>',
                'status'     => 'published',
            ],
            [
                'judul'      => 'Peluncuran Aplikasi Digital Koperasi Merah Putih',
                'tag'        => 'teknologi',
                'keterangan' => '<p>Koperasi Merah Putih segera meluncurkan <strong>Aplikasi Mobile Koperasi Merah Putih</strong> yang akan memudahkan anggota mengakses berbagai layanan koperasi kapan saja dan di mana saja.</p>'
                    . '<p>Fitur-fitur yang akan tersedia dalam aplikasi antara lain:</p>'
                    . '<ul>'
                    . '<li>Cek saldo simpanan secara real-time</li>'
                    . '<li>Pengajuan pinjaman online</li>'
                    . '<li>Pembayaran cicilan via transfer bank dan dompet digital</li>'
                    . '<li>Informasi SHU dan riwayat transaksi</li>'
                    . '<li>Notifikasi jadwal RAT dan kegiatan koperasi</li>'
                    . '</ul>'
                    . '<p>Aplikasi dijadwalkan soft-launch pada Mei 2025. Anggota yang mendaftar pada periode pre-registrasi akan mendapat cashback simpanan sukarela senilai Rp 50.000.</p>',
                'status'     => 'draft',
            ],
            [
                'judul'      => 'Koperasi Merah Putih Buka Cabang Baru di Jakarta Selatan',
                'tag'        => 'ekspansi',
                'keterangan' => '<p>Dalam rangka memperluas jangkauan layanan kepada masyarakat, Koperasi Merah Putih berencana membuka <strong>Kantor Cabang Pembantu (KCP) Jakarta Selatan</strong> yang berlokasi di Jalan Fatmawati Raya.</p>'
                    . '<p>Pembukaan cabang baru ini merupakan respons atas tingginya minat masyarakat Jakarta Selatan untuk bergabung sebagai anggota, yang dalam dua tahun terakhir mencapai lebih dari 300 pendaftaran dari wilayah tersebut.</p>'
                    . '<p>Kantor cabang baru direncanakan mulai beroperasi pada bulan Juli 2025 dengan layanan lengkap meliputi simpan pinjam, layanan administrasi keanggotaan, dan konsultasi keuangan.</p>',
                'status'     => 'draft',
            ],
        ];

        foreach ($beritas as $berita) {
            Berita::create($berita);
        }
    }
}
