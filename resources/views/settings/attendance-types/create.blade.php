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
                    <h4 class="text-lg font-bold mb-4">Form Tambah Jenis Presensi Pegawai</h4>

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

                    <form action="{{ route('settings.attendance-types.store') }}" method="POST">
                        @csrf

                        <!-- Jenis Presensi Pegawai -->
                        <div class="mb-3">
                            <label class="form-label">Jenis Presensi Pegawai</label>
                            <input type="text" name="nama" class="form-control" placeholder="Contoh: Satpam, Dosen, Pegawai Kantor" required>
                        </div>

                        <!-- Tipe Jam Kerja -->
                        <div class="mb-3">
                            <label class="form-label">Tipe Jam Kerja</label>
                            <select name="tipe_jam_kerja" class="form-select" required>
                                <option value="Normal">Normal</option>
                                <option value="Shift">Shift</option>
                            </select>
                        </div>

                        <!-- Form Izin & Lembur -->
                        <div class="mb-3">
                            <label class="form-label">Form Izin & Lembur</label>
                            <select name="form_izin_lembur" class="form-select" required>
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                        </div>

                        <!-- Jam Kerja -->
                        <div class="mb-3">
                            <label class="form-label">Jam Kerja</label>
                            <textarea name="jam_kerja" class="form-control" rows="3" placeholder="Contoh: Shift pagi: 06:30 - 14:30&#10;Shift siang: 10:30 - 18:30" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="{{ route('settings.attendance-types.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
