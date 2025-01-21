<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\PresensiHarianPegawai;
use Carbon\Carbon;

class DashboardFaceRecognizeController extends Controller
{
    public function index()
    {
        // Total Pegawai
        $totalPegawai = Employee::count();

        // Kehadiran Hari Ini
        $hariIni = Carbon::today();
        $kehadiranHariIni = PresensiHarianPegawai::whereDate('tanggal', $hariIni)->count();

        // Pegawai Tidak Hadir Hari Ini
        $tidakHadirHariIni = $totalPegawai - $kehadiranHariIni;

        // Pegawai Terlambat
        $jamMasukKerja = '08:00:00';
        $pegawaiTerlambat = PresensiHarianPegawai::whereDate('tanggal', $hariIni)
            ->whereTime('jam_masuk', '>', $jamMasukKerja)
            ->count();

        // Statistik Kehadiran Mingguan
        $statistikMingguan = PresensiHarianPegawai::selectRaw('DATE(tanggal) as tanggal, COUNT(*) as total')
            ->whereBetween('tanggal', [Carbon::now()->subDays(6), Carbon::now()])
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        return view('admin.dasbordmonitoring.facerecognize', compact(
            'totalPegawai',
            'kehadiranHariIni',
            'tidakHadirHariIni',
            'pegawaiTerlambat',
            'statistikMingguan'
        ));
    }

    public function chartData()
    {
        // Data dummy, nanti ganti dengan query database Anda
        $data = [
            'labels' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'],
            'datasets' => [
                [
                    'label' => 'Kehadiran Mingguan',
                    'data' => [10, 15, 20, 18, 25], // Contoh data
                    'backgroundColor' => 'rgba(75, 192, 192, 0.5)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'borderWidth' => 1
                ]
            ]
        ];
        return response()->json($data);
    }

}
