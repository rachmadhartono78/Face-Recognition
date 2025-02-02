<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialWorkingHour extends Model
{
    use HasFactory;
    protected $table = 'special_working_hours'; // Jika nama tabel berbeda dari model

    protected $fillable = [
        'keterangan',
        'tanggal_mulai',
        'tanggal_selesai',
        'jam_masuk',
        'jam_keluar',
        'jam_kerja',
    ];

    protected $dates = ['tanggal_mulai', 'tanggal_selesai'];
}
