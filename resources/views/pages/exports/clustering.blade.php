@foreach ($clusters as $key => $items)
    <h4>Cluster {{ $key }}</h4>
    <table>
        <thead>
            <tr>
                <th>Nama UMKM</th>
                <th>Jumlah Ikut</th>
                <th>Tahun Bergabung</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $umkm)
            <tr>
                <td>{{ $umkm->nama_umkm }}</td>
                <td>{{ $umkm->jumlah_ikut }}</td>
                <td>{{ $umkm->tahun_bergabung }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endforeach
