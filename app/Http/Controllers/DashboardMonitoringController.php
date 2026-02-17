<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use App\Models\PresensiHarianPegawai;
use Illuminate\Support\Facades\DB;

class DashboardMonitoringController extends Controller
{
    public function index()
    {
        // Query data presensi terbaru dengan relasi ke pengguna
        $presensi = PresensiHarianPegawai::with('pengguna')
            ->orderBy('id', 'desc')
            ->paginate(5);

        // Map data agar sesuai dengan variabel name yang diharapkan view (name -> nama_pegawai)
        $presensi->getCollection()->transform(function ($item) {
            return (object)[
            'name' => $item->pengguna->nama ?? 'Unknown',
            'jam_masuk' => $item->jam_masuk ?? '-',
            'jam_keluar' => $item->jam_pulang ?? '-',
            'total_jam' => $item->total_jam_formatted,
            'poin' => $item->poin,
            'status' => $item->status
            ];
        });

        // Data statistik untuk kartu di atas (Bisa diambil dari NilaiKedisiplinanController logic)
        $stats = [
            'tidak_masuk' => PresensiHarianPegawai::whereNull('jam_masuk')->count(),
            'masuk_kerja' => PresensiHarianPegawai::whereNotNull('jam_masuk')->count(),
            'izin_terlambat' => PresensiHarianPegawai::where('keterangan', 'like', '%terlambat%')->count(),
            'izin_cuti' => PresensiHarianPegawai::where('keterangan', 'like', '%cuti%')->count(),
            'izin_pulang_awal' => PresensiHarianPegawai::where('keterangan', 'like', '%pulang awal%')->count(),
            'status_aktivitas' => PresensiHarianPegawai::where('total_menit', '<', 15)->count(),
        ];

        return view('admin.dasbordmonitoring.dasbordmonitoring', [
            'employee' => $presensi,
            'stats' => $stats,
        ]);
    }
}
