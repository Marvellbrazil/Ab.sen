<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }
}
