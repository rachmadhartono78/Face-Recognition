<x-maz-sidebar :href="route('dashboard')" :logo="asset('images/logo/logo.png')">

    {{-- <x-maz-sidebar-item name="Dashboard" :link="route('dasbordmonitoring')" icon="bi bi-grid-fill"></x-maz-sidebar-item> --}}
    <x-maz-sidebar-item name="Dashboard" :link="route('nilai-kedisiplinan.index')" icon="bi bi-grid-fill"></x-maz-sidebar-item>
    <x-maz-sidebar-item name="Presensi & Kedisiplinan" icon="bi bi-clock-history">
    <x-maz-sidebar-sub-item name="Presensi Pegawai" :link="route('employee-presence')" icon="bi bi-person-check-fill"></x-maz-sidebar-sub-item>
    <x-maz-sidebar-sub-item name="Nilai Kedisiplinan Harian Pegawai" :link="route('nilai-kedisiplinan.index')" icon="bi bi-file-bar-graph"></x-maz-sidebar-sub-item>
    <x-maz-sidebar-sub-item name="Nilai Kedisiplinan" :link="route('settings.descipline-reports')" icon="bi bi-file-bar-graph"></x-maz-sidebar-sub-item>
    {{-- <x-maz-sidebar-sub-item name="Monitoring Kehadiran" :link="route('attendance-monitoring')" icon="bi bi-calendar-check-fill"></x-maz-sidebar-sub-item> --}}
    </x-maz-sidebar-item>
    <x-maz-sidebar-item name="Data Karyawan" :link="route('employee')" icon="bi bi-people-fill"></x-maz-sidebar-item>
    <x-maz-sidebar-item name="Live Monitoring" :link="route('live-monitoring')" icon="bi bi-tv"></x-maz-sidebar-item>
    <x-maz-sidebar-item name="Recorded Monitoring" :link="route('recorded-videos')" icon="bi bi-camera-video"></x-maz-sidebar-item>
    <x-maz-sidebar-item name="Laporan Kedisiplinan" :link="route('discipline-reports-monthly')" icon="bi bi-file-bar-graph"></x-maz-sidebar-item>
    <x-maz-sidebar-item name="Pengaturan" icon="bi bi-gear">
    <x-maz-sidebar-sub-item name="Pengaturan Treshold" :link="route('pengaturan.index')" icon="bi bi-check-square"></x-maz-sidebar-sub-item>
    <x-maz-sidebar-sub-item name="Jenis Presensi" :link="route('settings.attendance-types')" icon="bi bi-check-square"></x-maz-sidebar-sub-item>
    <x-maz-sidebar-sub-item name="Jam Kerja Khusus" :link="route('settings.special-working-hours')" icon="bi bi-clock"></x-maz-sidebar-sub-item>
    <x-maz-sidebar-sub-item name="Jenis Izin" :link="route('settings.leave-types')" icon="bi bi-file-earmark-text"></x-maz-sidebar-sub-item>
    <x-maz-sidebar-sub-item name="Hari Libur" :link="route('settings.holidays')" icon="bi bi-calendar-event"></x-maz-sidebar-sub-item>
    <x-maz-sidebar-sub-item name="Kriteria Kedisiplinan" :link="route('settings.criteria')" icon="bi bi-calendar-event"></x-maz-sidebar-sub-item>
    <x-maz-sidebar-sub-item name="Pengaaturan Laporan Kedisiplinan" :link="route('settings.descipline-reports')" icon="fas fa-file-alt"></x-maz-sidebar-sub-item>

    </x-maz-sidebar-item>
    <x-maz-sidebar-item name="Bantuan" :link="route('help')" icon="bi bi-question-circle"></x-maz-sidebar-item>


</x-maz-sidebar>
