<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Pengaturan') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg p-4">
            <form action="{{ route('pengaturan.update', $pengaturan->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="kode_pengaturan" class="form-label">Kode Pengaturan</label>
                    <input type="text" name="kode_pengaturan" id="kode_pengaturan" class="form-control" value="{{ $pengaturan->kode_pengaturan }}" required>
                </div>
                <div class="mb-4">
                    <label for="isi" class="form-label">Isi</label>
                    <textarea name="isi" id="isi" class="form-control" required>{{ $pengaturan->isi }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" class="form-control" required>{{ $pengaturan->keterangan }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</x-app-layout>
