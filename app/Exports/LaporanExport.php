<?php

namespace App\Exports;

use App\Models\Laporan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Events\AfterSheet; // ✅ TAMBAHKAN INI ✅
use Maatwebsite\Excel\Concerns\WithEvents; // ✅ TAMBAHKAN INI ✅
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Carbon\Carbon;

class LaporanExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths, WithTitle, WithCustomStartCell, WithEvents
{
    public function collection()
    {
        return Laporan::select(
            'laporan',
            'jenis_laporan',
            'tanggal',
            'total',
            'admin',
            'deskripsi'
        )->orderBy('tanggal', 'desc')->get()->map(function ($laporan) {
            return [
                'laporan' => $laporan->laporan,
                'jenis_laporan' => ucfirst($laporan->jenis_laporan),
                'tanggal' => Carbon::parse($laporan->tanggal)->format('d/m/Y'),
                'total' => 'Rp ' . number_format($laporan->total, 0, ',', '.'),
                'admin' => $laporan->admin ?? 'System',
                'deskripsi' => $laporan->deskripsi ?? '-'
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama Laporan',
            'Jenis Laporan',
            'Tanggal',
            'Jumlah (Rp)',
            'Admin',
            'Deskripsi'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $data = $this->collection();
        $rowCount = $data->count();
        $lastRow = $rowCount + 4; // Start cell A3 + header + data

        return [
            // ✅ STYLE JUDUL UTAMA (A1) ✅
            'A1' => [
                'font' => [
                    'bold' => true,
                    'size' => 18,
                    'color' => ['rgb' => 'FFFFFF']
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '2c2c77']
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER
                ]
            ],

            // ✅ STYLE HEADER TABEL (A3:F3) ✅
            'A3:F3' => [
                'font' => [
                    'bold' => true,
                    'size' => 12,
                    'color' => ['rgb' => 'FFFFFF']
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'D2B48C']
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_MEDIUM,
                        'color' => ['rgb' => '000000']
                    ]
                ]
            ],

            // ✅ STYLE DATA ROWS (A4:F{lastRow}) ✅
            "A4:F{$lastRow}" => [
                'font' => [
                    'size' => 11
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => 'CCCCCC']
                    ]
                ]
            ],

            // ✅ STYLE KHUSUS UNTUK KOLOM JENIS LAPORAN ✅
            "B4:B{$lastRow}" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER
                ]
            ],

            // ✅ STYLE KHUSUS UNTUK KOLOM TANGGAL ✅
            "C4:C{$lastRow}" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER
                ]
            ],

            // ✅ STYLE KHUSUS UNTUK KOLOM JUMLAH ✅
            "D4:D{$lastRow}" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_RIGHT
                ],
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => '2c2c77']
                ]
            ],

            // ✅ ALTERNATING ROW COLORS (ZEBRA STRIPE) ✅
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 30, // Nama Laporan
            'B' => 15, // Jenis Laporan
            'C' => 12, // Tanggal
            'D' => 18, // Jumlah
            'E' => 15, // Admin
            'F' => 35, // Deskripsi
        ];
    }

    public function title(): string
    {
        return 'Laporan Detail';
    }

    public function startCell(): string
    {
        return 'A3'; // Data dimulai dari A3
    }

    /**
     * Tambahkan method untuk setup worksheet
     */
    public function prepareRows($rows)
    {
        // Method ini akan dipanggil setelah data dimasukkan
        return $rows;
    }

    /**
     * Method untuk menambahkan custom content
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                
                // ✅ TAMBAHKAN JUDUL UTAMA ✅
                $sheet->setCellValue('A1', 'LAPORAN KEUANGAN DETAIL - CATERING KITA');
                $sheet->mergeCells('A1:F1');
                
                // ✅ TAMBAHKAN INFORMASI TANGGAL EXPORT ✅
                $sheet->setCellValue('A2', 'Exported on: ' . Carbon::now()->format('d F Y, H:i:s'));
                $sheet->mergeCells('A2:F2');
                $sheet->getStyle('A2')->applyFromArray([
                    'font' => [
                        'italic' => true,
                        'size' => 10,
                        'color' => ['rgb' => '666666']
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER
                    ]
                ]);

                // ✅ TAMBAHKAN ZEBRA STRIPING ✅
                $data = $this->collection();
                $rowCount = $data->count();
                
                for ($i = 4; $i <= $rowCount + 3; $i++) {
                    if (($i - 4) % 2 == 1) { // Baris ganjil (0-indexed)
                        $sheet->getStyle("A{$i}:F{$i}")->applyFromArray([
                            'fill' => [
                                'fillType' => Fill::FILL_SOLID,
                                'startColor' => ['rgb' => 'F8F9FA']
                            ]
                        ]);
                    }
                }

                // ✅ HIGHLIGHT PEMASUKAN DAN PENGELUARAN ✅
                for ($i = 4; $i <= $rowCount + 3; $i++) {
                    $jenisValue = $sheet->getCell("B{$i}")->getValue();
                    
                    if (strtolower($jenisValue) === 'pemasukan') {
                        $sheet->getStyle("B{$i}")->applyFromArray([
                            'fill' => [
                                'fillType' => Fill::FILL_SOLID,
                                'startColor' => ['rgb' => 'D4EDDA']
                            ],
                            'font' => [
                                'color' => ['rgb' => '155724'],
                                'bold' => true
                            ]
                        ]);
                    } elseif (strtolower($jenisValue) === 'pengeluaran') {
                        $sheet->getStyle("B{$i}")->applyFromArray([
                            'fill' => [
                                'fillType' => Fill::FILL_SOLID,
                                'startColor' => ['rgb' => 'F8D7DA']
                            ],
                            'font' => [
                                'color' => ['rgb' => '721C24'],
                                'bold' => true
                            ]
                        ]);
                    }
                }

                // ✅ TAMBAHKAN SUMMARY DI BAWAH TABEL ✅
                $summaryRow = $rowCount + 5;
                
                // Hitung total pemasukan dan pengeluaran
                $laporans = Laporan::all();
                $totalPemasukan = $laporans->where('jenis_laporan', 'pemasukan')->sum('total');
                $totalPengeluaran = $laporans->where('jenis_laporan', 'pengeluaran')->sum('total');
                $labaBersih = $totalPemasukan - $totalPengeluaran;

                // Summary header
                $sheet->setCellValue("A{$summaryRow}", 'RINGKASAN KEUANGAN');
                $sheet->mergeCells("A{$summaryRow}:F{$summaryRow}");
                $sheet->getStyle("A{$summaryRow}")->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                        'color' => ['rgb' => 'FFFFFF']
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '2c2c77']
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER
                    ]
                ]);

                // Summary data
                $summaryRow++;
                $sheet->setCellValue("A{$summaryRow}", 'Total Pemasukan');
                $sheet->setCellValue("D{$summaryRow}", 'Rp ' . number_format($totalPemasukan, 0, ',', '.'));
                
                $summaryRow++;
                $sheet->setCellValue("A{$summaryRow}", 'Total Pengeluaran');
                $sheet->setCellValue("D{$summaryRow}", 'Rp ' . number_format($totalPengeluaran, 0, ',', '.'));
                
                $summaryRow++;
                $sheet->setCellValue("A{$summaryRow}", 'Laba Bersih');
                $sheet->setCellValue("D{$summaryRow}", 'Rp ' . number_format($labaBersih, 0, ',', '.'));

                // Style summary
                $summaryStartRow = $rowCount + 6;
                $summaryEndRow = $rowCount + 8;
                $sheet->getStyle("A{$summaryStartRow}:D{$summaryEndRow}")->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_MEDIUM,
                            'color' => ['rgb' => '000000']
                        ]
                    ]
                ]);

                // Color code summary values
                $sheet->getStyle("D{$summaryStartRow}")->getFont()->getColor()->setRGB('28a745'); // Green for income
                $sheet->getStyle("D" . ($summaryStartRow + 1))->getFont()->getColor()->setRGB('dc3545'); // Red for expense
                $sheet->getStyle("D" . ($summaryStartRow + 2))->getFont()->getColor()->setRGB($labaBersih >= 0 ? '28a745' : 'dc3545'); // Green/Red for profit

                // ✅ AUTO-FIT ROW HEIGHTS ✅
                foreach ($sheet->getRowIterator() as $row) {
                    $sheet->getRowDimension($row->getRowIndex())->setRowHeight(-1);
                }

                // ✅ FREEZE HEADER ROWS ✅
                $sheet->freezePane('A4');
            }
        ];
    }
}
