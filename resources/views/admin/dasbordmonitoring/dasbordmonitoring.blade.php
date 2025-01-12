<x-app-layout>
    <x-slot name="header">
        <head>
            <style>
                .pagination {
                    display: flex;
                    list-style: none;
                    padding: 0;
                    margin: 0;
                }

                .pagination .page-item {
                    margin: 0 5px;
                }

                .pagination .page-link {
                    padding: 8px 12px;
                    border: 1px solid #ddd;
                    border-radius: 4px;
                    text-decoration: none;
                    color: #007bff;
                }

                .pagination .page-link:hover {
                    background-color: #007bff;
                    color: white;
                }

                .pagination .page-item.active .page-link {
                    background-color: #007bff;
                    color: white;
                    border-color: #007bff;
                }

                .pagination .page-item.disabled .page-link {
                    color: #6c757d;
                    pointer-events: none;
                    background-color: #f8f9fa;
                }
            </style>
        </head>

        <div class="row align-items-center">
            <div class="col-md-6">
                <h3>Nilai Kedisiplinan</h3>
                <p class="text-subtitle text-muted">Laporan presensi pegawai UII</p>
            </div>
            <div class="col-md-6 text-md-end">
                <nav aria-label="breadcrumb" class="breadcrumb-header">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Presensi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>

    <div class="container py-4">
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h4 class="card-title mb-4">Nilai Kedisiplinan</h4>

                <!-- Statistics Cards -->
                <div class="row g-3 mb-4">
                    @php
                        $stats = [
                            ['title' => 'Tidak Masuk', 'value' => '251 Hari', 'bg' => 'bg-danger', 'text' => 'text-white'],
                            ['title' => 'Masuk Kerja', 'value' => '571 Hari', 'bg' => 'bg-success', 'text' => 'text-white'],
                            ['title' => 'Izin Terlambat', 'value' => '1 Hari', 'bg' => 'bg-primary', 'text' => 'text-white'],
                            ['title' => 'Izin Cuti', 'value' => '5 Hari', 'bg' => 'bg-warning', 'text' => 'text-dark'],
                            ['title' => 'Izin Pulang Awal', 'value' => '0 Hari', 'bg' => 'bg-secondary', 'text' => 'text-white'],
                            ['title' => 'T/PA (<15)', 'value' => '82 Hari', 'bg' => 'bg-danger', 'text' => 'text-white'],
                        ];
                    @endphp

                    @foreach ($stats as $stat)
                        <div class="col-md-4 col-lg-2">
                            <div class="card {{ $stat['bg'] }} h-100">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                    <h5 class="card-title text-center {{ $stat['text'] }} fw-bold">{{ $stat['title'] }}</h5>
                                    <p class="card-text fs-4 text-center {{ $stat['text'] }} fw-bold">{{ $stat['value'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Filters -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <select class="form-select">
                            <option>Semua jenis presensi pegawai</option>
                            <option>Administrasi</option>
                            <option>Dosen</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <select class="form-select">
                            <option>Semua unit kerja</option>
                            <option>IT</option>
                            <option>HR</option>
                        </select>
                    </div>
                </div>

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jam Masuk</th>
                                <th>Jam Keluar</th>
                                <th>Total Jam</th>
                                <th>Poin</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employee as $index => $pegawai)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pegawai->name }}</td>
                                    <td>{{ $pegawai->jam_masuk }}</td>
                                    <td>{{ $pegawai->jam_keluar }}</td>
                                    <td>{{ $pegawai->total_jam }}</td>
                                    <td>{{ $pegawai->poin }}</td>
                                    <td>
                                        <span class="badge bg-success">{{ $pegawai->status }}</span>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div>
                        Menampilkan {{ $employee->firstItem() }} sampai {{ $employee->lastItem() }} dari total {{ $employee->total() }} data.
                    </div>
                    <div>
                        @if ($employee->hasPages())
                        <nav class="mt-4">
                            <ul class="pagination justify-content-center">
                                {{-- Tombol Previous --}}
                                @if ($employee->onFirstPage())
                                    <li class="page-item disabled"><span class="page-link">«</span></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $employee->previousPageUrl() }}" rel="prev">«</a></li>
                                @endif

                                {{-- Nomor Halaman --}}
                                @foreach ($employee->getUrlRange(1, $employee->lastPage()) as $page => $url)
                                    @if ($page == $employee->currentPage())
                                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                    @else
                                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach

                                {{-- Tombol Next --}}
                                @if ($employee->hasMorePages())
                                    <li class="page-item"><a class="page-link" href="{{ $employee->nextPageUrl() }}" rel="next">»</a></li>
                                @else
                                    <li class="page-item disabled"><span class="page-link">»</span></li>
                                @endif
                            </ul>
                        </nav>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
