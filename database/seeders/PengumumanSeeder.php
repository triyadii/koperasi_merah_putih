<?php

namespace Database\Seeders;

use App\Models\Pengumuman;
use Illuminate\Database\Seeder;

class PengumumanSeeder extends Seeder
{
    public function run(): void
    {
        $pengumumans = [
            [
                'judul'      => 'Jadwal Pembayaran Simpanan Wajib Bulan April 2025',
                'keterangan' => '<p>Diberitahukan kepada seluruh anggota Koperasi Merah Putih bahwa <strong>pembayaran simpanan wajib bulan April 2025</strong> dibuka mulai tanggal <strong>1 April hingga 15 April 2025</strong>.</p>'
                    . '<p>Pembayaran dapat dilakukan melalui:</p>'
                    . '<ul>'
                    . '<li>Langsung di kantor koperasi (Senin–Jumat, 08.00–16.00 WIB)</li>'
                    . '<li>Transfer ke rekening koperasi: <strong>BRI 1234-01-012345-53-7</strong> a.n. Koperasi Merah Putih</li>'
                    . '<li>Aplikasi mobile koperasi (segera tersedia)</li>'
                    . '</ul>'
                    . '<p>Anggota yang terlambat membayar akan dikenakan denda sesuai ketentuan AD/ART. Untuk informasi lebih lanjut, hubungi pengurus di kantor atau via WhatsApp di nomor <strong>0812-3456-7890</strong>.</p>',
                'status'     => 'published',
            ],
            [
                'judul'      => 'Perubahan Jam Operasional Kantor Selama Ramadhan 1446 H',
                'keterangan' => '<p>Dalam rangka menyambut bulan suci Ramadhan 1446 H, kantor Koperasi Merah Putih akan mengalami perubahan jam operasional sebagai berikut:</p>'
                    . '<table>'
                    . '<tr><th>Hari</th><th>Jam Sebelumnya</th><th>Jam Selama Ramadhan</th></tr>'
                    . '<tr><td>Senin – Jumat</td><td>08.00 – 16.00</td><td>08.00 – 15.00</td></tr>'
                    . '<tr><td>Sabtu</td><td>08.00 – 12.00</td><td>08.00 – 11.30</td></tr>'
                    . '<tr><td>Minggu / Libur</td><td>Tutup</td><td>Tutup</td></tr>'
                    . '</table>'
                    . '<p>Pengurus dan karyawan koperasi menyampaikan <em>Selamat Menunaikan Ibadah Puasa</em> bagi seluruh anggota yang menjalankannya. Semoga amal ibadah kita semua diterima Allah SWT.</p>',
                'status'     => 'published',
            ],
            [
                'judul'      => 'Hasil Seleksi Calon Anggota Baru Periode Maret 2025',
                'keterangan' => '<p>Pengurus Koperasi Merah Putih mengumumkan hasil seleksi calon anggota baru yang mendaftar pada periode Januari–Maret 2025.</p>'
                    . '<p>Dari total <strong>48 formulir pendaftaran</strong> yang masuk, sebanyak <strong>35 calon anggota dinyatakan memenuhi syarat</strong> dan akan resmi menjadi anggota koperasi setelah melunasi simpanan pokok dan wajib perdana.</p>'
                    . '<p>Calon anggota yang dinyatakan lolos dapat melakukan konfirmasi dan pembayaran simpanan di kantor koperasi mulai tanggal <strong>1–14 April 2025</strong>. Calon anggota yang tidak melakukan konfirmasi dalam batas waktu tersebut dianggap mengundurkan diri.</p>'
                    . '<p>Selamat bergabung dan selamat datang di keluarga besar Koperasi Merah Putih!</p>',
                'status'     => 'published',
            ],
            [
                'judul'      => 'Pemeliharaan Sistem Informasi Koperasi',
                'keterangan' => '<p>Diberitahukan kepada seluruh anggota bahwa <strong>sistem informasi koperasi</strong> akan menjalani pemeliharaan terjadwal (scheduled maintenance) pada:</p>'
                    . '<ul>'
                    . '<li><strong>Hari:</strong> Minggu, 20 April 2025</li>'
                    . '<li><strong>Waktu:</strong> 22.00 – 06.00 WIB (hari berikutnya)</li>'
                    . '</ul>'
                    . '<p>Selama pemeliharaan berlangsung, akses ke portal anggota online dan aplikasi mobile akan sementara tidak dapat digunakan. Layanan tatap muka di kantor tidak terpengaruh.</p>'
                    . '<p>Kami mohon maaf atas ketidaknyamanan yang ditimbulkan. Pemeliharaan ini dilakukan untuk meningkatkan keamanan dan performa sistem demi kenyamanan anggota.</p>',
                'status'     => 'published',
            ],
            [
                'judul'      => 'Pemberitahuan Pembagian SHU Tahun Buku 2024',
                'keterangan' => '<p>Merujuk pada keputusan Rapat Anggota Tahunan (RAT) tanggal 25 Januari 2025, pengurus Koperasi Merah Putih memberitahukan bahwa <strong>Sisa Hasil Usaha (SHU) Tahun Buku 2024</strong> siap dibagikan kepada anggota yang berhak.</p>'
                    . '<p>Total SHU yang dibagikan: <strong>Rp 1.248.500.000</strong></p>'
                    . '<p>Mekanisme pembagian:</p>'
                    . '<ol>'
                    . '<li>40% berdasarkan jasa simpanan anggota</li>'
                    . '<li>40% berdasarkan partisipasi anggota dalam unit usaha</li>'
                    . '<li>20% untuk cadangan koperasi</li>'
                    . '</ol>'
                    . '<p>Anggota dapat mengambil SHU secara tunai di kantor koperasi atau memindahkan ke rekening simpanan sukarela. Pengambilan SHU dibuka mulai <strong>1 Maret – 31 Mei 2025</strong>. SHU yang tidak diambil setelah batas waktu akan otomatis masuk ke simpanan sukarela.</p>',
                'status'     => 'draft',
            ],
        ];

        foreach ($pengumumans as $pengumuman) {
            Pengumuman::create($pengumuman);
        }
    }
}
