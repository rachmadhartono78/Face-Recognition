<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class PlaybackController extends Controller
{
    public function playback($id)
    {
        $video = Video::findOrFail($id);
        // dd($video->id);
        if (!view()->exists('admin.recordedvideo.playback')) {
            dd('View not found');
        }
        return view('admin.recordedvideo.playback', compact('video'));


    }
}
