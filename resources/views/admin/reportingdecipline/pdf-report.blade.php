<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kedisiplinan Pegawai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .title {
            font-size: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1 class="title">Laporan Kedisiplinan Pegawai</h1>
    <table>
        <thead>
            <tr>
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
            @foreach ($reportsmonthly as $report)
                <tr>
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
</body>
</html>
