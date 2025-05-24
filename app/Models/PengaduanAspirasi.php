<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PengaduanAspirasi extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi secara mass-assignment
    protected $fillable = [
        'warga_id',
        'judul',
        'deskripsi',
        'kategori',
        'status',
        'tanggal_pengaduan',
        'tanggal_selesai',
        'foto_pengaduan_1',
        'foto_pengaduan_2',
        'foto_pengaduan_3'
    ];

    // Relasi ke tabel Warga (Many-to-One)
    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }

    // Relasi ke tabel Notifikasi (One-to-One)
    public function notifikasiPengaduan()
    {
        return $this->hasOne(NotifikasiPengaduan::class);
    }

    // Relasi ke tabel Riwayat Aktivitas (One-to-Many)
    public function riwayatAktivitas()
    {
        return $this->hasMany(RiwayatAktivitas::class, 'aktivitas_id');
    }

    // Accessor untuk mendapatkan path lengkap foto (opsional)
    public function getFotoPengaduan1UrlAttribute()
    {
        return $this->foto_pengaduan_1 ? asset('storage/' . $this->foto_pengaduan_1) : null;
    }

    public function getFotoPengaduan2UrlAttribute()
    {
        return $this->foto_pengaduan_2 ? asset('storage/' . $this->foto_pengaduan_2) : null;
    }

    public function getFotoPengaduan3UrlAttribute()
    {
        return $this->foto_pengaduan_3 ? asset('storage/' . $this->foto_pengaduan_3) : null;
    }
}
