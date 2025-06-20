@extends('layouts.app')

@section('title', 'Pembayaran')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/d') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Pembayaran</h4>
                            </div>
                            <div class="card-body">
                                <div class="p-2">
                                    <div class="float-left">
                                        <div class="section-header-button">
                                            <a href="{{ route('pembayaran.create') }}" class="btn btn-primary">Tambah</a>
                                        </div>
                                    </div>
                                    <div class="float-right">
                                        <form action="{{ route('pembayaran.index') }}" method="GET">
                                            <div class="input-group">
                                                <select name="status" class="form-control" onchange="this.form.submit()">
                                                    <option value="" {{ request('status') == '' ? 'selected' : '' }}>
                                                        Semua Status</option>
                                                    <option value="Aktif"
                                                        {{ request('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                                    <option value="Tidak Aktif"
                                                        {{ request('status') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak
                                                        Aktif</option>
                                                </select>
                                                <input type="text" class="form-control" placeholder="Search"
                                                    name="nama" value="{{ request('nama') }}">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="clearfix  divider mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered table-lg" id="table-1">
                                        <tr>
                                            <th style="width: 3%">No</th>
                                            <th class="text-center">Image</th>
                                            <th>Nama</th>
                                            <th>Status</th>
                                            <th style="width: 5%" class="text-center">Action</th>
                                        </tr>
                                        @foreach ($pembayarans as $index => $pembayaran)
                                            <tr>
                                                <td>
                                                    {{ $pembayarans->firstItem() + $index }}
                                                </td>
                                                <td class="text-center">
                                                    <img alt="image"
                                                    src="{{ $pembayaran->image ? asset('img/produk/' . $pembayaran->image) : asset('img/avatar/avatar-1.png') }}"
                                                    class="img-fluid rounded" style="max-width: 50px; height: auto;" 
                                                    data-toggle="tooltip" title="avatar">
                                                </td>
                                                <td>
                                                    {{ $pembayaran->nama }}
                                                </td>
                                                <td>
                                                    @if ($pembayaran->status == 'Aktif')
                                                        <span class="badge badge-success">{{ $pembayaran->status }}</span>
                                                    @else
                                                        <span class="badge badge-danger">{{ $pembayaran->status }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ route('pembayaran.edit', $pembayaran) }}"
                                                            class="btn btn-sm btn-icon btn-primary m-1"><i
                                                                class="fas fa-edit"></i></a>
                                                        <form action="{{ route('pembayaran.destroy', $pembayaran) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button
                                                                class="btn btn-sm btn-icon m-1 btn-danger confirm-delete ">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                    <div class="card-footer d-flex justify-content-between">
                                        <span>
                                            Showing {{ $pembayarans->firstItem() }}
                                            to {{ $pembayarans->lastItem() }}
                                            of {{ $pembayarans->total() }} entries
                                        </span>
                                        <div class="paginate-sm">
                                            {{ $pembayarans->onEachSide(0)->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    {{-- <script src="{{ asset() }}"></script> --}}
    {{-- <script src="{{ asset() }}"></script> --}}
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
    <script src="{{ asset('js/page/components-table.js') }}"></script>
@endpush
