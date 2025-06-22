<?php

namespace App\Imports;

use App\Models\umkm;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UmkmImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new umkm([
            'nama_umkm' => $row['nama_umkm'],
            'nama_pemilik' => $row['nama_pemilik'],
            'tahun_bergabung' => $row['tahun_bergabung'],
            'jenis_umkm' => $row['jenis_umkm'],
            'nama_event' => $row['nama_event'],
            'username_instagram' => $row['username_instagram'],
        ]);
    }
}
