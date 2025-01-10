<x-app-layout>
    <x-slot name="header"></x-slot>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Monitoring CCTV</h3>
                    {{-- <p class="text-muted">Monitoring Video KPI Pegawai</p> --}}
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Monitoring CCTV</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8 grid gap-6 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1">
            <!-- Live Monitoring -->
            <div class="lg:col-span-2 bg-white p-5 rounded-lg shadow-lg">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold">CCTV LIVE</h2>
                    <span class="text-blue-500">Camera Ruangan 1</span>
                </div>
                <div class="aspect-w-16 aspect-h-9 bg-gray-200 rounded-lg overflow-hidden">
                    <video controls class="w-full h-full">
                        <source src="{{ asset('videos/live-feed.mp4') }}" type="video/mp4">
                        Browser Anda tidak mendukung pemutar video.
                    </video>
                </div>
                <div class="mt-4">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-lg">LIVE</button>
                </div>
            </div>

            <!-- Recent Videos -->
            {{-- <div class="bg-white p-5 rounded-lg shadow-lg">
                <h2 class="text-xl font-semibold mb-4">Video CCTV Terbaru</h2>
                <div class="space-y-4">
                    @foreach ($recentVideos as $video)
                        <div class="flex items-center space-x-4 bg-gray-100 p-4 rounded-lg shadow-md">
                            <img 
                                src="{{ $video->thumbnail ?? asset('images/default-thumbnail.jpg') }}" 
                                alt="Thumbnail {{ $video->title }}" 
                                class="w-32 h-20 object-cover rounded-md">
                            <div>
                                <h3 class="text-lg font-semibold">{{ $video->title }}</h3>
                                <p class="text-gray-500 text-sm">{{ $video->description }}</p>
                                <a 
                                    href="{{ route('recorded-videos.playback', $video->id) }}" 
                                    class="text-blue-500 hover:underline mt-2 block">
                                    Tonton Video
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">
                    {{ $recentVideos->links() }}
                </div>
            </div> --}}

            <div class="space-y-4">
                @foreach ($recentVideos as $video)
                    <div class="flex items-center space-x-4 bg-gray-100 p-4 rounded-lg shadow-md">
                        <img 
                            src="{{ $video->thumbnail ?? asset('images/default-thumbnail.jpg') }}" 
                            alt="Thumbnail {{ $video->title }}" 
                            class="w-32 h-20 object-cover rounded-md">
                        <div>
                            <h3 class="text-lg font-semibold">{{ $video->title }}</h3>
                            <p class="text-gray-500 text-sm">{{ $video->description }}</p>
                            <a 
                                href="{{ route('recorded-videos.playback', $video->id) }}" 
                                class="text-blue-500 hover:underline mt-2 block">
                                Tonton Video
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            
        </div>
    </div>
</x-app-layout>
