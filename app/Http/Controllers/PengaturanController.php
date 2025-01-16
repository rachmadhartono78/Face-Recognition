<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PengaturanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pengaturan = Pengaturan::all();
        return view('settings.indexs', compact('pengaturan'));
    }

    public function create()
    {
        return view('settings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_pengaturan' => 'required|unique:pengaturan,kode_pengaturan|max:32',
            'isi' => 'required',
            'keterangan' => 'required',
        ]);

        Pengaturan::create([
            'kode_pengaturan' => $request->kode_pengaturan,
            'isi' => $request->isi,
            'keterangan' => $request->keterangan,
            'user_input' => auth()->user()->name ?? 'system',
            'user_update' => auth()->user()->name ?? 'system',
            'uuid' => Str::uuid(),
        ]);

        return redirect()->route('pengaturan.index')->with('success', 'Pengaturan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pengaturan = Pengaturan::findOrFail($id);
        return view('settings.edit', compact('pengaturan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_pengaturan' => 'required|unique:pengaturan,kode_pengaturan,' . $id,
            'isi' => 'required',
            'keterangan' => 'required',
        ]);

        $pengaturan = Pengaturan::findOrFail($id);
        $pengaturan->update([
            'kode_pengaturan' => $request->kode_pengaturan,
            'isi' => $request->isi,
            'keterangan' => $request->keterangan,
            'user_update' => auth()->user()->name,
        ]);

        return redirect()->route('pengaturan.index')->with('success', 'Pengaturan berhasil diubah.');
    }

    public function destroy($id)
    {
        $pengaturan = Pengaturan::findOrFail($id);
        $pengaturan->delete();

        return redirect()->route('pengaturan.index')->with('success', 'Pengaturan berhasil dihapus.');
    }
}

