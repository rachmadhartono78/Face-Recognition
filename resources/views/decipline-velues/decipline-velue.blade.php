<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Nilai Kedisiplinan</h3>
                <p class="text-subtitle text-muted">Monitoring performa dan kedisiplinan presensi pegawai.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Nilai Kedisiplinan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>

    <div class="container-fluid">
        <!-- Statistik Section -->
        <div class="row mb-4">
            @php
                $statItems = [
                    ['title' => 'Alpha', 'value' => $stats['tidak_masuk'], 'color' => 'danger', 'icon' => 'bi bi-person-x'],
                    ['title' => 'Hadir', 'value' => $stats['masuk_kerja'], 'color' => 'success', 'icon' => 'bi bi-person-check'],
                    ['title' => 'Terlambat', 'value' => $stats['izin_terlambat'], 'color' => 'warning', 'icon' => 'bi bi-clock-history'],
                    ['title' => 'Cuti', 'value' => $stats['izin_cuti'], 'color' => 'primary', 'icon' => 'bi bi-calendar-event'],
                    ['title' => 'Pulang Awal', 'value' => $stats['izin_pulang_awal'], 'color' => 'secondary', 'icon' => 'bi bi-door-open'],
                    ['title' => 'Aktivitas Jam Kerja', 'value' => $stats['status_aktivitas'], 'color' => 'info', 'icon' => 'bi bi-bar-chart-line'],
                ];
            @endphp

            @foreach ($statItems as $stat)
                <div class="col-6 col-lg-2 col-md-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                    <div class="stats-icon bg-{{ $stat['color'] }} mb-2">
                                        <i class="{{ $stat['icon'] }} text-white fs-5"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">{{ $stat['title'] }}</h6>
                                    <h6 class="font-extrabold mb-0">{{ $stat['value'] }} <small class="text-xs">Hari</small></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Tabel Presensi -->
        <div class="card shadow-sm border-0">
            <div class="card-header border-bottom-0 d-flex justify-content-between align-items-center">
                <h4 class="card-title">Daftar Presensi Pegawai</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-lg">
                        <thead>
                            <tr class="text-muted">
                                <th>No</th>
                                <th>NIP</th>
                                <th>Tanggal</th>
                                <th class="text-center">Jam Masuk</th>
                                <th class="text-center">Jam Keluar</th>
                                <th class="text-center">Durasi</th>
                                <th class="text-center">Poin</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($presensi as $item)
                                <tr>
                                    <td class="text-center align-middle">{{ $loop->iteration + ($presensi->currentPage() - 1) * $presensi->perPage() }}</td>
                                    <td class="align-middle"><code class="text-primary font-bold">{{ $item->nip }}</code></td>
                                    <td class="align-middle">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</td>
                                    <td class="text-center align-middle">{{ $item->jam_masuk ?? '-' }}</td>
                                    <td class="text-center align-middle">{{ $item->jam_pulang ?? '-' }}</td>
                                    <td class="text-center align-middle">
                                        <span class="text-muted font-medium">{{ $item->total_jam ?? '-' }}</span>
                                    </td>
                                    <td class="text-center align-middle">
                                        <span class="badge bg-light-primary text-primary">{{ $item->poin }}</span>
                                    </td>
                                    <td class="text-center align-middle">
                                        @if($item->status === 'Masuk Kerja')
                                            <span class="badge bg-light-success text-success rounded-pill px-3">Tepat Waktu</span>
                                        @else
                                            <span class="badge bg-light-warning text-warning rounded-pill px-3">Terlambat</span>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        <button class="btn btn-sm btn-outline-primary shadow-sm" title="Lihat Detail">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-5 text-muted">
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
