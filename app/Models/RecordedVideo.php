<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecordedVideo extends Model
{
    use HasFactory;
    protected $table = 'recorded_videos'; // Nama tabel di database
    protected $fillable = ['title', 'description', 'file_path', 'thumbnail', 'recorded_at', 'duration'];
}
