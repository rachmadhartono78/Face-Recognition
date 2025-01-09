<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Nilai Kedisiplinan</h3>
                <p class="text-subtitle text-muted">Laporan presensi pegawai UII</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Presensi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>

    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <title>Nilai Kedisiplinan</title>
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
            <div class="bg-white shadow rounded-lg p-8 mb-8">
                <h3 class="text-2xl font-semibold mb-6">Nilai Kedisiplinan</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 mb-6">
                    <div class="bg-red-100 p-4 rounded-lg shadow">
                        <h4 class="text-red-600 font-bold text-lg">Tidak Masuk</h4>
                        <p class="text-red-600 font-semibold text-2xl">251 Hari</p>
                    </div>
                    <div class="bg-green-100 p-4 rounded-lg shadow">
                        <h4 class="text-green-600 font-bold text-lg">Masuk Kerja</h4>
                        <p class="text-green-600 font-semibold text-2xl">571 Hari</p>
                    </div>
                    <div class="bg-blue-100 p-4 rounded-lg shadow">
                        <h4 class="text-blue-600 font-bold text-lg">Izin Terlambat</h4>
                        <p class="text-blue-600 font-semibold text-2xl">1 Hari</p>
                    </div>
                    <div class="bg-yellow-100 p-4 rounded-lg shadow">
                        <h4 class="text-yellow-600 font-bold text-lg">Izin Cuti</h4>
                        <p class="text-yellow-600 font-semibold text-2xl">5 Hari</p>
                    </div>
                    <div class="bg-gray-100 p-4 rounded-lg shadow">
                        <h4 class="text-gray-600 font-bold text-lg">Izin Pulang Awal</h4>
                        <p class="text-gray-600 font-semibold text-2xl">0 Hari</p>
                    </div>
                    <div class="bg-red-200 p-4 rounded-lg shadow">
                        <h4 class="text-red-800 font-bold text-lg">T/PA (< 15)</h4>
                        <p class="text-red-800 font-semibold text-2xl">82 Hari</p>
                    </div>
                </div>

                <div class="flex justify-between items-center mb-4">
                    <div class="flex space-x-4">
                        <select class="border border-gray-300 rounded px-4 py-2">
                            <option>Semua jenis presensi pegawai</option>
                            <option>Administrasi</option>
                            <option>Dosen</option>
                        </select>
                        <select class="border border-gray-300 rounded px-4 py-2">
                            <option>Semua unit kerja</option>
                            <option>IT</option>
                            <option>HR</option>
                        </select>
                    </div>
                    <div class="flex space-x-2">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded">Hari</button>
                        <button class="bg-blue-600 text-white px-4 py-2 rounded">Bulan</button>
                        <button class="bg-blue-600 text-white px-4 py-2 rounded">Tahun</button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="p-4 border border-gray-300">No</th>
                                <th class="text-left p-4 border border-gray-300">Nama</th>
                                <th class="text-left p-4 border border-gray-300">Jam Masuk</th>
                                <th class="text-left p-4 border border-gray-300">Jam Keluar</th>
                                <th class="text-left p-4 border border-gray-300">Total Jam</th>
                                <th class="text-left p-4 border border-gray-300">Poin</th>
                                <th class="text-left p-4 border border-gray-300">Status</th>
                                <th class="text-left p-4 border border-gray-300">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @foreach ($employee as $index => $pegawai)
                                <tr class="border-b">
                                    <td class="p-4 border border-gray-300">{{ $loop->iteration }}</td>
                                    <td class="p-4 border border-gray-300">{{ $pegawai->name }}</td>
                                    <td class="p-4 border border-gray-300">{{ $pegawai->jam_masuk }}</td>
                                    <td class="p-4 border border-gray-300">{{ $pegawai->jam_keluar }}</td>
                                    <td class="p-4 border border-gray-300">{{ $pegawai->total_jam }}</td>
                                    <td class="p-4 border border-gray-300">{{ $pegawai->poin }}</td>
                                    <td class="p-4 border border-gray-300">
                                        <span class="px-2 py-1 rounded bg-green-100 text-green-800">{{ $pegawai->status }}</span>
                                    </td>
                                    <td class="p-4 border border-gray-300">
                                        <div class="flex space-x-2">
                                            <button class="text-blue-600"><i class="fas fa-eye"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $employee->links() }}
                </div>
            </div>
        </div>
    </body>

    </html>
</x-app-layout>
