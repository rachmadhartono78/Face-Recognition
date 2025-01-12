<x-app-layout>
    <x-slot name="header">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h3>Kelola Pengguna</h3>
                <p class="text-subtitle text-muted">Manajemen data pengguna presensi & Monitoring Pegawai.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <nav aria-label="breadcrumb" class="breadcrumb-header">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Presensi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kelola Pengguna</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>

    <div class="container py-4">
        <!-- Filter Section -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('employee') }}" class="row g-3">
                    <div class="col-md-4">
                        <label for="jenis_presensi" class="form-label">Jenis Presensi</label>
                        <select name="jenis_presensi" id="jenis_presensi" class="form-select">
                            <option value="">-- Pilih --</option>
                            <option value="Administrasi">Administrasi</option>
                            <option value="Dosen tetap">Dosen tetap</option>
                            <option value="Dosen kontrak">Dosen kontrak</option>
                            <option value="Tenaga pendukung">Tenaga pendukung</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="unit_kerja" class="form-label">Unit Kerja</label>
                        <select name="unit_kerja" id="unit_kerja" class="form-select">
                            <option value="">-- Pilih --</option>
                            <option value="Badan Sistem Informasi">Badan Sistem Informasi</option>
                            <option value="Fakultas Hukum">Fakultas Hukum</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="">-- Pilih --</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Nonaktif">Nonaktif</option>
                        </select>
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table Section -->
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Jenis Presensi</th>
                                <th>Unit Kerja</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $index => $user)
                                <tr>
                                    <td>{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                                    <td>{{ $user->nip }}</td>
                                    <td>{{ $user->nama }}</td>
                                    <td>{{ $user->jenis_presensi }}</td>
                                    <td>{{ $user->unit_kerja }}</td>
                                    <td>{{ $user->flag_aktif ? 'Aktif' : 'Nonaktif' }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <!-- Edit -->
                                            {{-- <a href="{{ route('employee.edit', ['id' => $user->id]) }}" class="btn btn-warning btn-sm"> --}}
                                            <a href="{{ route('employee', ['id' => $user->id]) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <!-- View -->
                                            {{-- <a href="{{ route('employee.show', ['id' => $user->id]) }}" class="btn btn-primary btn-sm"> --}}
                                            <a href="{{ route('employee', ['id' => $user->id]) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <!-- Delete -->
                                            {{-- <form method="POST" action="{{ route('employee.destroy', ['id' => $user->id]) }}"> --}}
                                            <form method="POST" action="{{ route('employee', ['id' => $user->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">Tidak ada data pengguna tersedia.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="mt-4 d-flex justify-content-between align-items-center">
                    <div>
                        Menampilkan {{ $users->firstItem() }} sampai {{ $users->lastItem() }} dari total {{ $users->total() }} data.
                    </div>
                    <div>
                        {{ $users->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
