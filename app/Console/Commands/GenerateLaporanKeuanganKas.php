<?php

namespace App\Console\Commands;

use App\Models\KeuanganKas;
use Illuminate\Console\Command;

class GenerateLaporanKeuanganKas extends Command
{
    protected $signature = 'laporan:keuangan-kas {--tanggal_mulai= : Tanggal mulai (YYYY-MM-DD)} {--tanggal_akhir= : Tanggal akhir (YYYY-MM-DD)} {--nomor_anggota= : Nomor anggota} {--format=table : Format output (table, csv, json)}';

    protected $description = 'Generate laporan keuangan kas dengan format tertentu';

    public function handle()
    {
        $query = KeuanganKas::query();

        if ($this->option('tanggal_mulai')) {
            $query->whereDate('tanggalBayar', '>=', $this->option('tanggal_mulai'));
        }

        if ($this->option('tanggal_akhir')) {
            $query->whereDate('tanggalBayar', '<=', $this->option('tanggal_akhir'));
        }

        if ($this->option('nomor_anggota')) {
            $query->where('nomorAnggota', $this->option('nomor_anggota'));
        }

        $data = $query->orderBy('tanggalBayar')->get();

        if ($data->isEmpty()) {
            $this->warn('Tidak ada data keuangan kas yang ditemukan.');
            return;
        }

        $format = $this->option('format');

        if ($format === 'csv') {
            $this->exportToCSV($data);
        } elseif ($format === 'json') {
            $this->exportToJSON($data);
        } else {
            $this->displayTable($data);
        }
    }

    private function displayTable($data)
    {
        $tableData = [];
        $totalSimpananWajib = 0;
        $totalSimpananPokok = 0;

        foreach ($data as $item) {
            $totalSimpanan = $item->simpananPokok + $item->simpananWajib;
            $totalSimpananWajib += $item->simpananWajib;
            $totalSimpananPokok += $item->simpananPokok;

            $tableData[] = [
                'nomorAnggota' => $item->nomorAnggota,
                'namaAnggota' => $item->namaAnggota,
                'simpananWajib' => 'Rp ' . number_format($item->simpananWajib, 0, ',', '.'),
                'totalSimpanan' => 'Rp ' . number_format($totalSimpanan, 0, ',', '.'),
                'tanggalBayar' => $item->tanggalBayar->format('d/m/Y'),
                'keterangan' => $item->keterangan ?? '-',
            ];
        }

        $this->table(
            ['Nomor Anggota', 'Nama Anggota', 'Simpanan Wajib', 'Total Simpanan', 'Tanggal Bayar', 'Keterangan'],
            $tableData
        );

        $this->info('');
        $this->info('=== RINGKASAN ===');
        $this->info('Total Simpanan Wajib  : Rp ' . number_format($totalSimpananWajib, 0, ',', '.'));
        $this->info('Total Simpanan Pokok  : Rp ' . number_format($totalSimpananPokok, 0, ',', '.'));
        $this->info('Total Keseluruhan     : Rp ' . number_format($totalSimpananWajib + $totalSimpananPokok, 0, ',', '.'));
    }

    private function exportToCSV($data)
    {
        $filename = 'laporan_keuangan_kas_' . now()->format('Y-m-d_H-i-s') . '.csv';
        $filepath = storage_path('app/exports/' . $filename);

        if (!is_dir(dirname($filepath))) {
            mkdir(dirname($filepath), 0755, true);
        }

        $file = fopen($filepath, 'w');

        fputcsv($file, ['Nomor Anggota', 'Nama Anggota', 'Simpanan Wajib', 'Total Simpanan', 'Tanggal Bayar', 'Keterangan']);

        $totalSimpananWajib = 0;
        $totalSimpananPokok = 0;

        foreach ($data as $item) {
            $totalSimpanan = $item->simpananPokok + $item->simpananWajib;
            $totalSimpananWajib += $item->simpananWajib;
            $totalSimpananPokok += $item->simpananPokok;

            fputcsv($file, [
                $item->nomorAnggota,
                $item->namaAnggota,
                $item->simpananWajib,
                $totalSimpanan,
                $item->tanggalBayar->format('d/m/Y'),
                $item->keterangan ?? '-',
            ]);
        }

        fputcsv($file, []);
        fputcsv($file, ['RINGKASAN']);
        fputcsv($file, ['Total Simpanan Wajib', $totalSimpananWajib]);
        fputcsv($file, ['Total Simpanan Pokok', $totalSimpananPokok]);
        fputcsv($file, ['Total Keseluruhan', $totalSimpananWajib + $totalSimpananPokok]);

        fclose($file);

        $this->info('Laporan berhasil diekspor ke: ' . $filepath);
    }

    private function exportToJSON($data)
    {
        $jsonData = [];
        $totalSimpananWajib = 0;
        $totalSimpananPokok = 0;

        foreach ($data as $item) {
            $totalSimpanan = $item->simpananPokok + $item->simpananWajib;
            $totalSimpananWajib += $item->simpananWajib;
            $totalSimpananPokok += $item->simpananPokok;

            $jsonData[] = [
                'nomorAnggota' => $item->nomorAnggota,
                'namaAnggota' => $item->namaAnggota,
                'simpananWajib' => $item->simpananWajib,
                'totalSimpanan' => $totalSimpanan,
                'tanggalBayar' => $item->tanggalBayar->format('Y-m-d'),
                'keterangan' => $item->keterangan,
            ];
        }

        $filename = 'laporan_keuangan_kas_' . now()->format('Y-m-d_H-i-s') . '.json';
        $filepath = storage_path('app/exports/' . $filename);

        if (!is_dir(dirname($filepath))) {
            mkdir(dirname($filepath), 0755, true);
        }

        file_put_contents($filepath, json_encode([
            'laporan' => $jsonData,
            'ringkasan' => [
                'totalSimpananWajib' => $totalSimpananWajib,
                'totalSimpananPokok' => $totalSimpananPokok,
                'totalKeseluruhan' => $totalSimpananWajib + $totalSimpananPokok,
            ],
            'generatedAt' => now()->toIso8601String(),
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        $this->info('Laporan berhasil diekspor ke: ' . $filepath);
    }
}
