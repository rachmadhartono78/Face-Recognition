<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PresensiHarianPegawai;

class EmployeePresenceController extends Controller
{
    // public function index(Request $request)
    // {
    //     // Ambil data presensi dengan pagination
    //     // $presensi = DB::table('presensi_harian_pegawai')
    //     //     ->select('nip', 'tanggal', 'jam_masuk', 'jam_pulang', 'total_jam', 'working_hours', 'keterangan')
    //     //     ->orderBy('tanggal', 'desc')
    //     //     ->paginate(10);

    //     // return view('employee-presence.index', compact('presensi'));

    //     $presensi = PresensiHarianPegawai::orderBy('tanggal', 'desc')->paginate(10);

    //     // Kirim data ke view
    //     return view('employee-presence.index', compact('presensi'));
    // }

    public function index(Request $request)
    {
        // Ambil query dasar untuk data presensi
        $query = PresensiHarianPegawai::query();

        // Filter berdasarkan NIP/Nama Pegawai jika ada input
        if ($request->filled('nip')) {
            $query->where('nip', 'like', '%' . $request->nip . '%');
        }

        // Filter berdasarkan rentang tanggal jika ada input
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        }

        // Filter berdasarkan keterangan jika ada input
        if ($request->filled('keterangan')) {
            $query->where('keterangan', $request->keterangan);
        }

        // Ambil data presensi dengan pagination
        $presensi = $query->orderBy('tanggal', 'desc')->paginate(10);

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
