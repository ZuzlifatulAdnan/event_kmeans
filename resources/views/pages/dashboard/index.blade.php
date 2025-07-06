@extends('layouts.user')

@section('title', 'Dashboard')

@section('main')
    <div class="container-fluid py-5">
        <div class="card shadow-sm mx-auto" style="max-width: 1200px;">
            <div class="card-header bg-primary text-center">
                <h4 class="text-white">Data UMKM</h4>
            </div>
            <div class="card-body">

                {{-- Form Pencarian --}}
                <form action="{{ route('dashboard.index') }}" method="GET" class="mb-4">
                    <div class="input-group input-group-lg">
                        <input type="text" class="form-control" placeholder="Masukkan Nama UMKM atau Nama Pemilik"
                            name="q" value="{{ request('q') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i> Cari
                            </button>
                        </div>
                    </div>
                </form>

                {{-- Hasil Pencarian --}}
                @if (request()->filled('q'))
                    @if ($umkms->count())
                        <div class="row">
                            @foreach ($umkms as $i => $umkm)
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div class="card shadow-sm h-100 border-0">
                                        <div class="card-header bg-light d-flex justify-content-between">
                                            <span
                                                class="badge 
                @if ($umkm->peringkat == 'Gold') bg-warning text-dark
                @elseif($umkm->peringkat == 'Silver') bg-secondary
                @else badge-bronze @endif">
                                                {{ $umkm->peringkat }}
                                            </span>
                                            <small class="text-muted">
                                                <i class="fas fa-users"></i> {{ $umkm->jumlah }}
                                            </small>
                                        </div>
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title text-primary">{{ $umkm->nama_umkm }}</h5>
                                            <p class="card-text text-muted">{{ $umkm->nama_pemilik }}</p>
                                            <div class="mt-auto">
                                                <button class="btn btn-outline-primary btn-sm w-100" data-toggle="modal"
                                                    data-target="#detailModal{{ $i }}">
                                                    <i class="fas fa-eye"></i> Lihat Detail
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Modal Stisla --}}
                                <div class="modal fade" tabindex="-1" role="dialog" id="detailModal{{ $i }}">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title">Detail UMKM</h5>
                                                <button type="button" class="close text-white" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <ul class="list-unstyled">
                                                    <li><strong>Nama UMKM:</strong> {{ $umkm->nama_umkm }}</li>
                                                    <li><strong>Nama Pemilik:</strong> {{ $umkm->nama_pemilik }}</li>
                                                    <li><strong>Jumlah:</strong> {{ $umkm->jumlah }}</li>
                                                    <li><strong>Peringkat:</strong>
                                                        <span
                                                            class="badge 
                @if ($umkm->peringkat == 'Gold') bg-warning text-dark
                @elseif($umkm->peringkat == 'Silver') bg-secondary
                @else badge-bronze @endif">
                                                            {{ $umkm->peringkat }}
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-primary text-center">
                            Tidak ada UMKM ditemukan untuk <strong>"{{ request('q') }}"</strong>.
                        </div>
                    @endif
                @endif

            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .badge-bronze {
            background-color: #cd7f32;
            color: #fff;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: bold;
        }
    </style>
@endpush
