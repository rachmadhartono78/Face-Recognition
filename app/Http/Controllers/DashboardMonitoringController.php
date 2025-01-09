<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class DashboardMonitoringController extends Controller
{
    public function index()
    {
        // Hardcoded data
        $employee = [
            (object) ['name' => 'Ubaidurrahman', 'jam_masuk' => '07:34', 'jam_keluar' => '16:05', 'total_jam' => '8 Jam', 'poin' => 1, 'status' => 'Masuk Kerja'],
            (object) ['name' => 'Abdul Aziz', 'jam_masuk' => '08:14', 'jam_keluar' => '16:10', 'total_jam' => '7 Jam', 'poin' => 0.5, 'status' => 'Terlambat'],
            // Tambahkan data lainnya...
        ];
    
        // Pagination settings
        $perPage = 5; // Jumlah data per halaman
        $currentPage = Paginator::resolveCurrentPage(); // Halaman saat ini
        $collection = collect($employee); // Konversi array ke collection
    
        // Buat LengthAwarePaginator
        $paginatedEmployee = new LengthAwarePaginator(
            $collection->forPage($currentPage, $perPage), // Data untuk halaman ini
            $collection->count(), // Total data
            $perPage, // Jumlah data per halaman
            $currentPage, // Halaman saat ini
            ['path' => url()->current()] // URL untuk pagination
        );
    
        // Kirim ke view
        return view('admin.dasbordmonitoring.dasbordmonitoring', [
            'employee' => $paginatedEmployee,
        ]);
    }
}
