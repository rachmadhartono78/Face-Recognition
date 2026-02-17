<x-app-layout>
    <x-slot name="header"></x-slot>
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Rekaman CCTV & Monitoring</h3>
            <p class="text-subtitle text-muted">Daftar rekaman video untuk pemantauan kedisiplinan dan keamanan.</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Recorded CCTV</li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="section mt-4">
        <div class="row">
            @forelse ($recentVideos as $video)
                <div class="col-xl-4 col-md-6 col-sm-12 mb-4">
                    <div class="card shadow-sm border-0 h-100 transition-hover">
                        <div class="position-relative">
                            <img 
                                src="{{ $video->thumbnail ?? asset('thumbnails/2025-01-03.jpg') }}" 
                                alt="Thumbnail {{ $video->title }}" 
                                class="card-img-top rounded-top-4 object-cover"
                                style="height: 200px;"
                            >
                            <div class="position-absolute top-50 start-50 translate-middle opacity-0 hover-opacity-100 transition-all">
                                <a href="{{ route('recorded-videos.playback', $video->id) }}" class="btn btn-primary btn-lg rounded-circle p-3">
                                    <i class="bi bi-play-fill fs-3"></i>
                                </a>
                            </div>
                            <span class="position-absolute bottom-0 end-0 m-2 badge bg-dark bg-opacity-75">
                                <i class="bi bi-clock me-1"></i> {{ $video->duration ?? '--:--' }}
                            </span>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title mb-0 text-truncate" title="{{ $video->title }}">{{ $video->title }}</h5>
                                <span class="badge bg-light-info text-info small">CCTV</span>
                            </div>
                            <p class="card-text text-muted small flex-grow-1 mb-3">
                                {{ Str::limit($video->description, 80) }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <span class="text-muted small">
                                    <i class="bi bi-calendar-event me-1"></i> {{ $video->created_at->format('d M Y') }}
                                </span>
                                <a href="{{ route('recorded-videos.playback', $video->id) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                    Tonton <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 py-5 text-center">
                    <div class="p-5 bg-light rounded-4 border border-dashed text-muted">
                        <i class="bi bi-camera-video-off fs-1 mb-3"></i>
                        <h5>Belum ada rekaman video</h5>
                        <p class="mb-0">Rekaman akan muncul di sini setelah sistem menangkap aktivitas.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $recentVideos->links() }}
        </div>
    </section>

    <style>
        .transition-hover {
            transition: all 0.3s ease;
        }
        .transition-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }
        .hover-opacity-100 {
            opacity: 1 !important;
        }
        .rounded-top-4 {
            border-top-left-radius: 0.75rem !important;
            border-top-right-radius: 0.75rem !important;
        }
        .object-cover {
            object-fit: cover;
        }
    </style>
</x-app-layout>
