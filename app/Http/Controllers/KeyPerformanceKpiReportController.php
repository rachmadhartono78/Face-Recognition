<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KeyPerformanceKpiReport;
use Illuminate\Support\Facades\DB;

class KeyPerformanceKpiReportController extends Controller
{
    public function index()
    {
        $reports = DB::table('presensi_harian_pegawai')
            ->join('pengguna', 'presensi_harian_pegawai.pengguna_id', '=', 'pengguna.id')
            ->select(
            'pengguna.nama as nama_karyawan',
            'pengguna.nip as NIP',
            'pengguna.jenis_presensi as jabatan',
            'presensi_harian_pegawai.pengguna_id',
            DB::raw('SUM(total_menit) / 60 as total_jam_kerja'),
            DB::raw('COUNT(*) as total_kehadiran'),
            DB::raw("SUM(CASE WHEN jam_masuk <= '08:00:00' THEN 1 ELSE 0 END) as tepat_waktu"),
            DB::raw("SUM(CASE WHEN jam_masuk > '08:00:00' THEN 1 ELSE 0 END) as terlambat"),
            DB::raw("SUM(CASE WHEN jam_masuk IS NULL THEN 1 ELSE 0 END) as tidak_hadir"),
            DB::raw('ROUND((SUM(CASE WHEN jam_masuk <= "08:00:00" THEN 1 ELSE 0 END) / COUNT(*)) * 100, 2) as efektivitas'),
            DB::raw('CASE WHEN (SUM(CASE WHEN jam_masuk <= "08:00:00" THEN 1 ELSE 0 END) / COUNT(*)) >= 0.9 THEN "Sangat Baik" WHEN (SUM(CASE WHEN jam_masuk <= "08:00:00" THEN 1 ELSE 0 END) / COUNT(*)) >= 0.7 THEN "Baik" ELSE "Perlu Peningkatan" END as kinerja')
        )
            ->groupBy('pengguna_id', 'pengguna.nama', 'pengguna.nip', 'pengguna.jenis_presensi')
            ->get();

        return view('admin.reportingdecipline.reporting', compact('reports'));
    }

    public function disciplineReports()
    {
        // Agregasi data presensi langsung dari tabel presensi_harian_pegawai
        // Filter untuk bulan ini (opsional, bisa ditambahkan filter request)
        $reportsmonthly = DB::table('presensi_harian_pegawai')
            ->join('pengguna', 'presensi_harian_pegawai.pengguna_id', '=', 'pengguna.id')
            ->select(
            'pengguna.nama as nama_karyawan',
            'pengguna.nip',
            'pengguna.jenis_presensi as jabatan',
            'presensi_harian_pegawai.pengguna_id',
            DB::raw('SUM(total_menit) / 60 as total_jam_kerja'),
            DB::raw('COUNT(*) as total_kehadiran'),
            DB::raw("SUM(CASE WHEN jam_masuk <= '08:00:00' THEN 1 ELSE 0 END) as tepat_waktu"),
            DB::raw("SUM(CASE WHEN jam_masuk > '08:00:00' THEN 1 ELSE 0 END) as terlambat"),
            DB::raw("SUM(CASE WHEN jam_masuk IS NULL THEN 1 ELSE 0 END) as tidak_hadir"), // Jika ada record tanpa jam_masuk
            DB::raw('SUM(total_menit) as durasi_tidak_terlihat') // Placeholder logic
        )
            ->groupBy('pengguna_id', 'pengguna.nama', 'pengguna.nip', 'pengguna.jenis_presensi')
            ->paginate(10);

        return view('admin.reportingdecipline.reporting-monthly', compact('reportsmonthly'));
    }



}
