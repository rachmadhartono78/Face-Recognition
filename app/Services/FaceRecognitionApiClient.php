<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Exception;

class FaceRecognitionApiClient
{
    protected $baseUrl;
    protected $timeout;

    public function __construct()
    {
        $this->baseUrl = config('services.face_recognition.url', 'http://localhost:5000');
        $this->timeout = config('services.face_recognition.timeout', 30);
    }

    public function detectFace($image, bool $returnCoordinates = true): array
    {
        try {
            $response = Http::timeout($this->timeout)
                ->attach('image', file_get_contents($image), 'image.jpg')
                ->post("{$this->baseUrl}/api/detect", [
                'return_coordinates' => $returnCoordinates
            ]);

            return $response->successful() ? $response->json() : ['success' => false, 'error' => $response->body()];
        }
        catch (Exception $e) {
            Log::error('Face detection error: ' . $e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function recognizeFace($image, float $threshold = 0.6): array
    {
        try {
            $response = Http::timeout($this->timeout)
                ->attach('image', file_get_contents($image), 'image.jpg')
                ->post("{$this->baseUrl}/api/recognize", [
                'threshold' => $threshold
            ]);

            return $response->successful() ? $response->json() : ['success' => false, 'recognized' => false, 'error' => $response->body()];
        }
        catch (Exception $e) {
            Log::error('Face recognition error: ' . $e->getMessage());
            return ['success' => false, 'recognized' => false, 'error' => $e->getMessage()];
        }
    }

    public function getStreamUrl(int $cameraId = 0): string
    {
        return "{$this->baseUrl}/api/stream?camera_id={$cameraId}";
    }

    public function getStreamWithDetectionUrl(int $cameraId = 0): string
    {
        return "{$this->baseUrl}/api/stream-with-detection?camera_id={$cameraId}";
    }

    public function checkHealth(): array
    {
        try {
            $response = Http::timeout(5)->get("{$this->baseUrl}/api/health");
            return $response->successful() ? $response->json() : ['status' => 'error'];
        }
        catch (Exception $e) {
            return ['status' => 'error', 'error' => $e->getMessage()];
        }
    }

    public function getMetrics(): array
    {
        try {
            $response = Http::timeout(10)->get("{$this->baseUrl}/api/metrics");
            return $response->successful() ? $response->json() : ['success' => false];
        }
        catch (Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
}
