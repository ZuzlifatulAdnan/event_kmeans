@foreach($clusters as $cluster => $items)
<h4>Cluster {{ $cluster }}</h4>
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
        @foreach($items as $item)
        <tr>
            <td>{{ $item->nama_umkm }}</td>
            <td>{{ $item->jumlah_ikut }}</td>
            <td>{{ $item->tahun_bergabung }}</td>
            <td>
                @if ($item->jumlah_ikut >= 10)
                    Gold
                @elseif ($item->jumlah_ikut >= 4)
                    Silver
                @else
                    Bronze
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<br>
@endforeach
