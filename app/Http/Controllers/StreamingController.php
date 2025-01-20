<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StreamingController extends Controller
{
public function startStreaming()
{

    $flaskUrl = "http://103.220.113.186:8080";
    return view('admin.livemonitoring.streaming', compact('flaskUrl'));

        // // URL pertama (lokal)
        // $flaskUrl = "http://127.0.0.1:5000/stream";

        // // Cek apakah URL pertama dapat diakses
        // $response = Http::get($flaskUrl);

        // // Jika URL pertama tidak dapat diakses, ganti dengan URL kedua
        // if (!$response->successful()) {
        //     $flaskUrl = "http://103.220.113.186:8080/";
        // }

        // // Kirim URL yang telah dipilih ke view
        // return view('admin.livemonitoring.streaming', compact('flaskUrl'));
    }
}
