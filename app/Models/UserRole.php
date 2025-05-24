<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'role_id'];

    // 🔎 Relasi ke model Role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // 🔎 Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
