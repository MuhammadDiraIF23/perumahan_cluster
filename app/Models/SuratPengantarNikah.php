<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratPengantarNikah extends Model
{
    use HasFactory;

    protected $fillable = [
        'surat_pengajuan_id',
        'status_hubungan',
        'nama_lengkap_pemohon',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat_ktp',
        'nik',
        'agama',
        'status_pernikahan',
        'pekerjaan',
        'nama_ayah',
        'nama_ibu',
        'fotokopi_ktp',
        'fotokopi_kk'
    ];

    // Relasi ke tabel SuratPengajuan (One-to-One Inverse)
    public function suratPengajuan()
    {
        return $this->belongsTo(SuratPengajuan::class, 'surat_pengajuan_id');
    }
}
