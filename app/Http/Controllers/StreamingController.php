<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StreamingController extends Controller
{
public function startStreaming()
{

    $flaskUrl = "http://127.0.0.1:5000/stream";
    return view('admin.livemonitoring.streaming', compact('flaskUrl'));


}
}
