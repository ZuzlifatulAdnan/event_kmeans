<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\FromView;

class ClusteringExport implements FromView
{
    protected $data;

    public function __construct($clusters)
    {
        $this->data = $clusters;
    }

    public function view(): View
    {
        return view('pages.exports.clustering', ['clusters' => $this->data]);
    }
}
