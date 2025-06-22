@extends('layouts.app')

@section('title', 'Tambah UMKM')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah UMKM</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('umkm.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>Nama UMKM</label>
                            <input type="text" name="nama_umkm" class="form-control" value="{{ old('nama_umkm') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Nama Pemilik</label>
                            <input type="text" name="nama_pemilik" class="form-control" value="{{ old('nama_pemilik') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Tahun Bergabung</label>
                            <input type="number" name="tahun_bergabung" class="form-control" value="{{ old('tahun_bergabung') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Jenis UMKM</label>
                            <select name="jenis_umkm" class="form-control" required>
                                <option value="">-- Pilih Jenis --</option>
                                <option value="Makanan" {{ old('jenis_umkm') == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                                <option value="Minuman" {{ old('jenis_umkm') == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Nama Event</label>
                            <input type="text" name="nama_event" class="form-control" value="{{ old('nama_event') }}">
                        </div>

                        <div class="form-group">
                            <label>Username Instagram</label>
                            <input type="text" name="username_instagram" class="form-control" value="{{ old('username_instagram') }}">
                        </div>

                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                        <a href="{{ route('umkm.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
