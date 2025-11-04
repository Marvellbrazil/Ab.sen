<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
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

    /**
     * Relationship dengan User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    /**
     * Relationship dengan Kelas
     */
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    /**
     * Scope untuk notifikasi belum dibaca
     */
    public function scopeUnread($query)
    {
        return $query->where('status', 'unread');
    }

    /**
     * Scope untuk notifikasi sudah dibaca
     */
    public function scopeRead($query)
    {
        return $query->where('status', 'read');
    }

    /**
     * Scope untuk notifikasi yang dicentang
     */
    public function scopeChecked($query)
    {
        return $query->where('is_checked', true);
    }

    /**
     * Mark as read
     */
    public function markAsRead()
    {
        $this->update(['status' => 'read']);
    }

    /**
     * Mark as checked
     */
    public function markAsChecked()
    {
        $this->update(['is_checked' => true]);
    }
}