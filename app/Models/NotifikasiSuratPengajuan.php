<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotifikasiSuratPengajuan extends Model
{
    protected $table = 'notifikasi_surat_pengajuan';
    protected $fillable = [
        'notifikasi_id',
        'surat_pengajuan_id'
    ];

    public function notifikasi()
    {
        return $this->belongsTo(Notifikasi::class);
    }

    public function suratPengajuan()
    {
        return $this->belongsTo(SuratPengajuan::class);
    }
}
