<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admins extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_admin';
    protected $fillable = [
        'username',
        'password',
    ];
    protected $hidden = [
        'id_admin',
        'password',
    ];
}
