<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Jumlah Hadir</th>
            <th>Jumlah Izin</th>
            <th>Jumlah Alpha</th>
            <th>Jumlah Terlambat</th>
            <th>Total Jam Lembur</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($laporan as $key => $g)
            <tr>
                <td>{{ $g->id }}</td>
                <td>{{ $g->nama_karyawan }}</td>
                <td>{{ $g->jumlah_hadir }}</td>
                <td>{{ $g->jumlah_izin }}</td>
                <td>{{ $g->jumlah_alpha }}</td>
                <td>{{ $g->total_telat }}</td>
                <td>{{ $g->total_lembur }} jam</td>
            </tr>
        @endforeach
    </tbody>
</table>
