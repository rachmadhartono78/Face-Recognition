<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Kelola Pengguna</h3>
                <p class="text-subtitle text-muted">Manajemen data pengguna presensi.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Presensi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kelola Pengguna</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>

    <div class="container mx-auto px-8 py-12">
        <!-- Filter Section -->
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <form method="GET" action="{{ route('users.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="type_presence" class="block text-sm font-medium">Jenis Presensi Pegawai</label>
                    <select name="type_presence" id="type_presence" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">-- Pilih --</option>
                        <option value="Administrasi">Administrasi</option>
                        <option value="Dosen Tetap">Dosen Tetap</option>
                        <option value="Dosen Paruh Waktu">Dosen Paruh Waktu</option>
                    </select>
                </div>
                <div>
                    <label for="work_unit" class="block text-sm font-medium">Unit Kerja</label>
                    <select name="work_unit" id="work_unit" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">-- Pilih --</option>
                        <option value="Fakultas Hukum">Fakultas Hukum</option>
                        <option value="Arsitektur S1">Arsitektur S1</option>
                        <!-- Tambahkan opsi lainnya -->
                    </select>
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium">Status</label>
                    <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="Aktif">Aktif</option>
                        <option value="Nonaktif">Nonaktif</option>
                    </select>
                </div>
            </form>
        </div>

        <!-- Table Section -->
        <div class="bg-white shadow rounded-lg p-6">
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
                    <tbody>
                        @foreach ($users as $index => $user)
                            <tr class="border-b">
                                <td class="p-4 border border-gray-300"><input type="checkbox" /></td>
                                <td class="p-4 border border-gray-300">{{ $loop->iteration }}</td>
                                <td class="p-4 border border-gray-300">{{ $user->name }}</td>
                                <td class="p-4 border border-gray-300">{{ $user->nik }}</td>
                                <td class="p-4 border border-gray-300">{{ $user->type_presence }}</td>
                                <td class="p-4 border border-gray-300">{{ $user->work_unit }}</td>
                                <td class="p-4 border border-gray-300">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('users.edit', $user->id) }}" class="text-blue-600"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route('users.show', $user->id) }}" class="text-blue-600"><i class="fas fa-eye"></i></a>
                                        <label class="switch">
                                            <input type="checkbox" {{ $user->status == 'Aktif' ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
