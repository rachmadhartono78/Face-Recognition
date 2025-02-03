<x-app-layout>
                <x-slot name="header">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h3>Dashboard</h3>
                            <p class="text-subtitle text-muted">Ringkasan Kinerja Pegawai</p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </x-slot>

                <div class="container py-4">
                    <div class="row g-3 mb-4">
                        <div class="col-md-4 col-lg-2">
                            <div class="card bg-danger h-100 shadow-sm">
                                <div class="card-body d-flex flex-column justify-center align-items-center">
                                    <h5 class="card-title text-center text-white fw-bold">Total Pegawai</h5>
                                    <p class="card-text fs-4 text-center text-white fw-bold">{{ $totalPegawai }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-2">
                            <div class="card bg-primary h-100 shadow-sm">
                                <div class="card-body d-flex flex-column justify-center align-items-center">
                                    <h5 class="card-title text-center text-white fw-bold">Total Pekerjaan</h5>
                                    <p class="card-text fs-4 text-center text-white fw-bold">{{ $totalPekerjaan }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-2">
                            <div class="card bg-success h-100 shadow-sm">
                                <div class="card-body d-flex flex-column justify-center align-items-center">
                                    <h5 class="card-title text-center text-white fw-bold">Total Video</h5>
                                    <p class="card-text fs-4 text-center text-white fw-bold">{{ $totalVideo }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
        
                <!-- Grafik -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                    <div class="bg-white p-6 rounded-xl shadow col-span-2">
                        <h2 class="text-lg font-bold text-gray-800">Rata-Rata Kinerja Pegawai</h2>
                        <div class="relative w-full h-[300px]">
                            <canvas id="performanceChart"></canvas>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow">
                        <h2 class="text-lg font-bold text-gray-800">Komposisi Pegawai</h2>
                        <div class="relative w-full h-[300px]">
                            <canvas id="employeeChart"></canvas>
                        </div>
                    </div>
                </div>
        
                <!-- Daftar Pegawai -->
                <div class="bg-white p-6 rounded-xl shadow mt-6">
                    <h2 class="text-lg font-bold text-gray-800">Daftar Pegawai</h2>
                    <table class="w-full mt-4 border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600 text-sm">
                                <th class="p-3 text-left">Nama Pegawai</th>
                                <th class="p-3 text-left">Jabatan</th>
                                <th class="p-3 text-left">Kinerja</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pegawai as $person)
                            <tr class="border-t">
                                <td class="p-3 flex items-center gap-3">
                                    <img src="https://i.pravatar.cc/40?u={{ $person->id }}" class="w-10 h-10 rounded-full">
                                    <span class="text-gray-700 font-medium">{{ $person->nama }}</span>
                                </td>
                                <td class="p-3">{{ $person->jenis_presensi }}</td>
                                <td class="p-3 text-center">{{ $person->unit_kerja }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
</x-app-layout>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Chart Kinerja Pegawai
    const ctx1 = document.getElementById('performanceChart').getContext('2d');
    new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: {!! json_encode($grafikLabels) !!},
            datasets: [{
                label: 'Kinerja (%)',
                data: {!! json_encode($grafikData) !!},
                backgroundColor: '#3742fa'
            }]
        }
    });

    // Chart Komposisi Pegawai
    const ctx2 = document.getElementById('employeeChart').getContext('2d');
        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: ['Administrasi', 'Dosen Tetap', 'Dosen Kontrak', 'Tenaga Pendukung'],
                datasets: [{
                    data: {!! json_encode(array_values($komposisiPegawai)) !!},
                    backgroundColor: ['#e74c3c', '#1e90ff', '#f1c40f', '#2ecc71']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
</script>
