<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = 'notifikasis';
    protected $primaryKey = 'id_notifikasi';

    protected $fillable = [
        'id_user',
        'id_kelas', // tambahkan
        'pesan_notifikasi',
        'tipe_notifikasi',
        'status',
        'is_checked' // tambahkan
    ];

    protected $casts = [
        'is_checked' => 'boolean'
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
     * Accessor untuk format tanggal
     */
    public function getTanggalAttribute()
    {
        return $this->created_at->format('d/m/Y');
    }

    /**
     * Accessor untuk nama kelas
     */
    public function getNamaKelasAttribute()
    {
        return $this->kelas ? $this->kelas->nama_kelas : 'System';
    }
}