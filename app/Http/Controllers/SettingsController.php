<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RecordedVideo;

class SettingsController extends Controller
{
    public function disciplineReports()
    {
        $reports = DB::table('laporan_kedisiplinan')
            ->join('pengguna', 'laporan_kedisiplinan.pengguna_id', '=', 'pengguna.id')
            ->select(
                'pengguna.nama as nama_karyawan',
                'pengguna.nip',
                'pengguna.jenis_presensi as jabatan',
                'laporan_kedisiplinan.*'
            )
            ->paginate(10);

        return view('settings.descipline-reports', compact('reports'));
    }

public function generateDisciplineReport()
{
    $presensi = DB::table('presensi_harian_pegawai')
        ->select(
            'pengguna_id',
            'nip',
            DB::raw('SUM(working_hours) as total_jam_kerja'),
            DB::raw('COUNT(id) as total_kehadiran'),
            DB::raw('SUM(CASE WHEN keterangan = "Tepat Waktu" THEN 1 ELSE 0 END) as tepat_waktu'),
            DB::raw('SUM(CASE WHEN keterangan = "Terlambat" THEN 1 ELSE 0 END) as terlambat'),
            DB::raw('SUM(CASE WHEN keterangan IS NULL THEN 1 ELSE 0 END) as tidak_hadir'),
            DB::raw('SUM(CASE WHEN total_menit > (working_hours * 60) THEN total_menit - (working_hours * 60) ELSE 0 END) as durasi_tidak_terlihat')
        )
        ->groupBy('pengguna_id', 'nip')
        ->get();

    foreach ($presensi as $data) {
        DB::table('laporan_kedisiplinan')->updateOrInsert(
            ['pengguna_id' => $data->pengguna_id, 'nip' => $data->nip],
            [
                'total_jam_kerja' => $data->total_jam_kerja,
                'total_kehadiran' => $data->total_kehadiran,
                'tepat_waktu' => $data->tepat_waktu,
                'terlambat' => $data->terlambat,
                'tidak_hadir' => $data->tidak_hadir,
                'durasi_tidak_terlihat' => $data->durasi_tidak_terlihat,
            ]
        );
    }

    return redirect()->route('settings.discipline-reports')
        ->with('success', 'Laporan kedisiplinan berhasil dihasilkan.');
    }

    public function uploadVideo()
    {
        return view('settings.upload_video');
    }

    public function storeVideo(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video' => 'required|mimes:mp4,mov,avi|max:51200', // Maksimal 50MB
        ]);

        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $filePath = $file->store('videos', 'public');

            $recordedVideo = RecordedVideo::create([
                'title' => $request->title,
                'description' => $request->description,
                'file_path' => $filePath,
                'recorded_at' => now(),
                'duration' => 0, // Bisa diisi durasi jika ada cara menghitungnya
            ]);

            return redirect()->route('settings.upload_video')->with('success', 'Video berhasil diunggah.');
        }

        return back()->withErrors(['video' => 'Gagal mengunggah video']);
    }

}
