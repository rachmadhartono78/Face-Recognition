<x-app-layout>
    <x-slot name="header"></x-slot>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h4>Edit Jam Kerja Khusus</h4>
                    <p class="text-subtitle text-muted">Perbarui jadwal jam kerja khusus pegawai.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="#">Pengaturan</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('settings.special-working-hours.index') }}">Jam Kerja Khusus</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="text-lg font-bold mb-4">Form Edit Jam Kerja Khusus</h4>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('settings.special-working-hours.update', $data->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <input type="text" name="keterangan" class="form-control" value="{{ old('keterangan', $data->keterangan) }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Berlaku</label>
                            <div class="row">
                                <div class="col">
                                    <input type="date" name="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai', $data->tanggal_mulai) }}" required>
                                </div>
                                <div class="col">
                                    <input type="date" name="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai', $data->tanggal_selesai) }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jam Masuk</label>
                            <input type="time" name="jam_masuk" class="form-control" value="{{ old('jam_masuk', $data->jam_masuk) }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jam Keluar</label>
                            <input type="time" name="jam_keluar" class="form-control" value="{{ old('jam_keluar', $data->jam_keluar) }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jam Kerja</label>
                            <input type="number" name="jam_kerja" class="form-control" value="{{ old('jam_kerja', $data->jam_kerja) }}" required>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                        <a href="{{ route('settings.special-working-hours.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
