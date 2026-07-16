<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

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

    public function notifikasis(): HasMany
    {
        return $this->hasMany(Notifikasi::class, 'id_user', 'id_user');
    }

    public function bergabungs(): HasMany
    {
        return $this->hasMany(Bergabung::class, 'id_user', 'id_user');
    }

    public function kelasDiikuti(): BelongsToMany
    {
        return $this->belongsToMany(Kelas::class, 'bergabungs', 'id_user', 'id_kelas')
                    ->withPivot('created_at')
                    ->withTimestamps();
    }

    public function kelasDibuat(): HasMany
    {
        return $this->hasMany(Kelas::class, 'id_user', 'id_user');
    }

    public function presensis(): HasMany
    {
        return $this->hasMany(Presensi::class, 'id_user', 'id_user');
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isUser(): bool
    {
        return $this->role === 'user';
    }
}