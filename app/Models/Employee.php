<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'karyawan'; 
    protected $fillable = ['nama_karyawan', 'jabatan', 'email', 'tempat_lahir', 'tanggal_lahir', 'nomor_hp'];
}
