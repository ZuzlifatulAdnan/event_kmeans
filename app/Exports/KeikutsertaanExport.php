<?php

namespace App\Exports;

use App\Models\Umkm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class KeikutsertaanExport implements FromView
{
    public function view(): View
    {
        $umkm_data = Umkm::select(
            'nama_umkm',
            \DB::raw('COUNT(*) as jumlah_ikut'),
            \DB::raw('MIN(tahun_bergabung) as tahun_bergabung')
        )
            ->groupBy('nama_umkm')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        foreach ($umkm_data as $umkm) {
            if ($umkm->jumlah_ikut >= 10) {
                $umkm->peringkat = 'Gold';
            } elseif ($umkm->jumlah_ikut >= 4) {
                $umkm->peringkat = 'Silver';
            } else {
                $umkm->peringkat = 'Bronze';
            }
        }

        return view('pages.exports.keikutsertaan', compact('umkm_data'));
    }
}
