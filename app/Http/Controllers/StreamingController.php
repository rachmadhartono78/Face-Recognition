<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StreamingController extends Controller
{
    public function startStreaming()
    {
        // URL Flask server
        $flaskUrl = "http://127.0.0.1:5000/stream"; // Sesuaikan URL jika berbeda

        // Kirim respons dengan iframe ke browser
        return view('admin.livemonitoring.streaming', compact('flaskUrl'));
    }

    public function getAttendance()
    {
        // URL Flask server untuk endpoint attendance
        $flaskUrl = "http://127.0.0.1:5000/attendance";

        // Gunakan Guzzle untuk mengambil data dari Flask
        $client = new \GuzzleHttp\Client();
        $response = $client->get($flaskUrl);

        // Decode JSON response
        $data = json_decode($response->getBody(), true);

        return response()->json($data);
    }
}
