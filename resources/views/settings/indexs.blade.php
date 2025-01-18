<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengaturan') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg p-4">
            <div class="flex justify-between mb-4">
                <h4 class="text-lg font-bold">Daftar Pengaturan</h4>
                <a href="{{ route('pengaturan.create') }}" class="btn btn-primary">
                    Tambah Pengaturan
                </a>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kode Pengaturan</th>
                        <th>Isi</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengaturan as $item)
                        <tr>
                            <td>{{ $item->kode_pengaturan }}</td>
                            <td>{{ $item->isi }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>
                                <a href="{{ route('pengaturan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('pengaturan.destroy', $item->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus pengaturan ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
