@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Live Monitoring</h1>
    <div class="video-stream">
        <iframe src="{{ $flaskUrl }}" frameborder="0" width="100%" height="500px" allowfullscreen></iframe>
    </div>
</div>
@endsection
