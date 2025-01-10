<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RecordedVideo;

class RecordedVideoController extends Controller
{
    public function index()
    {
        $recentVideos = RecordedVideo::latest()->paginate(10);

        return view('admin.recordedvideo.recorded', compact('recentVideos'));
    }
}
