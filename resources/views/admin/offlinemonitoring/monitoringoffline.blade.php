<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Monitoring CCTV') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3>Video Monitoring CCTV</h3>
                    <div class="video-container">
                        <iframe
                            src="https://drive.google.com/file/d/1j9AxDSc3x2COx9-DyWauTPqa-Dt_ZXQU/view?usp=drive_link"
                            width="100%"
                            height="480"
                            frameborder="0"
                            allow="autoplay"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
