<x-app-layout>
    <x-slot name="header"></x-slot>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h4>Monitoring Decipline Employee From Recording CCTV</h4>
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
        </div>

        <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8 grid gap-6 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1">
            <div class="space-y-4">
                @foreach ($recentVideos as $video)
                    <div class="flex items-center space-x-4 bg-gray-100 p-4 rounded-lg shadow-md">
                        {{-- <img 
                            src="{{$video->thumbnail ?? asset('images/2024-12-31.jpg') }}" 
                            alt="Thumbnail {{ $video->title }}" 
                            class="w-32 h-20 object-cover rounded-md"> --}}
                        {{-- <img 
                            src="{{ asset('thumbnails/' . $video->thumbnail) }}" 
                            alt="Thumbnail {{ $video->title }}" 
                            class="w-32 h-20 object-cover rounded-md"> --}}
                        {{-- <img 
                            src="{{$video->thumbnail ?? asset('thumbnails/2025-01-03.jpg') }}" 
                            alt="Thumbnail {{ $video->title }}" 
                            class="w-32 h-20 sm:w-40 sm:h-24 md:w-48 md:h-32 object-contain rounded-md"> --}}
                        <img 
                            src="{{$video->thumbnail ?? asset('thumbnails/2025-01-03.jpg') }}" 
                            alt="Thumbnail {{ $video->title }}" 
                            class="w-32 h-20 sm:w-40 sm:h-24 md:w-48 md:h-32 object-cover rounded-md">
                        
                        
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
