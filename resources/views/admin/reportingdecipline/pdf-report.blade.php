<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kedisiplinan Pegawai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px;
            text-align: center;
        }
        
        h1 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        /* Buat tabel lebih responsive */
        @media print {
            body {
                margin: 0;
            }
        }

        .footer {
            margin-top: 20px;
            font-size: 10px;
            text-align: right;
        }
    </style>
</head>
<body>

    <h1>Laporan Kedisiplinan Pegawai</h1>
    <p>Periode: {{ now()->format('F Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>NIP</th>
                <th>Jabatan</th>
                <th>Total Jam Kerja</th>
                <th>Total Kehadiran</th>
                <th>Tepat Waktu</th>
                <th>Terlambat</th>
                <th>Tidak Hadir</th>
                <th>Durasi Tidak Terlihat (Menit)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reportsmonthly as $index => $report)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $report->nama_karyawan }}</td>
                    <td>{{ $report->nip }}</td>
                    <td>{{ $report->jabatan }}</td>
                    <td>{{ $report->total_jam_kerja }} Jam</td>
                    <td>{{ $report->total_kehadiran }} Hari</td>
                    <td>{{ $report->tepat_waktu }} Hari</td>
                    <td>{{ $report->terlambat }} Hari</td>
                    <td>{{ $report->tidak_hadir }} Hari</td>
                    <td>{{ $report->durasi_tidak_terlihat }} Menit</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ now()->format('d-m-Y H:i') }}
    </div>

</body>
</html>
