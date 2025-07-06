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
        [$umkm_data, $clusters, $centroids] = $this->clusterData();

        return view('pages.kmeans.index', compact(
            'type_menu',
            'umkm_data',
            'clusters',
            'centroids'
        ));
    }

    public function exportKeikutsertaan()
    {
        return Excel::download(new KeikutsertaanExport, 'keikutsertaan_umkm.xlsx');
    }

    public function exportClustering()
    {
        [, $clusters,] = $this->clusterData();

        return Excel::download(new ClusteringExport($clusters), 'hasil_clustering_umkm.xlsx');
    }

    private function clusterData()
    {
        $umkm_data = Umkm::select(
            'nama_umkm',
            \DB::raw('COUNT(*) as jumlah_ikut'),
            \DB::raw('MIN(tahun_bergabung) as tahun_bergabung')
        )
            ->groupBy('nama_umkm')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        if ($umkm_data->isEmpty()) {
            return [collect(), [], []];
        }

        $data = $umkm_data->map(fn($u) => [(int) $u->jumlah_ikut, (int) $u->tahun_bergabung])->toArray();
        $dataset = Unlabeled::build($data);

        $k = count($data) >= 3 ? 3 : count($data);

        $kmeans = new KMeans($k);
        $kmeans->train($dataset);
        $predicted = $kmeans->predict($dataset);

        $grouped = array_fill(0, $k, []);

        foreach ($predicted as $i => $cluster) {
            $umkm_data[$i]->cluster = $cluster + 1;

            // Hitung peringkat
            if ($umkm_data[$i]->jumlah_ikut >= 10) {
                $umkm_data[$i]->peringkat = 'Gold';
            } elseif ($umkm_data[$i]->jumlah_ikut >= 4) {
                $umkm_data[$i]->peringkat = 'Silver';
            } else {
                $umkm_data[$i]->peringkat = 'Bronze';
            }

            $grouped[$cluster][] = $data[$i];
        }

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

        $clusters = $umkm_data->groupBy('cluster');

        return [$umkm_data, $clusters, $centroids];
    }
}
