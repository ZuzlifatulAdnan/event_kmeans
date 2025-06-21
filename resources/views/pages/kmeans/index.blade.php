@extends('layouts.app')

@section('title', 'KMeans Clustering')

@section('main')
    <div class="main-content">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="col-12">
                        <!-- Filter Bulan dan Tahun -->
                        <div class="card">
                            <div class="card-header">
                                <h4>Filter Perhitungan K-Means</h4>
                            </div>
                            <div class="card-body">
                                <form method="GET" action="{{ route('kmeans.index') }}">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label for="bulan">Pilih Bulan:</label>
                                            <select name="bulan" id="bulan" class="form-control">
                                                <option value="">-- Semua Bulan --</option>
                                                @foreach ($months as $key => $month)
                                                    <option value="{{ $key }}"
                                                        {{ request('bulan') == $key ? 'selected' : '' }}>
                                                        {{ $month }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-5">
                                            <label for="tahun">Pilih Tahun:</label>
                                            <select name="tahun" id="tahun" class="form-control">
                                                <option value="">-- Semua Tahun --</option>
                                                @foreach ($years as $year)
                                                    <option value="{{ $year }}"
                                                        {{ request('tahun') == $year ? 'selected' : '' }}>
                                                        {{ $year }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label>&nbsp;</label>
                                            <button type="submit" class="btn btn-primary btn-block">Filter</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- CARD EDIT CENTROID -->
                        <div class="card">
                            <div class="card-header">
                                <h4>Edit Centroid</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('kmeans.updateCentroid') }}">
                                    @csrf
                                    <div class="row">
                                        @foreach ($centroids as $index => $centroid)
                                            <div class="col-md-4">
                                                <label for="centroid{{ $index }}">Centroid
                                                    {{ $index + 1 }}</label>
                                                <input type="number" step="0.01" class="form-control" name="centroids[]"
                                                    value="{{ $centroid }}">
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12 text-right">
                                            <button type="submit" class="btn btn-primary">Update Centroids</button>
                                            <a href="{{ route('kmeans.create') }}" class="btn btn-warning">Reset
                                                Centroids</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- TOMBOL EXPORT DATA -->
                        <div class="text-right mb-3">
                            <button class="btn btn-success" data-toggle="modal" data-target="#exportModal">Export
                                Data</button>
                        </div>

                        <!-- Modal Export -->
                        <div class="modal fade" id="exportModal" tabindex="-1" role="dialog"
                            aria-labelledby="exportModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exportModalLabel">Pilih Bulan, Tahun dan Centroids untuk
                                            Export</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('export.index') }}" method="GET">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="bulan">Pilih Bulan:</label>
                                                <select name="bulan" id="bulan" class="form-control">
                                                    @foreach ($months as $key => $month)
                                                        <option value="{{ $key }}"
                                                            {{ $bulan == $key ? 'selected' : '' }}>{{ $month }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="tahun">Pilih Tahun:</label>
                                                <select name="tahun" id="tahun" class="form-control">
                                                    @foreach ($years as $year)
                                                        <option value="{{ $year }}"
                                                            {{ $tahun == $year ? 'selected' : '' }}>{{ $year }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Tambahkan Input untuk Centroids -->
                                            <div class="form-group">
                                                <label for="centroids">Masukkan Centroids:</label>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <input type="number" name="centroid_1" class="form-control"
                                                            placeholder="Centroid 1"
                                                            value="{{ old('centroid_1', $centroids[0] ?? '') }}"
                                                            step="any">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="number" name="centroid_2" class="form-control"
                                                            placeholder="Centroid 2"
                                                            value="{{ old('centroid_2', $centroids[1] ?? '') }}"
                                                            step="any">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="number" name="centroid_3" class="form-control"
                                                            placeholder="Centroid 3"
                                                            value="{{ old('centroid_3', $centroids[2] ?? '') }}"
                                                            step="any">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Export</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal Export -->

                        <!-- CARD HASIL CLUSTERING -->
                        <div class="card">
                            <div class="card-header">
                                <h4>Perhitungan K-Means Clustering</h4>
                            </div>
                            <div class="card-body">
                                <h5>Centroid Awal</h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Cluster</th>
                                            <th>Nilai Centroid</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($centroids as $index => $centroid)
                                            <tr>
                                                <td>Cluster {{ $index + 1 }}</td>
                                                <td>{{ number_format($centroid, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <h5>Hasil Clustering</h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th>Jumlah Pesanan</th>
                                            <th>Cluster</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order_produks as $produk)
                                            <tr>
                                                <td>{{ $produk->produk->nama }}</td>
                                                <td>{{ $produk->jumlah_pesanan }}</td>
                                                <td>Cluster {{ $produk->cluster }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- DETAIL ITERASI -->
                        <div class="card">
                            <div class="card-header">
                                <h4>Detail Iterasi Clustering</h4>
                            </div>
                            <div class="card-body">
                                @foreach ($clusters as $index => $cluster)
                                    <h5>Cluster {{ $index + 1 }}</h5>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Produk</th>
                                                <th>Jumlah Pesanan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cluster as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $clusterMap[$item[0]]['nama_produk'] ?? 'Tidak Diketahui' }}
                                                    </td>
                                                    <td>{{ $item[0] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endsection
