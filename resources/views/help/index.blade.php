<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __('Bantuan Informasi') }} --}}
        </h2>
    </x-slot>

    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Pusat Bantuan & Informasi</h3>
            <p class="text-subtitle text-muted">Panduan lengkap mengenai alur bisnis dan penggunaan sistem Face Recognition.</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Bantuan</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="section mt-4">
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="stats-icon purple me-3">
                                <i class="bi bi-info-circle-fill text-white"></i>
                            </div>
                            <h4 class="card-title mb-0">Ringkasan Sistem</h4>
                        </div>
                        <p class="text-muted small">Sistem ini menggunakan AI Face Recognition untuk memantau kedisiplinan pegawai secara real-time maupun melalui rekaman CCTV.</p>
                        <ul class="list-group list-group-flush mt-3">
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span>Batas Waktu Masuk</span>
                                <span class="badge bg-light-primary text-primary">08:00 WIB</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span>Format Video</span>
                                <span class="badge bg-light-info text-info">MP4, MOV, AVI</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-8">
                <div class="accordion accordion-flush shadow-sm rounded-4 overflow-hidden" id="helpAccordion">
                    <!-- Section 1: Presensi & AI -->
                    <div class="accordion-item border-0">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button font-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                <i class="bi bi-robot me-3 text-primary"></i> Bagaimana Alur Presensi Berbasis AI Bekerja?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#helpAccordion">
                            <div class="accordion-body text-muted">
                                Sistem secara otomatis mendeteksi wajah melalui stream kamera. Jika wajah dikenali dan terdaftar dalam database Pegawai, sistem akan mencatat jam masuk secara otomatis tanpa perlu interaksi manual.
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Aturan Penilaian -->
                    <div class="accordion-item border-0">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed font-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                <i class="bi bi-star-fill me-3 text-warning"></i> Bagaimana Perhitungan Poin Kedisiplinan?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                            <div class="accordion-body text-muted">
                                Penilaian didasarkan pada waktu kedatangan:
                                <ul class="mt-2">
                                    <li><strong>Tepat Waktu (1.0 Poin):</strong> Absensi dilakukan sebelum atau tepat pukul <strong>08:00:00 WIB</strong>.</li>
                                    <li><strong>Terlambat (0.5 Poin):</strong> Absensi dilakukan setelah pukul <strong>08:00:01 WIB</strong>.</li>
                                </ul>
                                Akumulasi poin ini akan muncul dalam Laporan Kedisiplinan Bulanan.
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Monitoring -->
                    <div class="accordion-item border-0">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed font-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                <i class="bi bi-camera-video-fill me-3 text-danger"></i> Apa Perbedaan Live Monitoring dan Recorded Video?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                            <div class="accordion-body text-muted">
                                <ul>
                                    <li><strong>Live Monitoring:</strong> Pantauan langsung (real-time) dari kamera yang terhubung ke server AI. Berguna untuk pengawasan aktif di lokasi.</li>
                                    <li><strong>Recorded Video:</strong> File rekaman CCTV yang diunggah secara manual untuk dianalisis oleh sistem secara retrospektif (melihat kejadian yang sudah lewat).</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Section 4: Laporan & Export -->
                    <div class="accordion-item border-0">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed font-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                                <i class="bi bi-file-earmark-pdf-fill me-3 text-info"></i> Bagaimana Cara Mengunduh Laporan Kedisiplinan?
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                            <div class="accordion-body text-muted">
                                Anda dapat mengunduh laporan melalui menu <strong>Laporan Kedisiplinan</strong>. Pilih periode bulan yang diinginkan, lalu klik tombol <strong>Print Laporan</strong> untuk menghasilkan file PDF yang berisi rekapitulasi kehadiran, total jam kerja, dan poin masing-masing pegawai.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="alert alert-light-primary mt-4 border-0 shadow-sm">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-person-badge-fill fs-2 me-3 text-primary"></i>
                        <div>
                            <h6 class="alert-heading mb-1">Butuh bantuan teknis lebih lanjut?</h6>
                            <p class="mb-0 small">Hubungi Admin Sistem atau IT Support jika terjadi kendala pada sinkronisasi kamera atau deteksi wajah.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
