<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Monitoring Pegawai') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Dropdown Filters -->
        <div class="bg-white shadow rounded-lg p-6 mb-6 flex justify-between items-center">
            <div>
                <label for="jenis-data" class="block text-gray-600 font-medium">Jenis Data</label>
                <select id="jenis-data" class="form-select mt-1 block w-full">
                    <option value="semua">Semua</option>
                    <option value="kehadiran">Kehadiran</option>
                    <option value="kedisiplinan">Kedisiplinan</option>
                </select>
            </div>
            <div>
                <label for="status-data" class="block text-gray-600 font-medium">Status Data</label>
                <select id="status-data" class="form-select mt-1 block w-full">
                    <option value="semua">Semua</option>
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Nonaktif</option>
                </select>
            </div>
            <div>
                <label for="tanggal" class="block text-gray-600 font-medium">Pilih Bulan</label>
                <input type="month" id="tanggal" class="form-input mt-1 block w-full" />
            </div>
        </div>

        <!-- Statistik Kehadiran -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-blue-100 p-6 shadow rounded-lg text-center">
                <h4 class="text-blue-800 font-semibold">Total Pegawai</h4>
                <p class="text-3xl font-bold text-blue-800 mt-2">{{ $totalPegawai }}</p>
            </div>
            <div class="bg-green-100 p-6 shadow rounded-lg text-center">
                <h4 class="text-green-800 font-semibold">Hadir Hari Ini</h4>
                <p class="text-3xl font-bold text-green-800 mt-2">{{ $kehadiranHariIni }}</p>
            </div>
            <div class="bg-yellow-100 p-6 shadow rounded-lg text-center">
                <h4 class="text-yellow-800 font-semibold">Terlambat Hari Ini</h4>
                <p class="text-3xl font-bold text-yellow-800 mt-2">{{ $pegawaiTerlambat }}</p>
            </div>
            <div class="bg-red-100 p-6 shadow rounded-lg text-center">
                <h4 class="text-red-800 font-semibold">Tidak Hadir</h4>
                <p class="text-3xl font-bold text-red-800 mt-2">{{ $tidakHadirHariIni }}</p>
            </div>
        </div>

        <!-- Tab Navigasi -->
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex justify-between border-b border-gray-200">
                <button id="tab-grafik" class="px-4 py-2 text-blue-500 border-b-2 border-blue-500 focus:outline-none">Grafik</button>
                <button id="tab-tabel" class="px-4 py-2 text-gray-500 focus:outline-none">Tabel</button>
            </div>

            <!-- Grafik Kehadiran Mingguan -->
            <div id="grafik-section" class="mt-6">
                <h4 class="text-gray-600 mb-4 font-semibold">Grafik Kehadiran Mingguan</h4>
                <canvas id="weeklyAttendanceChart" style="height: 300px;"></canvas>
            </div>

            <!-- Tabel Kehadiran -->
            <div id="tabel-section" class="hidden mt-6">
                <h4 class="text-gray-600 mb-4 font-semibold">Tabel Kehadiran</h4>
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 text-left">Tanggal</th>
                            <th class="py-2 px-4 text-left">Jumlah Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($statistikMingguan as $statistik)
                            <tr>
                                <td class="py-2 px-4">{{ \Carbon\Carbon::parse($statistik->tanggal)->format('d M Y') }}</td>
                                <td class="py-2 px-4">{{ $statistik->total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Script untuk Grafik -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const weeklyLabels = {!! json_encode($statistikMingguan->pluck('tanggal')->map(fn($date) => \Carbon\Carbon::parse($date)->format('d M'))) !!};
        const weeklyData = {!! json_encode($statistikMingguan->pluck('total')) !!};

        const ctx = document.getElementById('weeklyAttendanceChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: weeklyLabels,
                datasets: [{
                    label: 'Jumlah Kehadiran',
                    data: weeklyData,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                },
                scales: {
                    x: { grid: { display: false } },
                    y: { grid: { color: 'rgba(200, 200, 200, 0.2)' } }
                }
            }
        });

        // Tab Navigasi
        document.getElementById('tab-grafik').addEventListener('click', () => {
            document.getElementById('grafik-section').classList.remove('hidden');
            document.getElementById('tabel-section').classList.add('hidden');
        });

        document.getElementById('tab-tabel').addEventListener('click', () => {
            document.getElementById('grafik-section').classList.add('hidden');
            document.getElementById('tabel-section').classList.remove('hidden');
        });
    </script>
</x-app-layout>
