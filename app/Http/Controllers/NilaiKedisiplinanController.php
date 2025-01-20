<?php

namespace App\Http\Controllers;

use App\Models\PresensiHarianPegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NilaiKedisiplinanController extends Controller
{
    public function index(Request $request)
    {
        // Query untuk mengambil data presensi
        $presensi = PresensiHarianPegawai::select(
            'nip',
            'tanggal',
            'jam_masuk',
            'jam_pulang',
            DB::raw("TIMEDIFF(jam_pulang, jam_masuk) AS total_jam"),
            DB::raw("CASE 
                        WHEN jam_masuk <= '08:00:00' THEN 1 
                        ELSE 0.5 
                     END AS poin"),
            DB::raw("CASE 
                        WHEN jam_masuk <= '08:00:00' THEN 'Masuk Kerja' 
                        ELSE 'Terlambat' 
                     END AS status")
        )
        ->paginate(10); // Pagination, 10 data per halaman

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
