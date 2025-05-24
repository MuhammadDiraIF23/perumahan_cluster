<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratPengajuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'warga_id',
        'jenis_surat',
        'keterangan',
        'status',
        'tanggal_pengajuan',
        'tanggal_persetujuan',
        'alasan_penolakan',
        'file_surat_pengantar'
    ];

    // Relasi ke tabel Warga (One-to-Many)
    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }

    // Relasi ke User melalui Warga
    public function user()
    {
        return $this->hasOneThrough(User::class, Warga::class, 'id', 'id', 'warga_id', 'user_id');
    }

    // Relasi ke tabel Notifikasi (One-to-One)
    public function notifikasiSuratPengajuan()
    {
        return $this->hasOne(NotifikasiSuratPengajuan::class);
    }

    // Relasi ke tabel Riwayat Aktivitas (One-to-Many)
    public function riwayatAktivitas()
    {
        return $this->hasMany(RiwayatAktivitas::class, 'aktivitas_id');
    }

    // Relasi ke tabel Surat Pengantar Domisili (One-to-One)
    public function domisili()
    {
        return $this->hasOne(SuratPengantarDomisili::class, 'surat_pengajuan_id');
    }

    // Relasi ke tabel Surat Pengantar Nikah (One-to-One)
    public function nikah()
    {
        return $this->hasOne(SuratPengantarNikah::class, 'surat_pengajuan_id');
    }
}
