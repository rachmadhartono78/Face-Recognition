@extends('layouts.app')

@section('title', 'Face Recognition Monitoring')

@section('content')
<div class="page-heading">
    <h3>Face Recognition Monitoring</h3>
</div>

<div class="page-content">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h6>API Status</h6>
                    <h4 id="api-status">Checking...</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h6>Camera</h6>
                    <h4 id="camera-status">-</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h6>Recognitions Today</h6>
                    <h4 id="recognitions-today">0</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h6>System Load</h6>
                    <h4 id="cpu-usage">-</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>Live Stream</h4>
                    <button id="toggle-overlay" class="btn btn-sm btn-outline-primary">Toggle Detection Overlay</button>
                </div>
                <div class="card-body text-center">
                    <img id="stream-img" src="" style="width: 100%; max-height: 480px; background: #000;" />
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Performance</h4>
                </div>
                <div class="card-body">
                    <p><strong>Uptime:</strong> <span id="uptime">-</span></p>
                    <p><strong>Avg. Process:</strong> <span id="avg-time">-</span></p>
                    <p><strong>Memory:</strong> <span id="memory-usage">-</span></p>
                    <p><strong>Last Scan:</strong> <span id="last-scan">-</span></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const API_URL = "{{ config('services.face_recognition.url', 'http://localhost:5000') }}";
    let overlay = false;

    function updateStream() {
        const streamSrc = overlay 
            ? `${API_URL}/api/stream-with-detection?t=${Date.now()}` 
            : `${API_URL}/api/stream?t=${Date.now()}`;
        document.getElementById('stream-img').src = streamSrc;
    }

    async function updateStats() {
        try {
            const healthRes = await fetch(`${API_URL}/api/health`);
            const health = await healthRes.json();
            
            document.getElementById('api-status').innerText = health.status;
            document.getElementById('camera-status').innerText = health.camera_status;
            document.getElementById('uptime').innerText = health.uptime + 's';
            document.getElementById('last-scan').innerText = health.last_recognition || 'None';

            const metricsRes = await fetch(`${API_URL}/api/metrics`);
            const metrics = await metricsRes.json();
            
            document.getElementById('recognitions-today').innerText = metrics.total_recognitions_today;
            document.getElementById('cpu-usage').innerText = metrics.cpu_usage;
            document.getElementById('avg-time').innerText = metrics.average_processing_time.toFixed(3) + 's';
            document.getElementById('memory-usage').innerText = metrics.memory_usage;
        } catch (e) {
            document.getElementById('api-status').innerText = 'OFFLINE';
        }
    }

    document.getElementById('toggle-overlay').onclick = () => {
        overlay = !overlay;
        updateStream();
    };

    updateStream();
    updateStats();
    setInterval(updateStats, 5000);
</script>
@endsection
