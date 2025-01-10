<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Playback Video - {{ $video->title }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="text-2xl font-bold mb-4">{{ $video->title }}</h1>
                <p class="text-gray-500 mb-6">{{ $video->description }}</p>

                <!-- Video Playback -->
                <div class="aspect-w-16 aspect-h-9 bg-gray-200 rounded-lg overflow-hidden">
                    <video controls class="w-full h-full">
                        <source src="{{ asset($video->file_path) }}" type="video/mp4">
                        Browser Anda tidak mendukung pemutar video.
                    </video>
                </div>

                <!-- Metadata -->
                <div class="mt-4">
                    <p class="text-gray-400">Tanggal Rekam: {{ $video->recorded_at->format('d M Y, H:i') }}</p>
                    <p class="text-gray-400">Durasi: {{ gmdate('H:i:s', $video->duration) }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
