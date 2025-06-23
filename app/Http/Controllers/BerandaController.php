<?php

namespace App\Http\Controllers;

use App\Models\umkm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BerandaController extends Controller
{
    public function index(Request $request)
    {
        $type_menu = 'beranda';

        $totalUser = User::count();

        $totalUmkm = Umkm::select('nama_umkm')->distinct()->count();

        $umkmCounts = Umkm::select('nama_umkm', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('nama_umkm')
            ->get();

        $bronze = $umkmCounts->where('jumlah', 2)->count();
        $silver = $umkmCounts->where('jumlah', 3)->count();
        $gold = $umkmCounts->where('jumlah', '>=', 5)->count();

        // Ambil nama_umkm per kategori
        $bronzeList = $umkmCounts->where('jumlah', 2)->pluck('nama_umkm');
        $silverList = $umkmCounts->where('jumlah', 3)->pluck('nama_umkm');
        $goldList = $umkmCounts->where('jumlah', '>=', 5)->pluck('nama_umkm');

        return view('pages.beranda.index', compact(
            'type_menu',
            'totalUser',
            'totalUmkm',
            'bronze',
            'silver',
            'gold',
            'bronzeList',
            'silverList',
            'goldList'
        ));
    }
}
