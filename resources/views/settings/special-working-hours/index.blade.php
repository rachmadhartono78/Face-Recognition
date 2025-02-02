<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Jam Kerja Khusus</h3>
                <p class="text-subtitle text-muted">Kelola jam kerja khusus pegawai di lingkungan kerja.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Pengaturan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Jam Kerja Khusus</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>
    
        <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="text-lg font-bold mb-4">Daftar Jam Kerja Khusus</h4>
    
                    <a href="{{ route('settings.special-working-hours.create') }}" class="btn btn-primary mb-3">Tambah</a>
    
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
    
                    <table class="table table-bordered table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Keterangan</th>
                                <th>Tanggal Berlaku</th>
                                <th>Jam Masuk</th>
                                <th>Jam Keluar</th>
                                <th>Jam Kerja</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $index => $row)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $row->keterangan }}</td>
                                    <td>{{ $row->tanggal_mulai }} - {{ $row->tanggal_selesai }}</td>
                                    <td>{{ $row->jam_masuk }}</td>
                                    <td>{{ $row->jam_keluar }}</td>
                                    <td>{{ $row->jam_kerja }}</td>
                                    <td>
                                        <a href="{{ route('settings.special-working-hours.edit', $row->id) }}" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('settings.special-working-hours.destroy', $row->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
    
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
