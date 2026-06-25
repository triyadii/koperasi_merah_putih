<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\KeuanganKas;
use Illuminate\Http\Request;

class KeuanganKasController extends Controller
{
    public function index(Request $request)
    {
        $query = KeuanganKas::query();

        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('tanggalBayar', '>=', $request->tanggal_mulai);
        }

        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('tanggalBayar', '<=', $request->tanggal_akhir);
        }

        if ($request->filled('nomorAnggota')) {
            $query->where('nomorAnggota', 'like', '%' . $request->nomorAnggota . '%');
        }

        $keuanganKas = $query->latest('tanggalBayar')->paginate(15);
        $anggotas = Anggota::where('statusAnggota', 'aktif')->get();

        return view('admin.keuangan-kas.index', compact('keuanganKas', 'anggotas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomorAnggota' => 'required|string|max:50',
            'namaAnggota' => 'required|string|max:255',
            'simpananPokok' => 'nullable|integer|min:0',
            'simpananWajib' => 'nullable|integer|min:0',
            'tanggalBayar' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        KeuanganKas::create($request->all());

        return redirect()->route('admin.keuangan-kas.index')->with('success', 'Data keuangan kas berhasil ditambahkan.');
    }

    public function edit(KeuanganKas $keuanganKa)
    {
        return view('admin.keuangan-kas.edit', compact('keuanganKa'));
    }

    public function update(Request $request, KeuanganKas $keuanganKa)
    {
        $request->validate([
            'nomorAnggota' => 'required|string|max:50',
            'namaAnggota' => 'required|string|max:255',
            'simpananPokok' => 'nullable|integer|min:0',
            'simpananWajib' => 'nullable|integer|min:0',
            'tanggalBayar' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $keuanganKa->update($request->all());

        return redirect()->route('admin.keuangan-kas.index')->with('success', 'Data keuangan kas berhasil diperbarui.');
    }

    public function destroy(KeuanganKas $keuanganKa)
    {
        $keuanganKa->delete();
        return redirect()->route('admin.keuangan-kas.index')->with('success', 'Data keuangan kas berhasil dihapus.');
    }

    public function export()
    {
        $query = KeuanganKas::query();

        if (request()->filled('tanggal_mulai')) {
            $query->whereDate('tanggalBayar', '>=', request('tanggal_mulai'));
        }

        if (request()->filled('tanggal_akhir')) {
            $query->whereDate('tanggalBayar', '<=', request('tanggal_akhir'));
        }

        if (request()->filled('nomorAnggota')) {
            $query->where('nomorAnggota', 'like', '%' . request('nomorAnggota') . '%');
        }

        $data = $query->orderBy('tanggalBayar')->get();

        $filename = 'laporan_keuangan_kas_' . date('Y-m-d_H-i-s') . '.xlsx';

        $this->createExcel($data, $filename);

        return response()->download(storage_path('app/exports/' . $filename))->deleteFileAfterSend(true);
    }

    private function createExcel($data, $filename)
    {
        if (!is_dir(storage_path('app/exports'))) {
            mkdir(storage_path('app/exports'), 0755, true);
        }

        $filepath = storage_path('app/exports/' . $filename);

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Laporan Keuangan Kas');
        $sheet->mergeCells('A1:F1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

        $sheet->setCellValue('A2', 'Tanggal: ' . date('d/m/Y H:i:s'));
        $sheet->mergeCells('A2:F2');

        $sheet->setCellValue('A4', 'No. Anggota');
        $sheet->setCellValue('B4', 'Nama Anggota');
        $sheet->setCellValue('C4', 'Simpanan Wajib');
        $sheet->setCellValue('D4', 'Tanggal Bayar');
        $sheet->setCellValue('E4', 'Keterangan');

        $headerStyle = $sheet->getStyle('A4:E4');
        $headerStyle->getFont()->setBold(true)->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE));
        $headerStyle->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF366092');
        $headerStyle->getAlignment()->setHorizontal('center');

        $row = 5;
        $totalSimpananWajib = 0;

        foreach ($data as $item) {
            $totalSimpananWajib += $item->simpananWajib;

            $sheet->setCellValue('A' . $row, $item->nomorAnggota);
            $sheet->setCellValue('B' . $row, $item->namaAnggota);
            $sheet->setCellValue('C' . $row, 'Rp ' . number_format($item->simpananWajib, 0, ',', '.'));
            $sheet->setCellValue('D' . $row, $item->tanggalBayar->format('d/m/Y'));
            $sheet->setCellValue('E' . $row, $item->keterangan ?? '-');

            $sheet->getStyle('C' . $row)->getAlignment()->setHorizontal('right');
            $row++;
        }

        $totalRow = $row + 1;
        $sheet->setCellValue('A' . $totalRow, 'TOTAL');
        $sheet->setCellValue('C' . $totalRow, 'Rp ' . number_format($totalSimpananWajib, 0, ',', '.'));

        $totalStyle = $sheet->getStyle('A' . $totalRow . ':E' . $totalRow);
        $totalStyle->getFont()->setBold(true);
        $totalStyle->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFCCCCCC');
        $sheet->getStyle('C' . $totalRow)->getAlignment()->setHorizontal('right');

        $sheet->getColumnDimension('A')->setWidth(15);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(18);
        $sheet->getColumnDimension('D')->setWidth(15);
        $sheet->getColumnDimension('E')->setWidth(20);

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save($filepath);
    }
}
