<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __('Bantuan Informasi') }} --}}
        </h2>
    </x-slot>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Bantuan Informasi</h3>
                    <p class="text-subtitle text-muted">Pertanyaan Umum Seputar UII Dashy</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            {{-- <li class="breadcrumb-item active" aria-current="page">Bantuan Informasi</li> --}}
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="accordion" id="helpAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Bagaimana cara melakukan presensi menggunakan UIIDashy?
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#helpAccordion">
                    <div class="accordion-body">
                        Anda dapat melakukan presensi dengan login ke aplikasi UIIDashy, memilih menu Presensi Masuk atau Keluar, dan memindai wajah menggunakan kamera perangkat Anda.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Ketika melakukan presensi masuk, saya secara tidak sengaja menekan tombol presensi pulang. Apa yang harus saya lakukan untuk mengubah presensi pulang saya?
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#helpAccordion">
                    <div class="accordion-body">
                        Hubungi admin sistem untuk melakukan pengubahan data presensi Anda dengan memberikan bukti yang valid.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Apa yang akan terjadi jika saya tidak melakukan presensi pulang?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#helpAccordion">
                    <div class="accordion-body">
                        Sistem akan mencatat Anda sebagai tidak melakukan presensi pulang, yang dapat memengaruhi nilai disiplin Anda.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        Apa yang harus saya lakukan ketika saya lupa melakukan presensi masuk dan atau presensi pulang?
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#helpAccordion">
                    <div class="accordion-body">
                        Anda dapat membuat pengajuan manual melalui fitur pengajuan presensi yang disediakan oleh sistem.
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
