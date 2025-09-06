<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    protected $table = 'presensis';
    protected $primaryKey = 'id_presensi';
    protected $fillable = [
        'id_user',
        'id_kelas',
        'link_foto',
        'link_video',
        'deskripsi',
    ];
    protected $hidden = [
        'id_presensi',
        'created_at',
        'updated_at',
    ];
}
