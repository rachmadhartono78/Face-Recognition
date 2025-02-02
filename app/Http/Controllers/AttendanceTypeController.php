<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AttendanceType;

class AttendanceTypeController extends Controller
{
    public function index()
    {
        $data = AttendanceType::paginate(10);
        return view('settings.attendance-types.index', compact('data'));
    }

    public function create()
    {
        return view('settings.attendance-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tipe_jam_kerja' => 'required',
            'form_izin_lembur' => 'required',
            'jam_kerja' => 'required',
        ]);

        AttendanceType::create($request->all());
        return redirect()->route('settings.attendance-types.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = AttendanceType::findOrFail($id);
        return view('settings.attendance-types.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = AttendanceType::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('settings.attendance-types.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        AttendanceType::findOrFail($id)->delete();
        return redirect()->route('settings.attendance-types.index')->with('success', 'Data berhasil dihapus!');
    }
}

