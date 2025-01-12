<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Presensi Harian Pegawai</h3>
                {{-- <p class="text-subtitle text-muted">Laporan presensi pegawai.</p> --}}
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
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
                                        <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                        <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
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

                <!-- Back Button -->
                <div class="text-center mt-4">
                    <a href="#" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
