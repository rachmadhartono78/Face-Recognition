<x-app-layout>
    <x-slot name="header">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h3>Laporan Kedisiplinan Bulanan</h3>
                <p class="text-subtitle text-muted">Mengelola laporan kedisiplinan berdasarkan Rekap Bulanan.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Laporan Kedisiplinan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>

    <div class="container py-4">
        <!-- Table -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="card-title">Laporan Kedisiplinan Pegawai</h4>
                <p class="card-text">Berikut adalah daftar laporan kedisiplinan pegawai:</p>
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
                                <th>Durasi Tidak Terlihat (Menit)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($reports as $report)
                                <tr>
                                    <td>{{ $report->nama_karyawan }}</td>
                                    <td>{{ $report->nip }}</td>
                                    <td>{{ $report->jabatan }}</td>
                                    <td>{{ $report->total_jam_kerja }} Jam</td>
                                    <td>{{ $report->total_kehadiran }} Hari</td>
                                    <td>{{ $report->tepat_waktu }} Hari</td>
                                    <td>{{ $report->terlambat }} Hari</td>
                                    <td>{{ $report->tidak_hadir }} Hari</td>
                                    <td>{{ $report->durasi_tidak_terlihat }} Menit</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">Tidak ada data kedisiplinan yang tersedia.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="mt-4 d-flex justify-content-between align-items-center">
                    <div>
                        Menampilkan {{ $reports->firstItem() }} sampai {{ $reports->lastItem() }} dari total {{ $reports->total() }} data.
                    </div>
                    <div>
                        {{ $reports->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
