<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Live Monitoring</h3>
                <p class="text-subtitle text-muted">Pantau aktivitas secara langsung menggunakan streaming video.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Live Monitoring</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>

    <div class="section">
        <div class="row">
            <div class="col-12 col-lg-9">
                <div class="card shadow-sm border-0">
                    <div class="card-header border-bottom-0 d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Streaming Kamera Pengawas</h4>
                        <div class="d-flex align-items-center">
                            <span class="badge bg-light-success text-success me-2">
                                <i class="bi bi-record-circle me-1"></i> Live Stream Active
                            </span>
                            <span class="badge bg-light-primary text-primary">
                                <i class="bi bi-shield-check me-1"></i> AI Recognition On
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="video-container overflow-hidden rounded-4 bg-dark shadow-inset" style="position: relative; padding-bottom: 56.25%; height: 0;">
                            @if(isset($flaskUrl))
                                <iframe 
                                    id="stream-iframe"
                                    src="{{ $flaskUrl }}" 
                                    frameborder="0" 
                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"
                                    allowfullscreen
                                    class="rounded-4">
                                </iframe>
                                <div class="stream-overlay" style="position: absolute; top: 20px; right: 20px; pointer-events: none;">
                                    <div class="d-flex flex-column align-items-end gap-2 text-white">
                                        <div class="px-2 py-1 rounded bg-dark bg-opacity-50" style="font-size: 0.75rem;">
                                            <i class="bi bi-clock me-1"></i> <span id="current-time"></span>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="position-absolute top-50 start-50 translate-middle text-center text-white">
                                    <i class="bi bi-camera-video-off fs-1 mb-3"></i>
                                    <p>URL Streaming tidak ditemukan atau API tidak aktif.</p>
                                    <button class="btn btn-primary btn-sm mt-2">
                                        <i class="bi bi-arrow-clockwise"></i> Coba Lagi
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-12 col-lg-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header border-bottom-0 pb-0">
                        <h4 class="card-title">Informasi Stream</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column gap-3">
                            <div class="info-item">
                                <label class="text-muted small d-block mb-1">Lokasi Kamera</label>
                                <span class="fw-bold"><i class="bi bi-geo-alt text-primary me-2"></i> Area Parkir Gedung A</span>
                            </div>
                            <div class="info-item">
                                <label class="text-muted small d-block mb-1">Kualitas</label>
                                <span class="fw-bold"><i class="bi bi-hd text-success me-2"></i> HD 1080p (30 FPS)</span>
                            </div>
                            <div class="info-item pt-3 border-top">
                                <p class="text-muted small mb-0">Panel ini memantau aktivitas pengenalan wajah secara real-time. Pastikan pencahayaan cukup untuk akurasi terbaik.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Update clock in overlay
        function updateClock() {
            const now = new Date();
            const timeStr = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
            const dateStr = now.toLocaleDateString('id-ID', { day: '2-digit', month: 'short' });
            const clockEl = document.getElementById('current-time');
            if (clockEl) clockEl.textContent = `${dateStr}, ${timeStr}`;
        }
        setInterval(updateClock, 1000);
        updateClock();

        document.addEventListener("visibilitychange", function() {
            const iframe = document.getElementById('stream-iframe');
            if (!iframe) return;

            if (document.hidden) {
                console.log("Tab tidak aktif, menghentikan stream untuk menghemat resource...");
                iframe.dataset.src = iframe.src; // Simpan URL
                iframe.src = ""; // Stop stream
            } else {
                console.log("Tab aktif kembali, memulihkan stream...");
                if (iframe.dataset.src) {
                    iframe.src = iframe.dataset.src; // Restore stream
                }
            }
        });
    </script>
    @endpush
</x-app-layout>
