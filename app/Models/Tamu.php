<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tamu extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nik_tamu',
        'alamat',
        'warga_id',
        'satpam_id',
        'alasan_kunjungan',
        'waktu_masuk',
        'estimasi_waktu_keluar',
        'waktu_keluar',
        'status_kunjungan',
        'nama_warga_tujuan',
        'alamat_warga_tujuan',
        'no_rumah_tujuan',
        'foto_ktp_tamu',
    ];

    // Relasi ke tabel Warga (Many-to-One)
    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }

    // Relasi ke tabel Satpam (Many-to-One)
    public function satpam()
    {
        return $this->belongsTo(Satpam::class);
    }

 

    // Relasi ke tabel Notifikasi Tamu (One-to-One)
    public function notifikasiTamu()
    {
        return $this->hasOne(NotifikasiTamu::class);
    }
}
