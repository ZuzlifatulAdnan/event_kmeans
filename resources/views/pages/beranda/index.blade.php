@extends('layouts.app')

@section('title', 'Beranda')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Selamat Datang! {{ Auth::user()->name }} di POS Calma Kmeans</h1>
            </div>
            <div class="section-body">
                <!-- Filter Bulan dan Tahun -->
                <div class="row mb-4">
                    <div class="col-12">
                        
                    </div>
                </div>

                <!-- Statistik -->
                {{-- <div class="row">
                    <!-- Total User -->
                    @if (Auth::user()->role == 'Admin')
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-primary">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Users') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $totalUser }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                    @endif
                    <!-- Total Produk -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-success">
                                <i class="fas fa-box"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>{{ __('Produk') }}</h4>
                                </div>
                                <div class="card-body">
                                    {{ $totalProduk }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Order -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-warning">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>{{ __('Total Order') }}</h4>
                                </div>
                                <div class="card-body">
                                    {{ $totalOrder }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Harga -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-danger">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>{{ __('Total Harga') }}</h4>
                                </div>
                                <div class="card-body">
                                    Rp {{ $totalHarga }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </section>
    </div>
@endsection
