<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //
use Barryvdh\DomPDF\PDF;


// use Barryvdh\DomPDF\Facade as PDF;
// use Barryvdh\DomPDF\Facade as PDF;
// use Barryvdh\DomPDF\Facade as PDF;
//  ✅ Tambahkan ini agar DB bisa digunakan
// use Barryvdh\DomPDF\Facade as PDF;

class DisciplineReportController extends Controller
{
    public function printDisciplineReport()
    {
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
            DB::raw("SUM(CASE WHEN jam_masuk IS NULL THEN 1 ELSE 0 END) as tidak_hadir"),
            DB::raw('SUM(total_menit) as durasi_tidak_terlihat')
        )
            ->groupBy('pengguna_id', 'pengguna.nama', 'pengguna.nip', 'pengguna.jenis_presensi')
            ->get();
        // $pdf = PDF::loadView('admin.reportingdecipline.pdf-report', compact('reportsmonthly'));
        // $pdf = PDF::loadView('admin.reportingdecipline.pdf-report', compact('reportsmonthly'));
        $pdf = app('dompdf.wrapper')->loadView('admin.reportingdecipline.pdf-report', compact('reportsmonthly'));



        return $pdf->stream('Laporan_Kedisiplinan.pdf'); // ✅ Menampilkan preview PDF di browser
    }
}
