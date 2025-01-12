<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Halaman Laporan KPI</h3>
                {{-- <p class="text-subtitle text-muted">Laporan KPI.</p> --}}
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Laporan KPI</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>

    <div class="container py-4">
        <!-- Header Laporan -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="#" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
            <button class="btn btn-primary">
                <i class="fas fa-print me-2"></i>Print Laporan
            </button>
        </div>

        <!-- Tabel Laporan -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="card-title">Laporan Key Performance Indicator</h4>
                <p class="card-text">Bulan November 2023</p>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Karyawan</th>
                                <th>NIP</th>
                                <th>Jabatan</th>
                                <th>Total Jam Kerja</th>
                                <th>Total Kehadiran</th>
                                <th>Tepat Waktu</th>
                                <th>Terlambat</th>
                                <th>Tidak Hadir</th>
                                <th>Efektivitas</th>
                                <th>Kinerja</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reports as $report)
                                <tr>
                                    <td>{{ $report->nama_karyawan }}</td>
                                    <td>{{ $report->NIP }}</td>
                                    <td>{{ $report->jabatan }}</td>
                                    <td>{{ $report->total_jam_kerja }} Jam</td>
                                    <td>{{ $report->total_kehadiran }} Hari</td>
                                    <td>{{ $report->tepat_waktu }} Hari</td>
                                    <td>{{ $report->terlambat }} Hari</td>
                                    <td>{{ $report->tidak_hadir }} Hari</td>
                                    <td>{{ $report->efektivitas }}%</td>
                                    <td>{{ $report->kinerja }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
