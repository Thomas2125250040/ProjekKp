{{-- <!DOCTYPE html>
<html>
<head>
    <title>Laporan Absensi</title>
    <style>
        h1,h2,h3,h4{
            line-height: 10%;
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
    <center><h1><b>CV. ANUGRAH ABADI</b></h1></center>
    <center><h2><b>Laporan Absensi</b></h2></center>
    <center><h3><b>Bulan xxx</b></h3></center>
    <center><h3><b>Tahun xxx</b></h3></center>
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
            {{-- @foreach($laporan as $g)
                <tr>
                    <td>{{ $g->nama_karyawan }}</td>
                    <td>{{ $g->jumlah_hadir }}</td>
                    <td>{{ $g->jumlah_izin }}</td>
                    <td>{{ $g->jumlah_alpha }}</td>
                </tr>
            @endforeach --}}
         
{{-- 
            <!DOCTYPE html>
            <html>
            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                    }
                    .header {
                        text-align: center;
                        margin-bottom: 20px;
                    }
                    .header h1, .header h2 {
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
                    <h1>CV ANUGRAH ABADI</h1>
                    <h2>Laporan Absensi Karyawan</h2>
                    <p>Bulan: {{ $bulan }}</p>
                    <p>Tahun: {{ $tahun }}</p>
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
                        @foreach($laporan as $g)
                            <tr>
                                <td>{{ $g->nama_karyawan }}</td>
                                <td>{{ $g->jumlah_hadir }}</td>
                                <td>{{ $g->jumlah_izin }}</td>
                                <td>{{ $g->jumlah_alpha }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </body>
            </html>
                         --}}

                         <!-- halamanCetakLaporan.blade.php -->
<!-- resources/views/laporan_pdf.blade.php -->

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
