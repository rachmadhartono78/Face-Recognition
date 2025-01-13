<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Presensi Harian Pegawai</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Presensi Pegawai</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>

    <div class="container py-4">
        <!-- Tabel Data Presensi -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="card-title">Data Presensi Pegawai</h4>
                <div class="table-responsive mt-4">
                    <table class="table table-bordered table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Jam Pulang</th>
                                <th>Total Jam</th>
                                <th>Working Hours</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($presensi as $item)
                                <tr>
                                    <td>{{ $loop->iteration + ($presensi->currentPage() - 1) * $presensi->perPage() }}</td>
                                    <td>{{ $item->nip }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->jam_masuk ?? '-' }}</td>
                                    <td>{{ $item->jam_pulang ?? '-' }}</td>
                                    <td>{{ $item->total_jam ?? '-' }}</td>
                                    <td>{{ $item->working_hours ?? '-' }}</td>
                                    <td>
                                        <span class="badge {{ $item->keterangan === 'Libur' ? 'bg-danger' : ($item->keterangan === 'Tepat waktu' ? 'bg-success' : 'bg-warning') }}">
                                            {{ $item->keterangan }}
                                        </span>
                                    </td>
                                    <td>
                                        <!-- Tombol Lihat -->
                                        <button 
                                            class="btn btn-primary btn-sm" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modalLihat"
                                            data-id="{{ $item->id }}" 
                                            data-nip="{{ $item->nip }}"
                                            data-tanggal="{{ $item->tanggal }}"
                                            data-jam-masuk="{{ $item->jam_masuk }}"
                                            data-jam-pulang="{{ $item->jam_pulang }}"
                                            data-total-jam="{{ $item->total_jam }}"
                                            data-working-hours="{{ $item->working_hours }}"
                                            data-keterangan="{{ $item->keterangan }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <!-- Tombol Edit -->
                                        <button 
                                            class="btn btn-warning btn-sm"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modalEdit"
                                            data-id="{{ $item->id }}" 
                                            data-nip="{{ $item->nip }}"
                                            data-tanggal="{{ $item->tanggal }}"
                                            data-jam-masuk="{{ $item->jam_masuk }}"
                                            data-jam-pulang="{{ $item->jam_pulang }}"
                                            data-keterangan="{{ $item->keterangan }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $presensi->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Lihat -->
    <div class="modal fade" id="modalLihat" tabindex="-1" aria-labelledby="modalLihatLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLihatLabel">Detail Presensi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>NIP:</strong> <span id="lihat-nip"></span></p>
                    <p><strong>Tanggal:</strong> <span id="lihat-tanggal"></span></p>
                    <p><strong>Jam Masuk:</strong> <span id="lihat-jam-masuk"></span></p>
                    <p><strong>Jam Pulang:</strong> <span id="lihat-jam-pulang"></span></p>
                    <p><strong>Total Jam:</strong> <span id="lihat-total-jam"></span></p>
                    <p><strong>Working Hours:</strong> <span id="lihat-working-hours"></span></p>
                    <p><strong>Keterangan:</strong> <span id="lihat-keterangan"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel">Edit Presensi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('employee-presence.update', ['id' => 1]) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit-id">
                        <div class="mb-3">
                            <label for="edit-nip" class="form-label">NIP</label>
                            <input type="text" class="form-control" id="edit-nip" name="nip" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="edit-tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="edit-tanggal" name="tanggal">
                        </div>
                        <div class="mb-3">
                            <label for="edit-jam-masuk" class="form-label">Jam Masuk</label>
                            <input type="time" class="form-control" id="edit-jam-masuk" name="jam_masuk">
                        </div>
                        <div class="mb-3">
                            <label for="edit-jam-pulang" class="form-label">Jam Pulang</label>
                            <input type="time" class="form-control" id="edit-jam-pulang" name="jam_pulang">
                        </div>
                        <div class="mb-3">
                            <label for="edit-keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="edit-keterangan" name="keterangan"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        // Modal Lihat
        var modalLihat = document.getElementById('modalLihat');
        modalLihat.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            document.getElementById('lihat-nip').textContent = button.getAttribute('data-nip');
            document.getElementById('lihat-tanggal').textContent = button.getAttribute('data-tanggal');
            document.getElementById('lihat-jam-masuk').textContent = button.getAttribute('data-jam-masuk');
            document.getElementById('lihat-jam-pulang').textContent = button.getAttribute('data-jam-pulang');
            document.getElementById('lihat-total-jam').textContent = button.getAttribute('data-total-jam');
            document.getElementById('lihat-working-hours').textContent = button.getAttribute('data-working-hours');
            document.getElementById('lihat-keterangan').textContent = button.getAttribute('data-keterangan');
        });
    
        // Modal Edit
        var modalEdit = document.getElementById('modalEdit');
        modalEdit.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            document.getElementById('edit-id').value = button.getAttribute('data-id');
            document.getElementById('edit-nip').value = button.getAttribute('data-nip');
            document.getElementById('edit-tanggal').value = button.getAttribute('data-tanggal');
            document.getElementById('edit-jam-masuk').value = button.getAttribute('data-jam-masuk');
            document.getElementById('edit-jam-pulang').value = button.getAttribute('data-jam-pulang');
            document.getElementById('edit-keterangan').value = button.getAttribute('data-keterangan');
        });
    </script>
    
</x-app-layout>

