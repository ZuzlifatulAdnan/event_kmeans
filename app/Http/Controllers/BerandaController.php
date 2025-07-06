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

        // Hitung & Ambil nama_umkm dengan jumlah partisipasi & id terbaru
        $umkmCounts = Umkm::select('nama_umkm', DB::raw('COUNT(*) as jumlah'), DB::raw('MAX(id) as latest_id'))
            ->groupBy('nama_umkm')
            ->orderByDesc('latest_id')
            ->get();

        // Hitung jumlah kategori
        $bronze = $umkmCounts->whereBetween('jumlah', [1,3])->count();
        $silver = $umkmCounts->whereBetween('jumlah', [4,9])->count();
        $gold   = $umkmCounts->where('jumlah', '>=', 10)->count();

        // Ambil list maksimal 10 terbaru per kategori
        $bronzeList = $umkmCounts
            ->whereBetween('jumlah', [1,3])
            ->sortByDesc('latest_id')
            ->take(10);

        $silverList = $umkmCounts
            ->whereBetween('jumlah', [4,9])
            ->sortByDesc('latest_id')
            ->take(10);

        $goldList = $umkmCounts
            ->where('jumlah', '>=', 10)
            ->sortByDesc('latest_id')
            ->take(10);

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
