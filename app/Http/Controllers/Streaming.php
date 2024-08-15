<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Streaming extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // Laravel Controller

    public function startStreaming()
    {
        $pythonScript = base_path('face-recognize-software-project/attendance.py');
        $output = shell_exec("python3 $pythonScript 2>&1");

        // Output dari script Python dapat diolah lebih lanjut jika diperlukan
        return response()->json(['status' => 'success', 'message' => $output]);
        // install path laravel face recognize
        
    }

}
