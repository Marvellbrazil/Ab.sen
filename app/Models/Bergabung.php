<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bergabung extends Model
{
    use HasFactory;

    protected $table = 'bergabungs';
    protected $primaryKey = 'id_bergabung';

    protected $fillable = [
        'id_user',
        'id_kelas',
        'status',
        'created_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }
}