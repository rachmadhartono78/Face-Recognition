<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Presensi Harian Pegawai</h3>
                <p class="text-subtitle text-muted">Data kehadiran harian pegawai secara real-time.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Presensi Harian</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>

    <div class="section">
        <!-- Filter Section -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header border-bottom-0 pb-0">
                <h4 class="card-title">Filter Pencarian</h4>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('employee-presence') }}" class="row g-3">
                    <div class="col-md-3">
                        <label for="nip" class="form-label font-bold text-sm">NIP/Nama Pegawai</label>
                        <input type="text" name="nip" id="nip" class="form-control border-slate-200" placeholder="Cari NIP atau Nama..." value="{{ request()->nip }}">
                    </div>
                    <div class="col-md-3">
                        <label for="start_date" class="form-label font-bold text-sm">Tanggal Mulai</label>
                        <input type="date" name="start_date" id="start_date" class="form-control border-slate-200" value="{{ request()->start_date }}">
                    </div>
                    <div class="col-md-3">
                        <label for="end_date" class="form-label font-bold text-sm">Tanggal Selesai</label>
                        <input type="date" name="end_date" id="end_date" class="form-control border-slate-200" value="{{ request()->end_date }}">
                    </div>
                    <div class="col-md-3">
                        <label for="keterangan" class="form-label font-bold text-sm">Keterangan</label>
                        <select name="keterangan" id="keterangan" class="form-select border-slate-200">
                            <option value="">-- Semua --</option>
                            <option value="Tepat waktu" {{ request()->keterangan == 'Tepat waktu' ? 'selected' : '' }}>Tepat waktu</option>
                            <option value="Libur" {{ request()->keterangan == 'Libur' ? 'selected' : '' }}>Libur</option>
                            <option value="Terlambat" {{ request()->keterangan == 'Terlambat' ? 'selected' : '' }}>Terlambat</option>
                        </select>
                    </div>
                    <div class="col-12 text-end d-flex gap-2 justify-content-end">
                        <a href="{{ route('employee-presence') }}" class="btn btn-light-secondary px-4">Reset</a>
                        <button type="submit" class="btn btn-primary px-4 shadow-sm">
                            <i class="bi bi-filter me-2"></i>Terapkan Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel Data Presensi -->
        <div class="card shadow-sm border-0">
            <div class="card-header border-bottom-0">
                <h4 class="card-title">Daftar Kehadiran Pegawai</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-lg">
                        <thead>
                            <tr class="text-muted">
                                <th>No</th>
                                <th>NIP</th>
                                <th>Tanggal</th>
                                <th class="text-center">Masuk</th>
                                <th class="text-center">Pulang</th>
                                <th class="text-center">Durasi</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($presensi as $item)
                                <tr>
                                    <td class="text-center align-middle">{{ $loop->iteration + ($presensi->currentPage() - 1) * $presensi->perPage() }}</td>
                                    <td class="align-middle"><code class="text-primary font-bold">{{ $item->nip }}</code></td>
                                    <td class="align-middle font-medium">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</td>
                                    <td class="text-center align-middle">{{ $item->jam_masuk ?? '-' }}</td>
                                    <td class="text-center align-middle">{{ $item->jam_pulang ?? '-' }}</td>
                                    <td class="text-center align-middle">
                                        <span class="text-muted font-bold">{{ $item->total_jam ?? '-' }}</span>
                                    </td>
                                    <td class="text-center align-middle">
                                        @php
                                            $ketBadge = match($item->keterangan) {
                                                'Libur' => 'bg-light-danger text-danger',
                                                'Tepat waktu' => 'bg-light-success text-success',
                                                'Terlambat' => 'bg-light-warning text-warning',
                                                default => 'bg-light-secondary text-secondary',
                                            };
                                        @endphp
                                        <span class="badge {{ $ketBadge }} rounded-pill px-3">
                                            {{ $item->keterangan }}
                                        </span>
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="d-flex justify-content-center gap-2">
                                            <button 
                                                class="btn btn-outline-primary btn-sm shadow-sm" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#modalLihat"
                                                data-id="{{ $item->id }}" 
                                                data-nip="{{ $item->nip }}"
                                                data-tanggal="{{ $item->tanggal }}"
                                                data-jam-masuk="{{ $item->jam_masuk }}"
                                                data-jam-pulang="{{ $item->jam_pulang }}"
                                                data-total-jam="{{ $item->total_jam }}"
                                                data-working-hours="{{ $item->working_hours }}"
                                                data-keterangan="{{ $item->keterangan }}">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button 
                                                class="btn btn-outline-warning btn-sm shadow-sm"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#modalEdit"
                                                data-id="{{ $item->id }}" 
                                                data-nip="{{ $item->nip }}"
                                                data-tanggal="{{ $item->tanggal }}"
                                                data-jam-masuk="{{ $item->jam_masuk }}"
                                                data-jam-pulang="{{ $item->jam_pulang }}"
                                                data-keterangan="{{ $item->keterangan }}">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-muted">
                                        <i class="bi bi-info-circle fs-2 d-block mb-2"></i>
                                        Tidak ada data presensi yang ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 px-2 d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                    <div class="text-muted text-sm font-medium">
                        Menampilkan <span class="text-dark">{{ $presensi->firstItem() ?? 0 }}</span> - <span class="text-dark">{{ $presensi->lastItem() ?? 0 }}</span> dari <span class="text-dark">{{ $presensi->total() }}</span> data.
                    </div>
                    <div>
                        {{ $presensi->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
