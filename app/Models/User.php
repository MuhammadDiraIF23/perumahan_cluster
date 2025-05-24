<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'nama', 'nik', 'email', 'password', 'no_whatsapp', 
        'no_telepon', 'alamat', 'foto_diri', 'akses'
    ];

    // Relasi many-to-many ke Role
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id');
    }

    // Akses role utama (misalnya untuk x-user-table)
    public function getPrimaryRoleAttribute()
    {
        return $this->roles->first();
    }

    // Relasi tambahan
    public function warga()
    {
        return $this->hasOne(Warga::class);
    }

    public function satpam()
    {
        return $this->hasOne(Satpam::class);
    }

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Auto hash password
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::needsRehash($value) ? Hash::make($value) : $value;
    }
}
