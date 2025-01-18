<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KeyPerformanceKpiReport;
use Illuminate\Support\Facades\DB;

class KeyPerformanceKpiReportController extends Controller
{
    public function index()
    {
        $reports = KeyPerformanceKpiReport::all();
        return view('admin.reportingdecipline.reporting', compact('reports'));
    }

    public function disciplineReports()
    {
        $reportsmonthly = DB::table('laporan_kedisiplinan')
            ->join('pengguna', 'laporan_kedisiplinan.pengguna_id', '=', 'pengguna.id')
            ->select(
                'pengguna.nama as nama_karyawan',
                'pengguna.nip',
                'pengguna.jenis_presensi as jabatan',
                'laporan_kedisiplinan.*'
            )
            ->paginate(10);

        return view('admin.reportingdecipline.reporting-monthly', compact('reportsmonthly'));
    }



}

