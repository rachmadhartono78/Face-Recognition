<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Laporan Kedisiplinan Bulanan</h3>
                <p class="text-subtitle text-muted">Rekapitulasi kedisiplinan pegawai berdasarkan data bulanan.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Laporan Bulanan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>

    <div class="section">
        <div class="row mb-4">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
                <a href="{{ route('print-discipline-report') }}" target="_blank" class="btn btn-primary shadow-sm">
                    <i class="bi bi-printer me-2"></i>Cetak Laporan
                </a>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header border-bottom-0">
                <h4 class="card-title">Daftar Laporan Kedisiplinan</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-lg">
                        <thead>
                            <tr class="text-muted">
                                <th>Pegawai</th>
                                <th>Jabatan</th>
                                <th class="text-center">Kehadiran</th>
                                <th class="text-center">Jam Kerja</th>
                                <th class="text-center">Status Kehadiran</th>
                                <th class="text-center">Durasi Terlewat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($reportsmonthly as $report)
                                <tr>
                                    <td class="col-3">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-md me-3">
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($report->nama_karyawan) }}&background=435ebe&color=fff&bold=true" class="rounded-circle">
                                            </div>
                                            <div class="d-flex flex-column">
                                                <span class="fw-bold mb-0" style="font-size: 0.9rem;">{{ $report->nama_karyawan }}</span>
                                                <small class="text-muted"><code class="text-primary">{{ $report->nip }}</code></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-info text-info rounded-pill" style="font-size: 0.75rem;">
                                            {{ $report->jabatan }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="fw-bold">{{ $report->total_kehadiran }}</span> <small class="text-muted">Hari</small>
                                    </td>
                                    <td class="text-center">
                                        <span class="fw-bold text-success">{{ $report->total_jam_kerja }}</span> <small class="text-muted">Jam</small>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex flex-column gap-1 align-items-center">
                                            <span class="badge bg-light-success text-success w-75">{{ $report->tepat_waktu }} Tepat Waktu</span>
                                            <span class="badge bg-light-warning text-warning w-75">{{ $report->terlambat }} Terlambat</span>
                                            <span class="badge bg-light-danger text-danger w-75">{{ $report->tidak_hadir }} Alpha</span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-danger fw-bold">{{ $report->durasi_tidak_terlihat }}</span> <small class="text-muted">Menit</small>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="bi bi-info-circle fs-2 d-block mb-2"></i>
                                        Tidak ada data kedisiplinan yang tersedia.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 px-2 d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                    <div class="text-muted text-sm font-medium">
                        Menampilkan <span class="text-dark">{{ $reportsmonthly->firstItem() ?? 0 }}</span> - <span class="text-dark">{{ $reportsmonthly->lastItem() ?? 0 }}</span> dari <span class="text-dark">{{ $reportsmonthly->total() }}</span> data.
                    </div>
                    <div>
                        {{ $reportsmonthly->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
