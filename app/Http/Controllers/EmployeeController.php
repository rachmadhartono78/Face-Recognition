<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function getDataPegawai(Request $request)
    {
        // Ambil data dari tabel karyawan
        $users = Employee::paginate(10); // Menggunakan pagination untuk 10 data per halaman

        // Kirim data ke view
        return view('admin.employee.employee', compact('users'));
    }
}
