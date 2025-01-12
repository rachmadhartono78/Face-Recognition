<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $table = 'recorded_videos';

    protected $fillable = [
        'id',
        'title',
        'description',
        'file_path',
        'thumbnail',
        'recorded_at',
        'duration',
    ];

    protected $dates = [
        'recorded_at',
        'created_at',
        'updated_at',
    ];
    
}


