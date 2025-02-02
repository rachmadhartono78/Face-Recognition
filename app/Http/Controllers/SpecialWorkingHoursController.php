<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SpecialWorkingHour;

class SpecialWorkingHoursController extends Controller
{
    public function index()
    {
        $data = SpecialWorkingHour::paginate(10);
        return view('settings.special-working-hours.index', compact('data'));
    }

    public function create()
    {
        return view('settings.special-working-hours.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'keterangan' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'jam_masuk' => 'required',
            'jam_keluar' => 'required',
            'jam_kerja' => 'required|integer',
        ]);

        SpecialWorkingHour::create($request->all());
        return redirect()->route('settings.special-working-hours.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = SpecialWorkingHour::findOrFail($id);
        return view('settings.special-working-hours.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = SpecialWorkingHour::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('settings.special-working-hours.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        SpecialWorkingHour::findOrFail($id)->delete();
        return redirect()->route('settings.special-working-hours.index')->with('success', 'Data berhasil dihapus!');
    }
}
