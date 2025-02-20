<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    use HasFactory;
    protected $table = 'pengaturan';
    protected $fillable = [
        'kode_pengaturan',
        'isi',
        'keterangan',
        'user_input',
        'user_update',
        'flag_aktif',
    ];
}
