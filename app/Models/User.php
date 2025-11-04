<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'profile_picture'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relationship dengan Notifikasi
    public function notifikasis()
    {
        return $this->hasMany(Notifikasi::class, 'id_user', 'id_user');
    }

    // PERBAIKAN: Relationship dengan Bergabung (pivot table)
    public function bergabungs()
    {
        return $this->hasMany(Bergabung::class, 'id_user', 'id_user');
    }

    // PERBAIKAN: Relationship dengan Kelas melalui Bergabung (many-to-many)
    public function kelasDiikuti()
    {
        return $this->belongsToMany(Kelas::class, 'bergabungs', 'id_user', 'id_kelas')
                    ->withPivot('created_at')
                    ->withTimestamps();
    }

    // Relationship dengan Kelas yang dibuat (sebagai pengajar)
    public function kelasDibuat()
    {
        return $this->hasMany(Kelas::class, 'id_user', 'id_user');
    }

    // Relationship dengan Presensi
    public function presensis()
    {
        return $this->hasMany(Presensi::class, 'id_user', 'id_user');
    }

    // Method untuk cek role
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }
}