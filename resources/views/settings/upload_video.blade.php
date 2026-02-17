<x-app-layout>
    <x-slot name="header"></x-slot>
    
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Upload Rekaman CCTV</h3>
            <p class="text-subtitle text-muted">Unggah file video hasil rekaman untuk dianalisis oleh AI.</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Pengaturan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Upload Video</li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="section mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header border-bottom-0">
                        <h4 class="card-title">Form Unggah Video</h4>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-light-success color-success alert-dismissible show fade">
                                <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-light-danger color-danger alert-dismissible show fade">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li><i class="bi bi-exclamation-triangle me-2"></i> {{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('settings.store_video') }}" method="POST" enctype="multipart/form-data" class="mt-3">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="title" class="form-label font-bold">Judul Video CCTV</label>
                                <div class="form-group position-relative has-icon-left">
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Contoh: CCTV Area Parkir - 13 Nov 2023" required>
                                    <div class="form-control-icon">
                                        <i class="bi bi-fonts"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="description" class="form-label font-bold">Deskripsi</label>
                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Tambahkan catatan singkat mengenai isi rekaman..."></textarea>
                            </div>

                            <div class="form-group mb-4">
                                <label for="video" class="form-label font-bold">Pilih File Video</label>
                                <input type="file" class="form-control" id="video" name="video" accept="video/*" required>
                                <p class="text-muted small mt-2">
                                    <i class="bi bi-info-circle me-1"></i> Format yang didukung: <code>.mp4, .mov, .avi</code>. Maksimal ukuran file: 50MB.
                                </p>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm">
                                    <i class="bi bi-cloud-arrow-up me-2"></i> Unggah Sekarang
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
