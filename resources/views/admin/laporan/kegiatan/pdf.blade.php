<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kegiatan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 5px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }

        /* Signature block */
        .signature {
            margin-top: 50px;
            text-align: right;
            font-size: 12px;
        }

        .signature-line {
            border-top: 1px solid #000;
            width: 200px;
            margin: 10px 0;
            text-align: center;
        }
    </style>
</head>
<body>

    <h2>Laporan Kegiatan</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama User</th>
                <th>Lokasi</th>
                <th>Tanggal</th>
                <th>Jenis</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporanKegiatans as $laporan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $laporan->user->name }}</td>
                    <td>{{ $laporan->lokasi->nama_lokasi }}</td>
                    <td>{{ \Carbon\Carbon::parse($laporan->tanggal_kegiatan)->format('d-m-Y') }}</td>
                    <td>{{ $laporan->jenis_kegiatan }}</td>
                    <td>{{ $laporan->deskripsi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Signature area -->
    <div class="signature">
        <p>Supervisor</p>
        <div class="signature-line"></div>
    </div>

</body>
</html>
