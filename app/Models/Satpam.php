<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Satpam extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'pos_jaga',
        'jadwal_jaga',
        'shift',
        'area_patrol',
        'status_tugas'
    ];

    // Relasi One to One (User)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi One to Many (Notifikasi)
    public function notifikasis()
    {
        return $this->hasMany(Notifikasi::class);
    }
}
