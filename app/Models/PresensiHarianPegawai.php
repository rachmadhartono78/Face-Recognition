<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiHarianPegawai extends Model
{
    use HasFactory;
    protected $table = 'presensi_harian_pegawai'; // Nama tabel di database
    protected $fillable = [
        'pengguna_id', 
        'nip', 
        'tanggal', 
        'jam_masuk', 
        'jam_pulang', 
        'total_jam', 
        'total_menit', 
        'working_hours', 
        'keterangan',
    ];

    // Relasi ke model `Pengguna` (opsional)
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }
}
