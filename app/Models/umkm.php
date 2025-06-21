<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class umkm extends Model
{
      use HasFactory;
    protected $fillable = [
        'nama_umkm',
        'nama_pemilik',
        'tahun_bergabung',
        'jenis_umkm',
        'nama_event',
    ];
}
