<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeePresenceController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data presensi dengan pagination
        $presensi = DB::table('presensi_harian')
            ->select('nip', 'tanggal', 'jam_masuk', 'jam_pulang', 'total_jam', 'working_hours', 'keterangan')
            ->orderBy('tanggal', 'desc')
            ->paginate(10);

        return view('employee-presence.index', compact('presensi'));
    }
}
