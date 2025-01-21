<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Monitoring Pegawai') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg p-6">
            <h4 class="text-gray-600 mb-4">Grafik Kehadiran Mingguan</h4>
            <canvas id="attendanceChart" style="height: 300px;"></canvas>
        </div>
    </div>

    <!-- Script untuk memanggil grafik -->
    <script src="{{ asset('js/charts.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            renderChart('attendanceChart', "{{ route('chart.data') }}");
        });
    </script>
</x-app-layout>
