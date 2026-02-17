<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Dashboard Statistics</h3>
                <p class="text-subtitle text-muted">Ringkasan Kinerja dan Komposisi Pegawai</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Statistics</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>

    <section class="section">
        <!-- System Overview Card -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0 bg-primary text-white overflow-hidden mb-4 rounded-4">
                    <div class="card-body p-4 position-relative" style="z-index: 1;">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <h4 class="text-white mb-2">Selamat Datang di Portal UIIDashy</h4>
                                <p class="mb-0 opacity-75">Sistem Terintegrasi Face Recognition & Kedisiplinan Pegawai. Kelola data kehadiran dengan presisi AI.</p>
                                <div class="mt-3 d-flex flex-wrap gap-2">
                                    <span class="badge bg-white bg-opacity-25"><i class="bi bi-eye me-1"></i> Real-time Detection</span>
                                    <span class="badge bg-white bg-opacity-25"><i class="bi bi-play-btn me-1"></i> History Playback</span>
                                    <span class="badge bg-white bg-opacity-25"><i class="bi bi-graph-up me-1"></i> Discipline Metrics</span>
                                </div>
                            </div>
                            <div class="col-lg-4 text-end d-none d-lg-block">
                                <i class="bi bi-robot display-1 opacity-25"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Stats Cards -->
        <div class="row">
            <div class="col-6 col-lg-4 col-md-6">
                <div class="card shadow-sm border-0 bg-primary bg-opacity-10">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                <div class="stats-icon purple mb-2">
                                    <i class="bi bi-people-fill text-white"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Total Pegawai</h6>
                                <h6 class="font-extrabold mb-0">{{ $totalPegawai }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-4 col-md-6">
                <div class="card shadow-sm border-0 bg-info bg-opacity-10">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                <div class="stats-icon blue mb-2">
                                    <i class="bi bi-briefcase-fill text-white"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Pekerjaan Aktif</h6>
                                <h6 class="font-extrabold mb-0">{{ $totalPekerjaan }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-4 col-md-12">
                <div class="card shadow-sm border-0 bg-success bg-opacity-10">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                <div class="stats-icon green mb-2">
                                    <i class="bi bi-camera-reels-fill text-white"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Total Video</h6>
                                <h6 class="font-extrabold mb-0">{{ $totalVideo }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="row mt-4">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header border-bottom-0 pb-0">
                        <h4 class="card-title">Distribusi Kehadiran</h4>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="position: relative; height:300px; width:100%">
                            <canvas id="performanceChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-header border-bottom-0 pb-0">
                        <h4 class="card-title">Komposisi Pegawai</h4>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="position: relative; height:300px; width:100%">
                            <canvas id="employeeChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Employee Table -->
        <div class="card mt-4 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0">Pegawai Terbaru</h4>
                <a href="{{ route('employee') }}" class="btn btn-outline-primary btn-sm">
                    Lihat Semua
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-lg">
                        <thead>
                            <tr class="text-muted">
                                <th>Nama Pegawai</th>
                                <th>Kategori</th>
                                <th class="text-center">Unit Kerja</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pegawai as $person)
                            <tr>
                                <td class="col-4">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md me-3">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($person->nama) }}&background=435ebe&color=fff&bold=true" class="rounded-circle shadow-sm">
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold mb-0" style="font-size: 0.9rem;">{{ $person->nama }}</span>
                                            <small class="text-muted">#{{ str_pad($person->id, 4, '0', STR_PAD_LEFT) }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="col-auto">
                                    @php
                                        $badgeClass = match($person->jenis_presensi) {
                                            'Administrasi' => 'bg-light-warning text-warning',
                                            'Dosen tetap' => 'bg-light-primary text-primary',
                                            'Dosen kontrak' => 'bg-light-secondary text-secondary',
                                            default => 'bg-light-info text-info',
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }} font-bold text-xs" style="font-size: 0.75rem;">
                                        {{ $person->jenis_presensi }}
                                    </span>
                                </td>
                                <td class="col-auto text-center">
                                    <p class="mb-0 text-muted" style="font-size: 0.85rem;">{{ $person->unit_kerja }}</p>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <hr class="my-5 opacity-25">

        <!-- Quick Actions (Pintasan Cepat) -->
        <h5 class="mb-3 ps-1">Pintasan Cepat</h5>
        <div class="row mb-2">
            <div class="col-6 col-lg-2 col-md-4 mb-3">
                <a href="{{ route('live-monitoring') }}" class="card shadow-sm border-0 h-100 text-center p-3 hover-lift text-decoration-none">
                    <div class="stats-icon purple mx-auto mb-2">
                        <i class="bi bi-camera-video-fill text-white"></i>
                    </div>
                    <span class="text-dark small fw-bold">Pantau Live</span>
                </a>
            </div>
            <div class="col-6 col-lg-2 col-md-4 mb-3">
                <a href="{{ route('settings.upload_video') }}" class="card shadow-sm border-0 h-100 text-center p-3 hover-lift text-decoration-none">
                    <div class="stats-icon blue mx-auto mb-2">
                        <i class="bi bi-cloud-arrow-up-fill text-white"></i>
                    </div>
                    <span class="text-dark small fw-bold">Upload CCTV</span>
                </a>
            </div>
            <div class="col-6 col-lg-2 col-md-4 mb-3">
                <a href="{{ route('recorded-videos') }}" class="card shadow-sm border-0 h-100 text-center p-3 hover-lift text-decoration-none">
                    <div class="stats-icon green mx-auto mb-2">
                        <i class="bi bi-collection-play-fill text-white"></i>
                    </div>
                    <span class="text-dark small fw-bold">Rekaman CCTV</span>
                </a>
            </div>
            <div class="col-6 col-lg-2 col-md-4 mb-3">
                <a href="{{ route('discipline-reports-monthly') }}" class="card shadow-sm border-0 h-100 text-center p-3 hover-lift text-decoration-none">
                    <div class="stats-icon red mx-auto mb-2">
                        <i class="bi bi-file-earmark-bar-graph-fill text-white"></i>
                    </div>
                    <span class="text-dark small fw-bold">Laporan bulanan</span>
                </a>
            </div>
            <div class="col-6 col-lg-2 col-md-4 mb-3">
                <a href="{{ route('employee') }}" class="card shadow-sm border-0 h-100 text-center p-3 hover-lift text-decoration-none">
                    <div class="stats-icon orange mx-auto mb-2">
                        <i class="bi bi-people-fill text-white"></i>
                    </div>
                    <span class="text-dark small fw-bold">Data Pegawai</span>
                </a>
            </div>
            <div class="col-6 col-lg-2 col-md-4 mb-3">
                <a href="{{ route('help') }}" class="card shadow-sm border-0 h-100 text-center p-3 hover-lift text-decoration-none">
                    <div class="stats-icon info mx-auto mb-2" style="background-color: #0dcaf0;">
                        <i class="bi bi-question-circle-fill text-white"></i>
                    </div>
                    <span class="text-dark small fw-bold">Bantuan</span>
                </a>
            </div>
        </div>

        <style>
            .hover-lift {
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }
            .hover-lift:hover {
                transform: translateY(-5px);
                box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
            }
        </style>
    </section>

    <!-- Enhanced Chart.js Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const chartFont = {
                family: "'Nunito', sans-serif",
                weight: '600'
            };

            // Bar Chart
            const ctx1 = document.getElementById('performanceChart').getContext('2d');
            new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($grafikLabels) !!},
                    datasets: [{
                        label: 'Total Kehadiran',
                        data: {!! json_encode($grafikData) !!},
                        backgroundColor: '#435ebe',
                        borderRadius: 5,
                        barThickness: 25
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: '#f3f4f6' },
                            ticks: { font: chartFont, color: '#9ca3af' }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { font: chartFont, color: '#9ca3af' }
                        }
                    }
                }
            });

            // Doughnut Chart
            const ctx2 = document.getElementById('employeeChart').getContext('2d');
            new Chart(ctx2, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode(array_keys($komposisiPegawai)) !!},
                    datasets: [{
                        data: {!! json_encode(array_values($komposisiPegawai)) !!},
                        backgroundColor: ['#435ebe', '#55c6e8', '#ff7976', '#5ddab4', '#9694ff'],
                        borderWidth: 2,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 15,
                                font: chartFont,
                                color: '#64748b'
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
