<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    // Relasi ke model `Pengguna` (Employee)
    public function pengguna()
    {
        return $this->belongsTo(Employee::class , 'pengguna_id');
    }

    /**
     * Get Attendance Point
     */
    public function getPoinAttribute()
    {
        if (!$this->jam_masuk)
            return 0;
        return $this->jam_masuk <= '08:00:00' ? 1 : 0.5;
    }

    /**
     * Get Attendance Status
     */
    public function getStatusAttribute()
    {
        if (!$this->jam_masuk)
            return 'Tidak Hadir';
        return $this->jam_masuk <= '08:00:00' ? 'Masuk Kerja' : 'Terlambat';
    }

    /**
     * Get Formatted Total Jam
     */
    public function getTotalJamFormattedAttribute()
    {
        if (!$this->jam_masuk || !$this->jam_pulang)
            return '-';

        $entry = \Carbon\Carbon::parse($this->jam_masuk);
        $exit = \Carbon\Carbon::parse($this->jam_pulang);

        $diff = $entry->diff($exit);
        return $diff->format('%h Jam %i Menit');
    }
}
