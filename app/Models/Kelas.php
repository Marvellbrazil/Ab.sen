<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $primaryKey = 'id_kelas';

    protected $fillable = [
        'nama_kelas',
        'deskripsi_kelas',
        'gambar_kelas',
        'id_user',
        'kode_kelas'
    ];

    public function anggota()
    {
        return $this->hasMany(Bergabung::class, 'id_kelas', 'id_kelas');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function bergabung()
    {
        return $this->hasOne(Bergabung::class, 'id_kelas', 'id_kelas')
                    ->where('id_user', auth()->id());
    }

    public function presensis()
    {
        return $this->hasMany(Presensi::class, 'id_kelas', 'id_kelas');
    }
}