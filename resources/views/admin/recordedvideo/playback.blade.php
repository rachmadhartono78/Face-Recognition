<x-app-layout>
    <x-slot name="header"></x-slot>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h4>Monitoring Discipline Employee From Recording CCTV</h4>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            {{-- <li class="breadcrumb-item"><a href="{{ route('recorded-videos.index') }}">Recorded Videos</a></li>
                             --}}
                             <li class="breadcrumb-item"><a href="{{ route('recorded-videos.playback', ['id' => $video->id]) }}">Recorded Videos</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Playback</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Tombol Kembali -->
            <a href="{{ route('recorded-videos') }}" class="btn btn-primary mb-4">Kembali ke Daftar Video</a>

            <!-- Video Playback Section -->
            <div class="space-y-4">
                <div class="flex flex-col items-start bg-gray-100 p-4 rounded-lg shadow-md">
                    <h3 class="text-lg font-bold mb-4">{{ $video->title }}</h3>
                    <p class="text-gray-500 mb-4">{{ $video->description }}</p>

                    <!-- Video Playback -->
                    <div class="ratio ratio-16x9 bg-gray-200 rounded-lg overflow-hidden w-full">
                        <div id="video-loader" class="text-center py-4">
                            <p class="text-gray-500">Memuat video...</p>
                        </div>
                        <video controls class="w-full h-full" onloadeddata="document.getElementById('video-loader').style.display='none';">
                            <source src="{{ asset($video->file_path) }}" type="video/mp4">
                            Video tidak dapat diputar. Pastikan file tersedia di server.
                        </video>
                    </div>

                    <!-- Metadata -->
                    <div class="mt-4">
                        <p class="text-gray-400">Tanggal Rekam: {{ optional($video->recorded_at)->format('d M Y, H:i') ?? 'Tidak tersedia' }}</p>
                        <p class="text-gray-400">Durasi: {{ $video->duration ? gmdate('H:i:s', $video->duration) : 'Tidak tersedia' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
