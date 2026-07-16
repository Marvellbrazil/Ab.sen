<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Notifikasi extends Model
{
    use HasFactory;
    
    protected $table = 'notifikasis';
    protected $primaryKey = 'id_notifikasi';

    protected $fillable = [
        'id_user',
        'id_kelas',
        'pesan_notifikasi',
        'tipe_notifikasi',
        'status',
        'is_checked'
    ];

    protected $casts = [
        'is_checked' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function scopeUnread(Builder $query): Builder
    {
        return $query->where('status', 'unread');
    }

    public function scopeRead(Builder $query): Builder
    {
        return $query->where('status', 'read');
    }

    public function scopeChecked(Builder $query): Builder
    {
        return $query->where('is_checked', true);
    }

    public function markAsRead(): void
    {
        $this->update(['status' => 'read']);
    }

    public function markAsChecked(): void
    {
        $this->update(['is_checked' => true]);
    }
}
