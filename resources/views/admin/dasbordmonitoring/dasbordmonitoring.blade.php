<x-app-layout>
    <x-slot name="header">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Dashboard</h3>
            <p class="text-subtitle text-muted">Halaman Utama Monitoring Pegawai UII</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    {{-- <li class="breadcrumb-item active" aria-current="page">Dashboard</li> --}}
                </ol>
            </nav>
        </div>
    </div>
</x-slot>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Karyawan</h6>
                                    <h6 class="font-extrabold mb-0">5</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Total Pekerjaan</h6>
                                    <h6 class="font-extrabold mb-0">5</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon green mb-2">
                                        <i class="iconly-boldAdd-User"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Unit Kerja</h6>
                                    <h6 class="font-extrabold mb-0">6</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon red mb-2">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Total Video</h6>
                                    <h6 class="font-extrabold mb-0">3</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Rata Rata Kinerja Karyawan</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="chart-profile-visit"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                // Data untuk grafik (disesuaikan dengan kebutuhan)
                var dataRataKinerja = {
                    labels: ["Huda", "Willy", "Anton", "Gana"],
                    datasets: [{
                        label: 'Rata-rata Kinerja',
                        data: [50, 80, 60, 70],
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                };

                // Opsi untuk grafik
                var optionsRataKinerja = {
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100
                        }
                    }
                };

                // Menggambar grafik menggunakan Chart.js
                var ctxRataKinerja = document.getElementById('chart-profile-visit').getContext('2d');
                var chartRataKinerja = new Chart(ctxRataKinerja, {
                    type: 'bar',
                    data: dataRataKinerja,
                    options: optionsRataKinerja
                });
            </script>

            <div class="row">
                <div class="col-12 col-xl-4">
                </div>
                <div class="col-12 col-xl-14">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Kinerja Karyawan</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-lg">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Jabatan</th>
                                            <th>Kinerja</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="col-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-md">
                                                        <img src="assets/static/images/faces/5.jpg">
                                                    </div>
                                                    <p class="font-bold ms-3 mb-0">Huda</p>
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <p class=" mb-0">Junior Developer</p>
                                            </td>
                                            <td class="col-auto">
                                                <p class=" mb-0">50</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-md">
                                                        <img src="assets/static/images/faces/2.jpg">
                                                    </div>
                                                    <p class="font-bold ms-3 mb-0">Willy</p>
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <p class=" mb-0">Designer</p>
                                            </td>
                                            <td class="col-auto">
                                                <p class=" mb-0">80</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-md">
                                                        <img src="assets/static/images/faces/8.jpg">
                                                    </div>
                                                    <p class="font-bold ms-3 mb-0">Anton</p>
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <p class=" mb-0">System Analyst</p>
                                            </td>
                                            <td class="col-auto">
                                                <p class=" mb-0">60</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-md">
                                                        <img src="assets/static/images/faces/3.jpg">
                                                    </div>
                                                    <p class="font-bold ms-3 mb-0">Gana</p>
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <p class=" mb-0">Project Manager</p>
                                            </td>
                                            <td class="col-auto">
                                                <p class=" mb-0">70</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body py-4 px-4">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            <img src="assets/static/images/faces/1.jpg" alt="Face 1">
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold">Admin</h5>
                            <h6 class="text-muted mb-0">112344</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Visitors Profile</h4>
                </div>
                <div class="card-body">
                    <div id="chart-visitors-profile"></div>
                </div>
            </div>
        </div> --}}
    </section>
</div>
</x-app-layout>


