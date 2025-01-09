<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Detail Presensi Pegawai</h3>
                <p class="text-subtitle text-muted">Data lengkap presensi pegawai.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Detail Presensi</li>
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
            Detail Presensi Pegawai
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
            <div class="bg-white shadow rounded-lg p-8 mb-8">
                <h3 class="text-2xl font-semibold mb-6">Detail Presensi Pegawai</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="p-4 border border-gray-300"><input type="checkbox" /></th>
                                <th class="text-left p-4 border border-gray-300">No</th>
                                <th class="text-left p-4 border border-gray-300">Nama</th>
                                <th class="text-left p-4 border border-gray-300">NIK</th>
                                <th class="text-left p-4 border border-gray-300">Jenis Presensi Pegawai</th>
                                <th class="text-left p-4 border border-gray-300">Unit Kerja</th>
                                <th class="text-left p-4 border border-gray-300">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @foreach ($employee as $index => $pegawai)
                                <tr class="border-b">
                                    <td class="p-4 border border-gray-300">
                                        <input type="checkbox" />
                                    </td>
                                    <td class="p-4 border border-gray-300">{{ $loop->iteration }}</td>
                                    <td class="p-4 border border-gray-300">{{ $pegawai->name }}</td>
                                    <td class="p-4 border border-gray-300">{{ $pegawai->nik }}</td>
                                    <td class="p-4 border border-gray-300">{{ $pegawai->type_presence }}</td>
                                    <td class="p-4 border border-gray-300">{{ $pegawai->work_unit }}</td>
                                    <td class="p-4 border border-gray-300">
                                        <div class="flex space-x-2">
                                            <button class="text-blue-600"><i class="fas fa-edit"></i></button>
                                            <button class="text-blue-600"><i class="fas fa-eye"></i></button>
                                            <button>
                                                <label class="switch">
                                                    <input type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </button>
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
