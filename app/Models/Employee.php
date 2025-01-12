<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'pengguna'; 
    protected $fillable = ['nama', 'nip', 'jenis_presensi', 'unit_kerja', 'foto', 'flag_aktif'];
}
