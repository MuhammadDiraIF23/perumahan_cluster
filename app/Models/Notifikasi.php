<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notifikasi extends Model
{
    use HasFactory;
    protected $fillable = [
        'warga_id',
        'satpam_id',
        'tipe_notifikasi',
        'pesan',
        'status'
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }

    public function satpam()
    {
        return $this->belongsTo(Satpam::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function notifikasiTamu()
    {
        return $this->hasOne(NotifikasiTamu::class);
    }

    public function notifikasiPengaduan()
    {
        return $this->hasOne(NotifikasiPengaduan::class);
    }

    public function notifikasiSuratPengajuan()
    {
        return $this->hasOne(NotifikasiSuratPengajuan::class);
    }
}


