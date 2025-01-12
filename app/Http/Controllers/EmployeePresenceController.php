<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PresensiHarianPegawai;

class EmployeePresenceController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data presensi dengan pagination
        // $presensi = DB::table('presensi_harian_pegawai')
        //     ->select('nip', 'tanggal', 'jam_masuk', 'jam_pulang', 'total_jam', 'working_hours', 'keterangan')
        //     ->orderBy('tanggal', 'desc')
        //     ->paginate(10);

        // return view('employee-presence.index', compact('presensi'));

        $presensi = PresensiHarianPegawai::orderBy('tanggal', 'desc')->paginate(10);

        // Kirim data ke view
        return view('employee-presence.index', compact('presensi'));
    }

    public function update(Request $request, $id)
    {
        $presensi = PresensiHarianPegawai::findOrFail($id);

        $presensi->update($request->only([
            'tanggal', 'jam_masuk', 'jam_pulang', 'keterangan'
        ]));

        // return redirect()->route('employee-presence.index')
        //     ->with('success', 'Data presensi berhasil diperbarui.');
        return redirect('/presensi')->with('success', 'Data presensi berhasil diperbarui.');

    }
}
