<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\FromView;

class ClusteringExport implements FromView
{
    protected $clusters;

    public function __construct($clusters)
    {
        $this->clusters = $clusters;
    }

    public function view(): View
    {
        $clusters = $this->clusters;

        return view('pages.exports.clustering', compact('clusters'));
    }
}
