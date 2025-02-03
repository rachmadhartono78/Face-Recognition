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

        // Data grafik kinerja pegawai
        $grafikLabels = Employee::pluck('nama')->toArray();
        $grafikData = Employee::pluck('jenis_presensi')->toArray(); // Menggunakan jenis_presensi karena tidak ada kolom 'kinerja' dalam tabel pengguna

            // Data komposisi pegawai berdasarkan jenis presensi
        $jumlahAdministrasi = Employee::where('jenis_presensi', 'Administrasi')->count();
        $jumlahDosenTetap = Employee::where('jenis_presensi', 'Dosen tetap')->count();
        $jumlahDosenKontrak = Employee::where('jenis_presensi', 'Dosen kontrak')->count();
        $jumlahTenagaPendukung = Employee::where('jenis_presensi', 'Tenaga pendukung')->count();
        $komposisiPegawai = [
            'Administrasi' => $jumlahAdministrasi,
            'Dosen Tetap' => $jumlahDosenTetap,
            'Dosen Kontrak' => $jumlahDosenKontrak,
            'Tenaga Pendukung' => $jumlahTenagaPendukung,
        ];

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
