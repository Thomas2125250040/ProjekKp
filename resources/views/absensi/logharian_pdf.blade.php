{{-- <!DOCTYPE html>
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
</html> --}}

{{-- <!DOCTYPE html>
<html>
<head>
    <title>Laporan Log Harian</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            text-align: center;
        }
        th, td {
            padding: 8px;
        }
        .bg-danger {
            background-color: #f8d7da;
        }
        .bg-secondary {
            background-color: #d6d8db;
        }
    </style>
</head>
<body>
    <h1>Laporan Log Harian</h1>
    <p>Nama Karyawan: {{ $karyawan->nama }}</p>
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
            @foreach ($logs as $log)
                <tr class="{{ $log['jenis'] == 'alpha' ? 'bg-danger' : ($log['jenis'] == 'izin' ? 'bg-secondary' : '') }}">
                    <td>{{ $log['tanggal'] }}</td>
                    <td>{{ $log['waktu_masuk'] }}</td>
                    <td>{{ $log['waktu_keluar'] }}</td>
                    <td>{{ $log['keterangan'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html> --}}
{{-- 
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Log Harian - {{ $nama }}</title>
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
    <h2>Laporan Log Harian - {{ $nama }}</h2>
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
</html> --}}

{{-- <!DOCTYPE html>
<html>
<head>
    <title>Laporan Log Harian - {{ $nama }}</title>
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
    <h2>Laporan Log Harian - {{ $nama }}</h2>
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
            @php
                // Gabung semua data log menjadi satu array
                $combinedLogs = array_merge($logAlpha, $logIzin, $logMasuk, $logLibur);

                // Urutkan array berdasarkan tanggal
                usort($combinedLogs, function($a, $b) {
                    return strtotime($a['tanggal']) - strtotime($b['tanggal']);
                });
            @endphp

            @foreach($combinedLogs as $log)
                <tr style="{{ $log['type'] == 'alpha' ? 'background-color: #f8d7da;' : ($log['type'] == 'izin' ? 'background-color: #d6d8db;' : '') }}">
                    <td>{{ $log['tanggal'] }}</td>
                    <td>{{ isset($log['waktu_masuk']) ? $log['waktu_masuk'] : '-' }}</td>
                    <td>{{ isset($log['waktu_keluar']) ? $log['waktu_keluar'] : '-' }}</td>
                    <td>
                        @if(isset($log['keterangan_izin']))
                            {{ $log['keterangan_izin'] }}
                        @elseif(isset($log['keterangan_libur']))
                            {{ $log['keterangan_libur'] }}
                        @elseif($log['type'] == 'alpha')
                            Alpha
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html> --}}

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Log Harian - {{ $nama }}</title>
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
    <h2>Laporan Log Harian - {{ $nama }}</h2>
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
            @foreach($combinedLogs as $log)
                <tr style="{{ isset($log['type']) && $log['type'] == 'alpha' ? 'background-color: #f8d7da;' : (isset($log['type']) && $log['type'] == 'izin' ? 'background-color: #d6d8db;' : '') }}">
                    <td>{{ $log['tanggal'] }}</td>
                    <td>{{ isset($log['waktu_masuk']) ? $log['waktu_masuk'] : '-' }}</td>
                    <td>{{ isset($log['waktu_keluar']) ? $log['waktu_keluar'] : '-' }}</td>
                    <td>
                        @if(isset($log['keterangan_izin']))
                            {{ $log['keterangan_izin'] }}
                        @elseif(isset($log['keterangan_libur']))
                            {{ $log['keterangan_libur'] }}
                        @elseif(isset($log['type']) && $log['type'] == 'alpha')
                            Alpha
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
