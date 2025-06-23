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
        $data = \App\Models\Umkm::select('nama_umkm', \DB::raw('COUNT(*) as jumlah_ikut'), \DB::raw('MIN(tahun_bergabung) as tahun_bergabung'))
            ->groupBy('nama_umkm')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        return view('pages.exports.keikutsertaan', ['umkms' => $data]);
    }
}
