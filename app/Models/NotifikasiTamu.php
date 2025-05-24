<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotifikasiTamu extends Model
{
    protected $table = 'notifikasi_tamu'; // ← Pastikan ini benar
    protected $fillable = [
        'notifikasi_id',
        'tamu_id'
    ];

    public function notifikasi()
    {
        return $this->belongsTo(Notifikasi::class);
    }

    public function tamu()
    {
        return $this->belongsTo(Tamu::class);
    }
}
