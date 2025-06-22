<?php

namespace App\Exports;

use App\Models\umkm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UmkmExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Umkm::select(
            'nama_umkm',
            'nama_pemilik',
            'tahun_bergabung',
            'jenis_umkm',
            'nama_event',
            'username_instagram'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Nama UMKM',
            'Nama Pemilik',
            'Tahun Bergabung',
            'Jenis UMKM',
            'Nama Event',
            'Username Instagram',
        ];
    }
}
