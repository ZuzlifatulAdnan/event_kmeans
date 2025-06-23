<?php

namespace App\Http\Controllers;

use App\Exports\ClusteringExport;
use App\Exports\KeikutsertaanExport;
use App\Models\umkm;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Rubix\ML\Clusterers\KMeans;
use Rubix\ML\Datasets\Unlabeled;

class KmeansController extends Controller
{
    public function index()
    {
        $type_menu = 'kmeans';

        // Ambil UMKM yang ikut lebih dari 1 kali
        $umkm_data = Umkm::select(
            'nama_umkm',
            \DB::raw('COUNT(*) as jumlah_ikut'),
            \DB::raw('MIN(tahun_bergabung) as tahun_bergabung')
        )
            ->groupBy('nama_umkm')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        $clusters = [];
        $centroids = [];
        $data = [];

        if ($umkm_data->count() > 0) {
            $data = $umkm_data->map(fn($u) => [(int) $u->jumlah_ikut, (int) $u->tahun_bergabung])->toArray();
            $dataset = Unlabeled::build($data);

            $jumlah_data = count($data);
            $jumlah_cluster = $jumlah_data >= 3 ? 3 : $jumlah_data;

            $kmeans = new KMeans($jumlah_cluster);
            $kmeans->train($dataset);
            $predicted = $kmeans->predict($dataset);

            $grouped = array_fill(0, $jumlah_cluster, []);
            foreach ($predicted as $i => $cluster) {
                $umkm_data[$i]->cluster = $cluster + 1;
                $grouped[$cluster][] = $data[$i];
            }

            // Hitung centroid dari data setiap cluster
            $centroids = array_map(function ($group) {
                $count = count($group);
                $sums = [0, 0];
                foreach ($group as $item) {
                    $sums[0] += $item[0];
                    $sums[1] += $item[1];
                }
                return [
                    round($sums[0] / $count, 2),
                    round($sums[1] / $count, 2)
                ];
            }, $grouped);

            $clusters = collect($umkm_data)->groupBy('cluster');
        }

        return view('pages.kmeans.index', compact('type_menu', 'umkm_data', 'clusters', 'centroids'));
    }

    public function updateCentroid(Request $request)
    {
        $request->validate([
            'centroids' => 'required|array|min:3',
            'centroids.*.0' => 'required|numeric',
            'centroids.*.1' => 'required|numeric',
        ]);

        session(['centroids' => $request->input('centroids')]);
        return back()->with('success', 'Centroid berhasil diperbarui (manual).');
    }

    public function resetCentroid()
    {
        session()->forget('centroids');
        return back()->with('success', 'Centroid manual berhasil direset.');
    }
    public function exportKeikutsertaan()
    {
        return Excel::download(new KeikutsertaanExport, 'keikutsertaan_umkm.xlsx');
    }

    public function exportClustering()
    {
        // Ambil data clustering seperti di index()
        $umkm_data = \App\Models\Umkm::select(
            'nama_umkm',
            \DB::raw('COUNT(*) as jumlah_ikut'),
            \DB::raw('MIN(tahun_bergabung) as tahun_bergabung')
        )
            ->groupBy('nama_umkm')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        $data = $umkm_data->map(fn($u) => [(int) $u->jumlah_ikut, (int) $u->tahun_bergabung])->toArray();
        $dataset = \Rubix\ML\Datasets\Unlabeled::build($data);

        $k = count($data) >= 3 ? 3 : count($data);
        $kmeans = new \Rubix\ML\Clusterers\KMeans($k);
        $kmeans->train($dataset);
        $predicted = $kmeans->predict($dataset);

        foreach ($predicted as $i => $cluster) {
            $umkm_data[$i]->cluster = $cluster + 1;
        }

        $clusters = collect($umkm_data)->groupBy('cluster');

        return Excel::download(new ClusteringExport($clusters), 'hasil_clustering_umkm.xlsx');
    }
}
