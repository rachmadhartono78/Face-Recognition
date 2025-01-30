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
        $reportsmonthly = DB::table('laporan_kedisiplinan')
            ->join('pengguna', 'laporan_kedisiplinan.pengguna_id', '=', 'pengguna.id')
            ->select(
                'pengguna.nama as nama_karyawan',
                'pengguna.nip',
                'pengguna.jenis_presensi as jabatan',
                'laporan_kedisiplinan.*'
            )
            ->get();
        // $pdf = PDF::loadView('admin.reportingdecipline.pdf-report', compact('reportsmonthly'));
        // $pdf = PDF::loadView('admin.reportingdecipline.pdf-report', compact('reportsmonthly'));
        $pdf = app('dompdf.wrapper')->loadView('admin.reportingdecipline.pdf-report', compact('reportsmonthly'));



        return $pdf->stream('Laporan_Kedisiplinan.pdf'); // ✅ Menampilkan preview PDF di browser
    }
}
