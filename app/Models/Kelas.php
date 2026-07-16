<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';
    public $timestamps = true;

    protected $fillable = [
        'nama_kelas',
        'kode_kelas',
        'deskripsi_kelas',
        'id_user',
        'waktu_mulai',
        'waktu_selesai',
        'gambar_kelas'
    ];

    public function getRouteKeyName(): string
    {
        return 'id_kelas';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function anggota(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'bergabungs', 'id_kelas', 'id_user')
                    ->withPivot('created_at')
                    ->withTimestamps();
    }

    public function presensi(): HasMany
    {
        return $this->hasMany(Presensi::class, 'id_kelas', 'id_kelas');
    }
}
