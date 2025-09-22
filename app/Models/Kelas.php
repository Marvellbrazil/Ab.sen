<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';
    protected $fillable = [
        'id_account',
        'foto_kelas',
        'nama_kelas',
        'kode_kelas',
        'subnama_kelas',
        'jumlah_anggota',
        'jumlah_maksimal'
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
