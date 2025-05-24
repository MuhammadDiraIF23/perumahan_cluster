<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Warga extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'no_rumah',
        'foto_ktp',
    ];

    // Relasi One to One (User)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi One to Many (Tamu)
    public function tamus()
    {
        return $this->hasMany(Tamu::class);
    }

    // Relasi One to Many (Surat Pengajuan)
    public function suratPengajuans()
    {
        return $this->hasMany(SuratPengajuan::class);
    }

    // Relasi One to Many (Pengaduan & Aspirasi)
    public function pengaduanAspirasis()
    {
        return $this->hasMany(PengaduanAspirasi::class);
    }

    // Relasi One to Many (Notifikasi)
    public function notifikasis()
    {
        return $this->hasMany(Notifikasi::class);
    }

    // Relasi One to Many (Riwayat Aktivitas)
    public function riwayatAktivitas()
    {
        return $this->hasMany(RiwayatAktivitas::class);
    }
}
