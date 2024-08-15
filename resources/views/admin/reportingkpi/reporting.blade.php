<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Halaman Laporan KPI</h3>
                <p class="text-subtitle text-muted">Laporan KPI.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Laporan KPI</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <title>
            Laporan KPI
        </title>
        <script src="https://cdn.tailwindcss.com">
        </script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;display=swap" rel="stylesheet" />
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
        </style>
    </head>

    <body class="bg-gray-100">
        <div class="container mx-auto px-8 py-12">
            <div class="flex justify-between items-center mb-8">
                <a class="text-blue-600 flex items-center" href="#">
                    <i class="fas fa-arrow-left mr-2">
                    </i>
                    Kembali
                </a>
                <button class="flex items-center bg-blue-600 text-white px-4 py-2 rounded">
                    <i class="fas fa-print mr-2">
                    </i>
                    Print Laporan
                </button>
            </div>
            <div class="bg-white shadow rounded-lg p-8 mb-8">
                <h3 class="text-2xl font-semibold mb-6">
                    Laporan Key Performance Indicator
                </h3>
                <h3 class="text-xl mb-4">
                    Bulan November 2023
                </h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <tbody class="text-gray-700">
                            @foreach($reports as $report)
                                <tr class="border-b">
                                    <td class="p-4">{{ $report->nama_karyawan }}</td>
                                    <td class="p-4">{{ $report->NIP }}</td>
                                    <td class="p-4">{{ $report->jabatan }}</td>
                                    <td class="p-4">{{ $report->total_jam_kerja }} Jam</td>
                                    <td class="p-4">{{ $report->total_kehadiran }} Hari</td>
                                    <td class="p-4">{{ $report->tepat_waktu }} Hari</td>
                                    <td class="p-4">{{ $report->terlambat }} Hari</td>
                                    <td class="p-4">{{ $report->tidak_hadir }} Hari</td>
                                    <td class="p-4">{{ $report->efektivitas }}%</td>
                                    <td class="p-4">{{ $report->kinerja }}</td>
                                </tr>
                            @endforeach
                        </tbody>

                        <thead>
                            <tr class="border-b">
                                <th class="text-left p-4">
                                    Nama Karyawan
                                </th>
                                <th class="text-left p-4">
                                    NIP
                                </th>
                                <th class="text-left p-4">
                                    Jabatan
                                </th>
                                <th class="text-left p-4">
                                    Total Jam Kerja
                                </th>
                                <th class="text-left p-4">
                                    Total Kehadiran
                                </th>
                                <th class="text-left p-4">
                                    Tepat Waktu
                                </th>
                                <th class="text-left p-4">
                                    Terlambat
                                </th>
                                <th class="text-left p-4">
                                    Tidak Hadir
                                </th>
                                <th class="text-left p-4">
                                    Efektivitas
                                </th>
                                <th class="text-left p-4">
                                    Kinerja
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="flex justify-between items-center">
                <div class="flex items-center text-gray-700">
                    <i class="fas fa-phone-alt mr-2">
                    </i>
                    No. Telp (0274) 898444
                </div>
            <div class="text-center">
                <img alt="Universitas Islam Indonesia" class="mx-auto mb-2" height="100"
                    src="{{ asset('images/logo/logo.png') }}" />
                <p class="text-blue-600 font-semibold">
                    Universitas Islam Indonesia
                </p>
            </div>
            <div class="flex items-center text-gray-700">
                <i class="fas fa-globe mr-2">
                </i>
                Website www.uii.ac.id
            </div>
        </div>
        <div class="text-center text-gray-700 mt-8">
            <p>
                JL. Kaliurang Km. 14.5, Krawitan, Umbulmartani, Kec. Ngemplak,
            </p>
            <p>
                Kabupaten Sleman, Daerah Istimewa Yogyakarta 55584
            </p>
        </div>
        </div>
    </body>

    </html>
</x-app-layout>
