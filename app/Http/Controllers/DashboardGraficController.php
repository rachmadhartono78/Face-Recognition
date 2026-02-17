<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\RecordedVideo;

class DashboardGraficController extends Controller
{
    public function index()
    {
        $totalPegawai = Employee::count();
        $totalPekerjaan = Employee::whereIn('jenis_presensi', ['Administrasi', 'Dosen tetap', 'Dosen kontrak', 'Tenaga pendukung'])->count();
        $totalVideo = RecordedVideo::count();

        // Data grafik kinerja pegawai (Berdasarkan jumlah presensi)
        $employees = Employee::withCount('presensiHarian')->get();
        $grafikLabels = $employees->pluck('nama')->toArray();
        $grafikData = $employees->pluck('presensi_harian_count')->toArray();

        // Data komposisi pegawai berdasarkan jenis presensi
        $komposisiPegawai = Employee::select('jenis_presensi', DB::raw('count(*) as total'))
            ->groupBy('jenis_presensi')
            ->pluck('total', 'jenis_presensi')
            ->toArray();

        // Daftar pegawai terbaru
        $pegawai = Employee::select('id', 'nama', 'jenis_presensi', 'unit_kerja')
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard-grafic', compact(
            'totalPegawai', 'totalPekerjaan', 'totalVideo',
            'grafikLabels', 'grafikData',
            'komposisiPegawai', 'pegawai'
        ));
    }


}
