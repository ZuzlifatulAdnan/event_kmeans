@extends('layouts.app')

@section('title', 'Beranda')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Selamat Datang, {{ Auth::user()->name }} di EVENT KMEANS</h1>
            </div>

            <div class="section-body">
                {{-- Statistik --}}
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Jumlah User</h4>
                                </div>
                                <div class="card-body">
                                    {{ $totalUser }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-info">
                                <i class="fas fa-store"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total UMKM</h4>
                                </div>
                                <div class="card-body">
                                    {{ $totalUmkm }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-warning">
                                <i class="fas fa-medal"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Bronze</h4>
                                </div>
                                <div class="card-body">
                                    {{ $bronze }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-secondary">
                                <i class="fas fa-medal"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Silver</h4>
                                </div>
                                <div class="card-body">
                                    {{ $silver }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-success">
                                <i class="fas fa-trophy"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Gold</h4>
                                </div>
                                <div class="card-body">
                                    {{ $gold }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Daftar Bronze–Silver–Gold --}}
                <div class="row mt-5">
                    @foreach ([
            'bronze' => ['list' => $bronzeList, 'color' => 'bg-warning'],
            'silver' => ['list' => $silverList, 'color' => 'bg-secondary'],
            'gold' => ['list' => $goldList, 'color' => 'bg-success'],
        ] as $kategori => $data)
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header {{ $data['color'] }}">
                                    <h4 class="text-dark fw-bold m-0">
                                        {{ ucfirst($kategori) }} ({{ $data['list']->count() }} UMKM)
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>Nama UMKM</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($data['list'] as $umkm)
                                                <tr>
                                                    <td>{{ $umkm->nama_umkm }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td>Tidak ada UMKM</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </section>
    </div>
@endsection
