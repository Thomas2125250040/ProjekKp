<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        /* Tambahkan CSS sesuai kebutuhan */
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
        }
        .header p {
            margin: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $header }}</h1>
        <h2>{{ $title }}</h2>
        <h3>Bulan {{ $bulan }}, Tahun {{ $tahun }}</h3>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jumlah Hadir</th>
                <th>Jumlah Izin</th>
                <th>Jumlah Alpha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporan as $item)
                <tr>
                    <td>{{ $item->nama_karyawan }}</td>
                    <td>{{ $item->jumlah_hadir }}</td>
                    <td>{{ $item->jumlah_izin }}</td>
                    <td>{{ $item->jumlah_alpha }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
