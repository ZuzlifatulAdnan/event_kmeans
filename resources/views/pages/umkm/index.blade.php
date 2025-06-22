@extends('layouts.app')

@section('title', 'Daftar UMKM')

@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between align-items-center w-100">
                <h1>Daftar UMKM</h1>
                <div>
                    <a href="{{ route('umkm.create') }}" class="btn btn-primary btn-sm mr-2">
                        <i class="fas fa-plus"></i> Tambah Data
                    </a>
                    <a href="{{ route('umkm.export') }}" class="btn btn-success btn-sm mr-2">
                        <i class="fas fa-file-excel"></i> Export
                    </a>
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#importModal">
                        <i class="fas fa-file-import"></i> Import
                    </button>
                </div>
            </div>

            <div class="section-body">
                @include('layouts.alert')

                <div class="card">
                    <div class="card-body">
                        <form method="GET" action="{{ route('umkm.index') }}" class="form-inline mb-4">
                            <div class="form-group mr-2 mb-2">
                                <input type="text" name="nama" value="{{ request('nama') }}" class="form-control"
                                    placeholder="Cari Nama UMKM atau Pemilik...">
                            </div>
                            <button class="btn btn-primary mb-2" type="submit">
                                <i class="fas fa-search"></i> Cari
                            </button>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-md">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama UMKM</th>
                                        <th>Nama Pemilik</th>
                                        <th>Tahun Bergabung</th>
                                        <th>Jenis UMKM</th>
                                        <th>Event</th>
                                        <th>Instagram</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($umkms as $umkm)
                                        <tr>
                                            <td>{{ $loop->iteration + ($umkms->currentPage() - 1) * $umkms->perPage() }}
                                            </td>
                                            <td>{{ $umkm->nama_umkm }}</td>
                                            <td>{{ $umkm->nama_pemilik }}</td>
                                            <td>{{ $umkm->tahun_bergabung }}</td>
                                            <td>{{ $umkm->jenis_umkm }}</td>
                                            <td>{{ $umkm->nama_event }}</td>
                                            <td>
                                                @if ($umkm->username_instagram)
                                                    <a href="https://instagram.com/{{ $umkm->username_instagram }}"
                                                        target="_blank">
                                                        <i class="fab fa-instagram text-danger"></i>
                                                        {{ '@' . $umkm->username_instagram }}
                                                    </a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                <!-- Tombol Edit -->
                                                <a href="{{ route('umkm.edit', $umkm->id) }}"
                                                    class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <!-- Tombol Hapus -->
                                                <form action="{{ route('umkm.destroy', $umkm->id) }}" method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                    data-bs-toggle="tooltip" title="Hapus">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Data UMKM tidak ditemukan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            {{ $umkms->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal Import -->
    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="{{ route('umkm.import') }}" method="POST" enctype="multipart/form-data" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import Data UMKM</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="file">Upload File Excel (.xlsx)</label>
                        <input type="file" name="file" class="form-control" accept=".xlsx,.xls" required>
                    </div>
                    <p>
                        Download template:
                        <a href="{{ asset('template/import-umkm.xlsx') }}" target="_blank">
                            <i class="fas fa-download"></i> Template Excel
                        </a>
                    </p>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-upload"></i> Import
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
@endsection
