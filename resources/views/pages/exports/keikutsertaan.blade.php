<table>
    <thead>
        <tr>
            <th>Nama UMKM</th>
            <th>Jumlah Ikut</th>
            <th>Tahun Bergabung</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($umkms as $u)
        <tr>
            <td>{{ $u->nama_umkm }}</td>
            <td>{{ $u->jumlah_ikut }}</td>
            <td>{{ $u->tahun_bergabung }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
