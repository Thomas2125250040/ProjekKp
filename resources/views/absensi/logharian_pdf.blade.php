<!DOCTYPE html>
<html>
<head>
    <title>Laporan Log Harian</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Laporan Log Harian</h2>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Waktu Masuk</th>
                <th>Waktu Keluar</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logAlpha as $log)
            <tr style="background-color: #f8d7da;">
                <td>{{ $log['tanggal'] }}</td>
                <td>-</td>
                <td>-</td>
                <td>Alpha</td>
            </tr>
            @endforeach

            @foreach($logIzin as $log)
            <tr style="background-color: #d6d8db;">
                <td>{{ $log['tanggal'] }}</td>
                <td>-</td>
                <td>-</td>
                <td>{{ $log['keterangan_izin'] }}</td>
            </tr>
            @endforeach

            @foreach($logMasuk as $log)
            <tr>
                <td>{{ $log['tanggal'] }}</td>
                <td>{{ $log['waktu_masuk'] }}</td>
                <td>{{ $log['waktu_keluar'] }}</td>
                <td>-</td>
            </tr>
            @endforeach

            @foreach($logLibur as $log)
            <tr>
                <td>{{ $log['tanggal'] }}</td>
                <td>-</td>
                <td>-</td>
                <td>{{ $log['keterangan_libur'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
