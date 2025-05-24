<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratPengantarDomisili extends Model
{
    use HasFactory;

    protected $fillable = [
        'surat_pengajuan_id',
        'status_hubungan',
        'nama_pemohon',
        'nik',
        'alamat',
        'no_telepon',
        'tanggal_lahir',
        'tempat_lahir',
        'status_perkawinan',
        'foto_ktp_pemohon'
    ];

    // Relasi ke tabel SuratPengajuan (One-to-One Inverse)
    public function suratPengajuan()
    {
        return $this->belongsTo(SuratPengajuan::class, 'surat_pengajuan_id');
    }
}
