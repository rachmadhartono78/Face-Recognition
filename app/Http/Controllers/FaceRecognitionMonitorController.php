<?php

namespace App\Http\Controllers;

use App\Services\FaceRecognitionApiClient;
use Illuminate\Http\Request;

class FaceRecognitionMonitorController extends Controller
{
    protected $apiClient;

    public function __construct(FaceRecognitionApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function index()
    {
        return view('admin.monitoring.face-recognition-monitor');
    }

    public function health()
    {
        return response()->json($this->apiClient->checkHealth());
    }

    public function metrics()
    {
        return response()->json($this->apiClient->getMetrics());
    }
}
