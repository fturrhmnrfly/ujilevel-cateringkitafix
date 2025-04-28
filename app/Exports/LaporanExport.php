<?php

namespace App\Exports;

use App\Models\Laporan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Laporan::select(
            'laporan',
            'jenis_laporan',
            'tanggal',
            'admin',
            'deskripsi',
            'status'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Laporan',
            'Jenis Laporan', 
            'Tanggal',
            'Admin',
            'Deskripsi',
            'Status'
        ];
    }
}
