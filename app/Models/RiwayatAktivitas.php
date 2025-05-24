<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RiwayatAktivitas extends Model
{
    use HasFactory;
    protected $fillable = [
        'warga_id',
        'jenis_aktivitas',
        'aktivitas_id',
        'tanggal_aktivitas',
        'status'
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }

    public function suratPengajuan()
    {
        return $this->belongsTo(SuratPengajuan::class, 'aktivitas_id');
    }
    public function aktivitas()
    {
        if ($this->jenis_aktivitas === 'Surat Pengajuan') {
            return $this->belongsTo(SuratPengajuan::class, 'aktivitas_id');
        } else if ($this->jenis_aktivitas === 'Pengaduan & Aspirasi') {
            return $this->belongsTo(PengaduanAspirasi::class, 'aktivitas_id');
        }
    }
}
