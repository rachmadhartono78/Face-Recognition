<x-app-layout>
    <x-slot name="header">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h3>Nilai Kedisiplinan</h3>
                <p class="text-subtitle text-muted">Laporan presensi pegawai UII</p>
            </div>
            <div class="col-md-6 text-md-end">
                {{-- <nav aria-label="breadcrumb" class="breadcrumb-header"> --}}
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Nilai Kedisiplinan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>

    <div class="container py-4">
        <!-- Statistik -->
        <div class="row g-3 mb-4">
            @php
                $statsCards = [
                    ['title' => 'Tidak Masuk', 'value' => $stats['tidak_masuk'] . ' Hari', 'bg' => 'bg-danger', 'text' => 'text-white'],
                    ['title' => 'Masuk Kerja', 'value' => $stats['masuk_kerja'] . ' Hari', 'bg' => 'bg-success', 'text' => 'text-white'],
                    ['title' => 'Izin Terlambat', 'value' => $stats['izin_terlambat'] . ' Hari', 'bg' => 'bg-primary', 'text' => 'text-white'],
                    ['title' => 'Izin Cuti', 'value' => $stats['izin_cuti'] . ' Hari', 'bg' => 'bg-warning', 'text' => 'text-dark'],
                    ['title' => 'Izin Pulang Awal', 'value' => $stats['izin_pulang_awal'] . ' Hari', 'bg' => 'bg-secondary', 'text' => 'text-white'],
                    ['title' => 'T/PA (<15)', 'value' => $stats['tpa'] . ' Hari', 'bg' => 'bg-danger', 'text' => 'text-white'],
                ];
            @endphp

            @foreach ($statsCards as $stat)
                <div class="col-md-4 col-lg-2">
                    <div class="card {{ $stat['bg'] }} h-100 shadow-sm">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <h5 class="card-title text-center {{ $stat['text'] }} fw-bold">{{ $stat['title'] }}</h5>
                            <p class="card-text fs-4 text-center {{ $stat['text'] }} fw-bold">{{ $stat['value'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Tabel Presensi -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h4 class="card-title mb-4">Daftar Presensi Pegawai</h4>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Jam Keluar</th>
                                <th>Total Jam</th>
                                <th>Poin</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($presensi as $index => $item)
                                <tr>
                                    <td>{{ $loop->iteration + ($presensi->currentPage() - 1) * $presensi->perPage() }}</td>
                                    <td>{{ $item->nip }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->jam_masuk ?? '-' }}</td>
                                    <td>{{ $item->jam_pulang ?? '-' }}</td>
                                    <td>{{ $item->total_jam ?? '-' }}</td>
                                    <td>{{ $item->poin }}</td>
                                    <td>
                                        <span class="badge {{ $item->status === 'Masuk Kerja' ? 'bg-success' : 'bg-warning' }}">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-primary btn-sm" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">Tidak ada data presensi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div>
                        Menampilkan {{ $presensi->firstItem() }} sampai {{ $presensi->lastItem() }} dari total {{ $presensi->total() }} data.
                    </div>
                    <div>
                        {{ $presensi->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
