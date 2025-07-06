<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q;

        $umkms = DB::table('umkms')
            ->select('nama_umkm', 'nama_pemilik', DB::raw('COUNT(*) as jumlah'))
            ->when($q, function ($query) use ($q) {
                $query->where(function ($q2) use ($q) {
                    $q2->where('nama_umkm', 'like', "%$q%")
                        ->orWhere('nama_pemilik', 'like', "%$q%");
                });
            })
            ->groupBy('nama_umkm', 'nama_pemilik')
            ->orderByDesc('jumlah')
            ->get()
            ->map(function ($item) {
                if ($item->jumlah >= 10) {
                    $item->peringkat = 'Gold';
                } elseif ($item->jumlah >= 4) {
                    $item->peringkat = 'Silver';
                } else {
                    $item->peringkat = 'Bronze';
                }
                return $item;
            });

        return view('pages.dashboard.index', compact('umkms'));
    }
}
