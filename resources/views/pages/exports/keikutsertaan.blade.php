<table>
    <thead>
        <tr>
            <th>Nama UMKM</th>
            <th>Jumlah Ikut</th>
            <th>Tahun Bergabung</th>
            <th>Kategori</th>
        </tr>
    </thead>
    <tbody>
        @foreach($umkm_data as $umkm)
        <tr>
            <td>{{ $umkm->nama_umkm }}</td>
            <td>{{ $umkm->jumlah_ikut }}</td>
            <td>{{ $umkm->tahun_bergabung }}</td>
            <td>{{ $umkm->peringkat }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
