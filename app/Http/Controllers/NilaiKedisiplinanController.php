<?php

namespace App\Http\Controllers;

use App\Models\PresensiHarianPegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NilaiKedisiplinanController extends Controller
{
    public function index(Request $request)
    {
        // Query untuk mengambil data presensi menggunakan model accessors
        $presensi = PresensiHarianPegawai::orderBy('tanggal', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(10);

        // Data statistik untuk kartu di atas
        $stats = [
            'tidak_masuk' => PresensiHarianPegawai::whereNull('jam_masuk')->count(),
            'masuk_kerja' => PresensiHarianPegawai::whereNotNull('jam_masuk')->count(),
            'izin_terlambat' => PresensiHarianPegawai::where('keterangan', 'like', '%terlambat%')->count(),
            'izin_cuti' => PresensiHarianPegawai::where('keterangan', 'like', '%cuti%')->count(),
            'izin_pulang_awal' => PresensiHarianPegawai::where('keterangan', 'like', '%pulang awal%')->count(),
            'status_aktivitas' => PresensiHarianPegawai::where('total_menit', '<', 15)->count(),
        ];

        return view('decipline-velues.decipline-velue', [
            'presensi' => $presensi,
            'stats' => $stats,
        ]);
    }
}
