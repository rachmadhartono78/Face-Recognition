<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KeyPerformanceKpiReport;

class KeyPerformanceKpiReportController extends Controller
{
    public function index()
    {
        $reports = KeyPerformanceKpiReport::all();
        return view('admin.reportingkpi.reporting', compact('reports'));
    }

}

