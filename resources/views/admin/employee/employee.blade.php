<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Kelola Pengguna</h3>
                <p class="text-subtitle text-muted">Manajemen data pengguna presensi & Monitoring Pegawai.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kelola Pengguna</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>

    <section class="section">
        <!-- Filter Section -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header border-bottom-0 pb-0">
                <h4 class="card-title">Filter Pencarian</h4>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('employee') }}" class="row g-3">
                    <div class="col-md-3">
                        <label for="jenis_presensi" class="form-label font-bold text-sm">Jenis Presensi</label>
                        <select name="jenis_presensi" id="jenis_presensi" class="form-select border-slate-200">
                            <option value="">-- Semua Jenis --</option>
                            <option value="Administrasi" {{ request('jenis_presensi') == 'Administrasi' ? 'selected' : '' }}>Administrasi</option>
                            <option value="Dosen tetap" {{ request('jenis_presensi') == 'Dosen tetap' ? 'selected' : '' }}>Dosen tetap</option>
                            <option value="Dosen kontrak" {{ request('jenis_presensi') == 'Dosen kontrak' ? 'selected' : '' }}>Dosen kontrak</option>
                            <option value="Tenaga pendukung" {{ request('jenis_presensi') == 'Tenaga pendukung' ? 'selected' : '' }}>Tenaga pendukung</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="unit_kerja" class="form-label font-bold text-sm">Unit Kerja</label>
                        <select name="unit_kerja" id="unit_kerja" class="form-select border-slate-200">
                            <option value="">-- Semua Unit --</option>
                            <option value="Direktorat Layanan Akademik" {{ request('unit_kerja') == 'Direktorat Layanan Akademik' ? 'selected' : '' }}>Direktorat Layanan Akademik</option>
                            <option value="Badan Sistem Informasi" {{ request('unit_kerja') == 'Badan Sistem Informasi' ? 'selected' : '' }}>Badan Sistem Informasi</option>
                            <option value="Direktorat Sumber Daya Manusia" {{ request('unit_kerja') == 'Direktorat Sumber Daya Manusia' ? 'selected' : '' }}>Direktorat Sumber Daya Manusia</option>
                            <option value="Fakultas Teknologi Informasi" {{ request('unit_kerja') == 'Fakultas Teknologi Informasi' ? 'selected' : '' }}>Fakultas Teknologi Informasi</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="status" class="form-label font-bold text-sm">Status</label>
                        <select name="status" id="status" class="form-select border-slate-200">
                            <option value="">-- Semua Status --</option>
                            <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Nonaktif" {{ request('status') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-primary w-100 flex-grow-1">
                            <i class="bi bi-filter me-2"></i> Filter
                        </button>
                        <a href="{{ route('employee') }}" class="btn btn-light-secondary w-50">Reset</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table Section -->
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-lg" id="table1">
                        <thead>
                            <tr class="text-muted">
                                <th>No</th>
                                <th>Profil Pegawai</th>
                                <th>NIP</th>
                                <th>Kategori</th>
                                <th class="text-center">Unit Kerja</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @forelse ($users as $index => $user)
                                <tr>
                                    <td class="text-center align-middle">{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                                    <td class="col-3 align-middle">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-md me-3">
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->nama) }}&background=435ebe&color=fff&bold=true" class="rounded-circle shadow-sm">
                                            </div>
                                            <div class="d-flex flex-column">
                                                <span class="fw-bold mb-0" style="font-size: 0.9rem;">{{ $user->nama }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle"><code class="text-primary font-bold">{{ $user->nip }}</code></td>
                                    <td class="align-middle">
                                        @php
                                            $catBadge = match($user->jenis_presensi) {
                                                'Administrasi' => 'bg-light-warning text-warning',
                                                'Dosen tetap' => 'bg-light-primary text-primary',
                                                'Dosen kontrak' => 'bg-light-secondary text-secondary',
                                                default => 'bg-light-info text-info',
                                            };
                                        @endphp
                                        <span class="badge {{ $catBadge }} badge-sm rounded-pill" style="font-size: 0.7rem;">
                                            {{ $user->jenis_presensi }}
                                        </span>
                                    </td>
                                    <td class="text-center align-middle">
                                        <small class="text-muted font-medium">{{ $user->unit_kerja }}</small>
                                    </td>
                                    <td class="text-center align-middle">
                                        @if($user->flag_aktif)
                                            <span class="badge bg-light-success text-success">Aktif</span>
                                        @else
                                            <span class="badge bg-light-danger text-danger">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="d-flex justify-content-center gap-2">
                                            <button class="btn btn-sm btn-outline-primary view-employee"
                                                data-id="{{ $user->id }}"
                                                data-nip="{{ $user->nip }}"
                                                data-nama="{{ $user->nama }}"
                                                data-jenis_presensi="{{ $user->jenis_presensi }}"
                                                data-unit_kerja="{{ $user->unit_kerja }}"
                                                data-status="{{ $user->flag_aktif ? 'Aktif' : 'Nonaktif' }}"
                                                data-foto="{{ asset('lib/attendance/' . $user->foto_path) }}">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            
                                            <a href="{{ route('employee', ['id' => $user->id]) }}" class="btn btn-sm btn-outline-warning">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            <form method="POST" action="{{ route('employee', ['id' => $user->id]) }}" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <i class="bi bi-info-circle fs-2 d-block mb-2"></i>
                                        Tidak ada data pengguna tersedia.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 px-2 d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                    <div class="text-muted text-sm font-medium">
                        Menampilkan <span class="text-dark">{{ $users->firstItem() ?? 0 }}</span> - <span class="text-dark">{{ $users->lastItem() ?? 0 }}</span> dari <span class="text-dark">{{ $users->total() }}</span> data.
                    </div>
                    <div class="pagination-container">
                        {{ $users->appends(request()->query())->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Detail User -->
    <div class="modal fade" id="viewEmployeeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-bold"><i class="bi bi-person-badge me-2"></i>Detail Informasi Pegawai</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-5 text-center mb-4 mb-md-0">
                            <div class="position-relative d-inline-block">
                                <img id="employeePhoto" src="" class="img-fluid rounded-4 shadow-sm border border-4 border-white" style="width: 200px; height: 200px; object-fit: cover;" alt="Foto Pengguna">
                                <span id="statusIndicator" class="position-absolute bottom-0 end-0 translate-middle-y p-2 border border-light rounded-circle" style="width: 25px; height: 25px;"></span>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="table-responsive">
                                <table class="table table-borderless table-sm">
                                    <tr>
                                        <th class="text-muted py-2" width="35%">NIP</th>
                                        <td id="employeeNip" class="fw-bold py-2"></td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted py-2">Nama Lengkap</th>
                                        <td id="employeeNama" class="fw-bold py-2"></td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted py-2">Kategori</th>
                                        <td id="employeeJenisPresensi" class="py-2"></td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted py-2">Unit Kerja</th>
                                        <td id="employeeUnitKerja" class="py-2 text-muted"></td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted py-2">Status Akun</th>
                                        <td id="employeeStatus" class="py-2"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light-secondary px-4 rounded-pill" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".view-employee").forEach(button => {
                button.addEventListener("click", function() {
                    const data = this.dataset;
                    document.getElementById("employeeNip").innerText = data.nip;
                    document.getElementById("employeeNama").innerText = data.nama;
                    document.getElementById("employeeJenisPresensi").innerHTML = `<span class="badge bg-light-primary text-primary rounded-pill font-bold shadow-sm">${data.jenis_presensi}</span>`;
                    document.getElementById("employeeUnitKerja").innerText = data.unit_kerja;
                    
                    const statusBadge = data.status === 'Aktif' 
                        ? '<span class="badge bg-light-success text-success rounded-pill px-3">Aktif</span>' 
                        : '<span class="badge bg-light-danger text-danger rounded-pill px-3">Nonaktif</span>';
                    document.getElementById("employeeStatus").innerHTML = statusBadge;
                    
                    const indicator = document.getElementById("statusIndicator");
                    indicator.className = `position-absolute bottom-0 end-0 translate-middle-y p-2 border border-light rounded-circle ${data.status === 'Aktif' ? 'bg-success' : 'bg-danger'}`;

                    let photoSrc = data.foto;
                    document.getElementById("employeePhoto").src = (photoSrc && photoSrc.indexOf('attendance/') !== -1) ? photoSrc : `https://ui-avatars.com/api/?name=${encodeURIComponent(data.nama)}&background=435ebe&color=fff&size=200&bold=true`;
        
                    let modal = new bootstrap.Modal(document.getElementById("viewEmployeeModal"));
                    modal.show();
                });
            });
        });
    </script>        
</x-app-layout>
