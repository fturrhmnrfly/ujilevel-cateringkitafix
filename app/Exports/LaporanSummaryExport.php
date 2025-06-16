<?php

namespace App\Exports;

use App\Models\Laporan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class LaporanSummaryExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths
{
    public function collection()
    {
        // ✅ HITUNG SUMMARY DATA DARI DATABASE ✅
        $totalPemasukan = Laporan::where('jenis_laporan', 'pemasukan')->sum('total');
        $totalPengeluaran = Laporan::where('jenis_laporan', 'pengeluaran')->sum('total');
        $labaBersih = $totalPemasukan - $totalPengeluaran;
        
        // ✅ FORMAT DATA UNTUK EXCEL ✅
        return collect([
            [
                'Ringkasan Keuangan',
                'Rp ' . number_format($totalPemasukan, 0, ',', '.'),
                Carbon::now()->format('d/m/Y H:i')
            ],
            [
                'Total Pemasukan',
                'Rp ' . number_format($totalPemasukan, 0, ',', '.'),
                'Periode: Semua waktu'
            ],
            [
                'Total Pengeluaran', 
                'Rp ' . number_format($totalPengeluaran, 0, ',', '.'),
                'Periode: Semua waktu'
            ],
            [
                'Laba Bersih',
                'Rp ' . number_format($labaBersih, 0, ',', '.'),
                $labaBersih >= 0 ? 'Profit' : 'Loss'
            ],
            [
                '', '', ''
            ],
            [
                'Detail Laporan:',
                '',
                ''
            ],
            [
                'Total Laporan Pemasukan',
                Laporan::where('jenis_laporan', 'pemasukan')->count() . ' laporan',
                ''
            ],
            [
                'Total Laporan Pengeluaran',
                Laporan::where('jenis_laporan', 'pengeluaran')->count() . ' laporan',
                ''
            ],
            [
                'Laporan Terakhir',
                Laporan::latest('tanggal')->first()?->laporan ?? 'Belum ada',
                Laporan::latest('tanggal')->first()?->tanggal?->format('d/m/Y') ?? '-'
            ]
        ]);
    }

    public function headings(): array
    {
        return [
            'Keterangan',
            'Jumlah',
            'Detail'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // ✅ STYLE HEADER ✅
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 14,
                    'color' => ['rgb' => 'FFFFFF']
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4CAF50']
                ]
            ],
            
            // ✅ STYLE ROW SUMMARY ✅
            2 => [
                'font' => ['bold' => true, 'size' => 12],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'E8F5E8']
                ]
            ],
            3 => [
                'font' => ['bold' => true, 'size' => 12],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'E8F5E8']
                ]
            ],
            4 => [
                'font' => ['bold' => true, 'size' => 12],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'FFE8E8']
                ]
            ],
            5 => [
                'font' => ['bold' => true, 'size' => 12],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'FFF8E1']
                ]
            ],
            
            // ✅ STYLE DETAIL SECTION ✅
            7 => [
                'font' => ['bold' => true, 'size' => 11],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F0F0F0']
                ]
            ]
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 25,
            'B' => 20,
            'C' => 20,
        ];
    }
}