<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotifikasiPengaduan extends Model
{
    protected $table = 'notifikasi_pengaduan';
    protected $fillable = [
        'notifikasi_id',
        'pengaduan_aspirasi_id'
    ];

    public function notifikasi()
    {
        return $this->belongsTo(Notifikasi::class);
    }

    public function pengaduanAspirasi()
    {
        return $this->belongsTo(PengaduanAspirasi::class);
    }
}

