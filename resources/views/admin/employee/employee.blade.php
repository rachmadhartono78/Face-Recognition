<x-app-layout>
    <x-slot name="header">
        <head>
            <style>
                .pagination {
                    display: flex;
                    list-style: none;
                    padding: 0;
                    margin: 0;
                }
    
                .pagination .page-item {
                    margin: 0 5px;
                }
    
                .pagination .page-link {
                    padding: 8px 12px;
                    border: 1px solid #ddd;
                    border-radius: 4px;
                    text-decoration: none;
                    color: #007bff;
                }
    
                .pagination .page-link:hover {
                    background-color: #007bff;
                    color: white;
                }
    
                .pagination .page-item.active .page-link {
                    background-color: #007bff;
                    color: white;
                    border-color: #007bff;
                }
    
                .pagination .page-item.disabled .page-link {
                    color: #6c757d;
                    pointer-events: none;
                    background-color: #f8f9fa;
                }
            </style>
        </head>
        
        <div class="row align-items-center">
            <div class="col-md-6">
                <h3>Kelola Pengguna</h3>
                <p class="text-subtitle text-muted">Manajemen data pengguna presensi.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <nav aria-label="breadcrumb" class="breadcrumb-header">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Presensi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kelola Pengguna</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>

    <div class="container py-4">
        <!-- Filter Section -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('employee') }}" class="row g-3">
                    <div class="col-md-4">
                        <label for="type_presence" class="form-label">Jenis Presensi Pegawai</label>
                        <select name="type_presence" id="type_presence" class="form-select">
                            <option value="">-- Pilih --</option>
                            <option value="Administrasi">Administrasi</option>
                            <option value="Dosen Tetap">Dosen Tetap</option>
                            <option value="Dosen Paruh Waktu">Dosen Paruh Waktu</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="work_unit" class="form-label">Unit Kerja</label>
                        <select name="work_unit" id="work_unit" class="form-select">
                            <option value="">-- Pilih --</option>
                            <option value="Fakultas Hukum">Fakultas Hukum</option>
                            <option value="Arsitektur S1">Arsitektur S1</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="">-- Pilih --</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Nonaktif">Nonaktif</option>
                        </select>
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table Section -->
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-light">
                            <tr>
                                <th><input type="checkbox" /></th>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $index => $user)
                                <tr>
                                    <td><input type="checkbox" /></td>
                                    <td>{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                                    <td>{{ $user->nama_karyawan }}</td>
                                    <td>{{ $user->jabatan }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                            <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Tidak ada data pegawai tersedia.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 d-flex justify-content-between align-items-center">
                    <div>
                        Menampilkan {{ $users->firstItem() }} sampai {{ $users->lastItem() }} dari total {{ $users->total() }} data.
                    </div>
                    <div class="pagination-wrapper">
                        {{-- {{ $users->links() }} --}}
                        @if ($users->hasPages())
                        <nav class="mt-4">
                            <ul class="pagination justify-content-center">
                                {{-- Tombol Previous --}}
                                @if ($users->onFirstPage())
                                    <li class="page-item disabled"><span class="page-link">«</span></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $users->previousPageUrl() }}" rel="prev">«</a></li>
                                @endif

                                {{-- Nomor Halaman --}}
                                @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                                    @if ($page == $users->currentPage())
                                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                    @else
                                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach

                                {{-- Tombol Next --}}
                                @if ($users->hasMorePages())
                                    <li class="page-item"><a class="page-link" href="{{ $users->nextPageUrl() }}" rel="next">»</a></li>
                                @else
                                    <li class="page-item disabled"><span class="page-link">»</span></li>
                                @endif
                            </ul>
                        </nav>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
