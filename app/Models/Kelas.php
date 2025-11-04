<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function getRouteKeyName()
    {
        return 'id_kelas';
    }

    // ==========================
    // RELASI - PERBAIKAN UTAMA
    // ==========================

    // PERBAIKAN: Pastikan foreign key dan owner key benar
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    // Relasi many-to-many dengan users melalui bergabungs
    public function anggota()
    {
        return $this->belongsToMany(User::class, 'bergabungs', 'id_kelas', 'id_user')
                    ->withPivot('created_at')
                    ->withTimestamps();
    }

    // Kelas memiliki banyak presensi
    public function presensi()
    {
        return $this->hasMany(Presensi::class, 'id_kelas', 'id_kelas');
    }
}