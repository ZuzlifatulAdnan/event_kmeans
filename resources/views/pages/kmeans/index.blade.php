@extends('layouts.app')

@section('title', 'KMeans UMKM')

@section('main')
    <div class="main-content">
        <div class="section-body">
            @include('layouts.alert')

            <!-- Tabel Peringkat UMKM -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Peringkat UMKM Berdasarkan Keikutsertaan</h4>
                    <a href="{{ route('kmeans.export.keikutsertaan') }}" class="btn btn-success btn-icon icon-left">
                        <i class="fas fa-file-excel"></i> Export Peringkat UMKM
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-peringkat" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama UMKM</th>
                                    <th>Jumlah Ikut</th>
                                    <th>Tahun Bergabung</th>
                                    <th>Kategori</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($umkm_data as $index => $umkm)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $umkm->nama_umkm }}</td>
                                        <td>{{ $umkm->jumlah_ikut }}</td>
                                        <td>{{ $umkm->tahun_bergabung }}</td>
                                        <td>
                                            @if ($umkm->jumlah_ikut >= 10)
                                                <span class="badge badge-warning">Gold</span>
                                            @elseif ($umkm->jumlah_ikut >= 4)
                                                <span class="badge badge-secondary">Silver</span>
                                            @elseif ($umkm->jumlah_ikut >= 1)
                                                <span class="badge"
                                                    style="background-color: #cd7f32; color: white;">Bronze</span>
                                            @else
                                                <span class="badge badge-light">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Hasil Clustering -->
            @if (count($clusters))
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Hasil Clustering KMeans</h4>
                        <a href="{{ route('kmeans.export.clustering') }}" class="btn btn-info btn-icon icon-left">
                            <i class="fas fa-project-diagram"></i> Export Hasil Clustering
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($clusters as $key => $group)
                                <div class="col-md-12">
                                    <div class="card mb-3">
                                        <div class="card-header bg-primary text-white">
                                            <h5 class="mb-0">Cluster {{ $key }}</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped cluster-table">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama UMKM</th>
                                                            <th>Jumlah Ikut</th>
                                                            <th>Tahun Bergabung</th>
                                                            <th>Kategori</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($group as $i => $item)
                                                            <tr>
                                                                <td>{{ $i + 1 }}</td>
                                                                <td>{{ $item->nama_umkm }}</td>
                                                                <td>{{ $item->jumlah_ikut }}</td>
                                                                <td>{{ $item->tahun_bergabung }}</td>
                                                                <td>
                                                                    @if ($item->jumlah_ikut >= 10)
                                                                        <span class="badge badge-warning">Gold</span>
                                                                    @elseif ($item->jumlah_ikut >= 4)
                                                                        <span class="badge badge-secondary">Silver</span>
                                                                    @elseif ($item->jumlah_ikut >= 1)
                                                                        <span class="badge"
                                                                            style="background-color: #cd7f32; color: white;">Bronze</span>
                                                                    @else
                                                                        <span class="badge badge-light">-</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Tabel Centroid Otomatis -->
            @if (!empty($centroids))
                <div class="card">
                    <div class="card-header">
                        <h4>Centroid Otomatis</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>Cluster</th>
                                    <th>Rata-rata Jumlah Ikut</th>
                                    <th>Rata-rata Tahun Bergabung</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($centroids as $index => $centroid)
                                    <tr>
                                        <td>Cluster {{ $index + 1 }}</td>
                                        <td>{{ $centroid[0] }}</td>
                                        <td>{{ $centroid[1] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table-peringkat').DataTable();
            $('.cluster-table').DataTable();
        });
    </script>
@endpush
