<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function getDataPegawai(Request $request)
    {
        // // Ambil data dari tabel karyawan
        // $users = Employee::paginate(10); // Menggunakan pagination untuk 10 data per halaman

        // // Kirim data ke view
        // return view('admin.employee.employee', compact('users'));


        $query = Employee::query();

        // Filter berdasarkan jenis_presensi
        if ($request->filled('jenis_presensi')) {
            $query->where('jenis_presensi', $request->jenis_presensi);
        }

        // Filter berdasarkan unit_kerja
        if ($request->filled('unit_kerja')) {
            $query->where('unit_kerja', $request->unit_kerja);
        }

        // Filter berdasarkan flag_aktif
        if ($request->filled('status')) {
            $query->where('flag_aktif', $request->status == 'Aktif' ? 1 : 0);
        }

        // Pagination data
        $users = $query->paginate(10);

        // Kirim data ke view
        return view('admin.employee.employee', compact('users'));
    }
}
