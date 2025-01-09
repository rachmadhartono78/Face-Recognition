<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function getDataPegawai(Request $request)
    {
        // Set up filter options
        $selectOptions = [
            'typePresence' => [
                'items' => ['-- Pilih --', 'Cuti', 'Sakit', 'Izin'],
                'defaultValue' => '-- Pilih --'
            ],
            'workUnit' => [
                'items' => ['-- Pilih --', 'IT', 'HR', 'Finance'],
                'defaultValue' => '-- Pilih --'
            ],
            'status' => [
                'items' => ['Aktif', 'Non-Aktif'],
                'defaultValue' => 'Aktif'
            ]
        ];

        // Fetch filtered data from Employee model
        $employee = Employee::query()
            ->when($request->typePresence, fn($query) => $query->where('type_presence', $request->typePresence))
            ->when($request->workUnit, fn($query) => $query->where('work_unit', $request->workUnit))
            ->when($request->status, fn($query) => $query->where('status', $request->status))
            ->paginate(10); // Adjust pagination as needed

        // Return the view with data and filter options
        return view('admin.employee.employee', compact('employee', 'selectOptions'));
    }
}
