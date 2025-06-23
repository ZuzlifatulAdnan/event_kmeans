@extends('layouts.app')

@section('title', 'Beranda')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Selamat Datang, {{ Auth::user()->name }} di EVENT KMEANS</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <!-- Total User -->
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

                    <!-- Total UMKM -->
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

                    <!-- Bronze -->
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

                    <!-- Silver -->
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

                    <!-- Gold -->
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

                {{-- Daftar UMKM Per Kategori --}}
                <div class="row mt-5">
                    <!-- Bronze List -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header bg-warning">
                                <h4 class="text-dark m-0">Bronze (2x Keikutsertaan)</h4>
                            </div>
                            <div class="card-body">
                                @forelse($bronzeList as $umkm)
                                    <p>- {{ $umkm }}</p>
                                @empty
                                    <p>Tidak ada UMKM</p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <!-- Silver List -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header bg-secondary">
                                <h4 class="text-dark m-0">Silver (3x Keikutsertaan)</h4>
                            </div>
                            <div class="card-body">
                                @forelse($silverList as $umkm)
                                    <p>- {{ $umkm }}</p>
                                @empty
                                    <p>Tidak ada UMKM</p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <!-- Gold List -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header bg-success">
                                <h4 class="text-dark m-0">Gold (5x+ Keikutsertaan)</h4>
                            </div>
                            <div class="card-body">
                                @forelse($goldList as $umkm)
                                    <p>- {{ $umkm }}</p>
                                @empty
                                    <p>Tidak ada UMKM</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
