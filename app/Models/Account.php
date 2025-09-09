<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'accounts';
    protected $primaryKey = 'id_account';
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role'
    ];
    protected $hidden = [
        'id_account',
        'raw_password',
        'password',
        'updated_at',
        'created_at',
        'last_login',
        'profile',
    ];
}
