<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Setoran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            font-size: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
            font-size: 10px;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        /* Fixed table layout for better formatting in PDF */
        table {
            table-layout: fixed;
        }

        th, td {
            word-wrap: break-word;
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
    <h1>Laporan Setoran</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama User</th>
                <th>Lokasi</th>
                <th>Jenis Setoran</th>
                <th>Shift</th>
                <th>Pendapatan Awal</th>
                <th>Pengeluaran</th>
                <th>Keterangan</th>
                <th>Pendapatan Akhir</th>
                <th>Selisih Setoran</th>
                <th>Tanggal Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($setorans as $setoran)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $setoran->user->name ?? 'Tidak Ada Data' }}</td>
                    <td>{{ $setoran->lokasi->nama_lokasi ?? 'Tidak Ada Data' }}</td>
                    <td>{{ $setoran->jenis_setoran }}</td>
                    <td>{{ $setoran->shift }}</td>
                    <td>Rp {{ number_format($setoran->pendapatan_awal, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($setoran->pengeluaran, 0, ',', '.') }}</td>
                    <td>{{ $setoran->keterangan ?? '-' }}</td>
                    <td>Rp {{ number_format($setoran->pendapatan_akhir, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($setoran->selisih_setoran, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($setoran->tanggal_transaksi)->format('d M Y') }}</td>
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
