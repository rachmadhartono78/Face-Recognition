<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Dashboard</h3>
                <!-- <p class="text-subtitle text-muted">This is the main page.</p> -->
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>

    
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Selamat Datang di Aplikasi UII Dashy</h4>
            </div>
            <div class="card-body">
                <strong>UII Dashy</strong>
                adalah platform inovatif yang dirancang untuk membantu memonitor kedisiplinan
                pegawai dengan teknologi modern Face Recognition.
<!-- 
                <blockquote style="font-style: italic;">
                    “Disiplin adalah jembatan antara tujuan dan pencapaian.”
                </blockquote> -->
            </div>

            <div class="card-body">
                <h5>Fitur Utama</h5>
                <ul>
                    <li><strong>Face Recognition</strong> untuk identifikasi otomatis kehadiran pegawai.</li>
                    <li><strong>Dashboard Informasi</strong> yang menampilkan data monitoring kedisiplinan secara visual dan interaktif.</li>
                    <li><strong>Penilaian Kedisiplinan Pegawai</strong> sebagai data pendukung penilaian akhir pegawai.</li>
                </ul>
            </div>
        </div>
    </section>
</x-app-layout>
