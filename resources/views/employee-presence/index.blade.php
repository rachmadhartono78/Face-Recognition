<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Halaman Data Presensi Pegawai</h3>
                <p class="text-subtitle text-muted">Laporan presensi pegawai.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Data Presensi Pegawai</li>
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
            Data Presensi Pegawai
        </title>
        <script src="https://cdn.tailwindcss.com"></script>
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
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
            </div>
            <div class="bg-white shadow rounded-lg p-8 mb-8">
                <h3 class="text-2xl font-semibold mb-6">Data Presensi Pegawai</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="text-left p-4 border border-gray-300">No</th>
                                <th class="text-left p-4 border border-gray-300">NIP</th>
                                <th class="text-left p-4 border border-gray-300">Tanggal</th>
                                <th class="text-left p-4 border border-gray-300">Jam Masuk</th>
                                <th class="text-left p-4 border border-gray-300">Jam Pulang</th>
                                <th class="text-left p-4 border border-gray-300">Total Jam</th>
                                <th class="text-left p-4 border border-gray-300">Working Hours</th>
                                <th class="text-left p-4 border border-gray-300">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @foreach ($presensi as $item)
                                <tr class="border-b">
                                    <td class="p-4 border border-gray-300">{{ $loop->iteration + ($presensi->currentPage() - 1) * $presensi->perPage() }}</td>
                                    <td class="p-4 border border-gray-300">{{ $item->nip }}</td>
                                    <td class="p-4 border border-gray-300">{{ $item->tanggal }}</td>
                                    <td class="p-4 border border-gray-300">{{ $item->jam_masuk }}</td>
                                    <td class="p-4 border border-gray-300">{{ $item->jam_pulang }}</td>
                                    <td class="p-4 border border-gray-300">{{ $item->total_jam }}</td>
                                    <td class="p-4 border border-gray-300">{{ $item->working_hours }}</td>
                                    <td class="p-4 border border-gray-300">{{ $item->keterangan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $presensi->links() }}
                </div>
            </div>
        </div>
    </body>

    </html>
</x-app-layout>
