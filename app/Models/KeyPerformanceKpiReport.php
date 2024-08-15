<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeyPerformanceKpiReport extends Model
{
    use HasFactory;
    protected $table = 'keyperformancekpi_report';

    public $timestamps = false;
    protected $fillable = [
        'nama_karyawan',
        'NIP',
        'jabatan',
        'total_jam_kerja',
        'total_kehadiran',
        'tepat_waktu',
        'terlambat',
        'tidak_hadir',
        'efektivitas',
        'kinerja'
    ];

}
