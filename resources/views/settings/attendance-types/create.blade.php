<x-app-layout>
    <x-slot name="header"></x-slot>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h4>Tambah Jenis Presensi Pegawai</h4>
                </div>
            </div>
        </div>

        <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('settings.attendance-types.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Jenis Presensi Pegawai</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="{{ route('settings.attendance-types.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
