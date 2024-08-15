<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function getDataPegawai()
    {
        $employee = Employee::all();
        return view('admin.employee.employee', compact('employee'));
    }
}
