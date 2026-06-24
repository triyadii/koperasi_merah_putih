<?php

namespace Database\Seeders;

use App\Models\TentangKami;
use Illuminate\Database\Seeder;

class TentangKamiSeeder extends Seeder
{
    public function run(): void
    {
        TentangKami::create([
            'sejarah'     => '<p>Koperasi Merah Putih berdiri pada tahun 2005 atas prakarsa sekelompok warga di Kelurahan Cempaka Putih, Jakarta Pusat. Berawal dari arisan sederhana yang beranggotakan 25 orang, koperasi ini berkembang pesat berkat kepercayaan dan semangat gotong royong para anggotanya.</p>'
                . '<p>Pada tahun 2008, koperasi resmi mendapatkan badan hukum dari Dinas Koperasi DKI Jakarta dengan nomor registrasi 503/BH/XII/2008. Sejak saat itu, Koperasi Merah Putih terus bertumbuh dan saat ini telah memiliki lebih dari 1.200 anggota aktif yang tersebar di berbagai wilayah Jakarta.</p>'
                . '<p>Selama lebih dari 18 tahun, koperasi ini telah menyalurkan pinjaman produktif senilai lebih dari 50 miliar rupiah dan berhasil meningkatkan taraf hidup ratusan keluarga anggota.</p>',

            'latarBelakang' => '<p>Koperasi Merah Putih lahir dari keprihatinan terhadap sulitnya akses masyarakat kecil terhadap layanan keuangan formal. Banyak warga yang tidak terjangkau oleh perbankan konvensional sehingga terpaksa meminjam kepada rentenir dengan bunga yang mencekik.</p>'
                . '<p>Dengan semangat kekeluargaan dan prinsip koperasi yang demokratis, Koperasi Merah Putih hadir sebagai solusi nyata — memberikan akses permodalan yang adil, terjangkau, dan mudah dijangkau oleh seluruh lapisan masyarakat, khususnya pelaku usaha mikro dan kecil.</p>',

            'Visi'        => '<p><strong>Menjadi koperasi terdepan, terpercaya, dan berdaya saing tinggi dalam mewujudkan kesejahteraan anggota dan masyarakat Indonesia yang mandiri dan berkeadilan.</strong></p>',

            'Misi'        => '<ul>'
                . '<li>Memberikan layanan keuangan yang mudah, cepat, dan berkeadilan kepada seluruh anggota.</li>'
                . '<li>Meningkatkan kapasitas ekonomi anggota melalui program simpan pinjam yang sehat dan bertanggung jawab.</li>'
                . '<li>Mengembangkan unit usaha yang produktif dan berkelanjutan demi kemajuan bersama.</li>'
                . '<li>Membangun sumber daya manusia koperasi yang profesional, jujur, dan berintegritas.</li>'
                . '<li>Menjalin kemitraan strategis dengan berbagai pihak untuk memperluas manfaat bagi anggota.</li>'
                . '</ul>',

            'nilai'       => '<ul>'
                . '<li><strong>Gotong Royong</strong> — Bekerja sama demi kepentingan bersama.</li>'
                . '<li><strong>Kejujuran</strong> — Transparansi dalam setiap pengelolaan keuangan dan operasional.</li>'
                . '<li><strong>Keadilan</strong> — Setiap anggota diperlakukan setara tanpa diskriminasi.</li>'
                . '<li><strong>Tanggung Jawab</strong> — Bertanggung jawab atas setiap keputusan dan tindakan.</li>'
                . '<li><strong>Inovasi</strong> — Terus berinovasi untuk meningkatkan kualitas layanan.</li>'
                . '</ul>',

            'tujuanUtama' => '<ol>'
                . '<li>Meningkatkan kesejahteraan ekonomi anggota melalui usaha simpan pinjam yang sehat.</li>'
                . '<li>Memberikan akses permodalan bagi usaha mikro, kecil, dan menengah anggota koperasi.</li>'
                . '<li>Memperkuat solidaritas sosial dan ekonomi anggota melalui kegiatan koperasi.</li>'
                . '<li>Mendorong kemandirian ekonomi anggota dengan program pelatihan dan pendampingan usaha.</li>'
                . '<li>Berkontribusi pada peningkatan taraf hidup masyarakat sekitar melalui program sosial koperasi.</li>'
                . '</ol>',

            'dasarHukum'  => '<ul>'
                . '<li>Undang-Undang Nomor 25 Tahun 1992 tentang Perkoperasian.</li>'
                . '<li>Undang-Undang Nomor 11 Tahun 2020 tentang Cipta Kerja (Klaster Koperasi dan UMKM).</li>'
                . '<li>Peraturan Pemerintah Nomor 7 Tahun 2021 tentang Kemudahan, Pelindungan, dan Pemberdayaan Koperasi dan Usaha Mikro, Kecil, dan Menengah.</li>'
                . '<li>Peraturan Menteri Koperasi dan UKM Nomor 9 Tahun 2018 tentang Penyelenggaraan dan Pembinaan Perkoperasian.</li>'
                . '<li>Anggaran Dasar dan Anggaran Rumah Tangga Koperasi Merah Putih.</li>'
                . '<li>Nomor Badan Hukum: 503/BH/XII/2008 — Dinas Koperasi Pemerintah Provinsi DKI Jakarta.</li>'
                . '</ul>',
        ]);
    }
}
