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

    <div class="container mx-auto px-8 py-12">
        <!-- Video Stream Section -->
        <div class="bg-white shadow rounded-lg p-6">
            <h4 class="text-lg font-bold mb-4">Streaming Video</h4>
            <div class="video-stream">
                @if(isset($flaskUrl))
                    <iframe 
                        src="{{ $flaskUrl }}" 
                        frameborder="0" 
                        width="100%" 
                        height="500px" 
                        allowfullscreen>
                    </iframe>
                @else
                    <p class="text-gray-500">URL Streaming belum tersedia.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
