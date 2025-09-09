<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_account';
    protected $fillable = [
        'name',
        'username',
        'password',
        'role'
    ];
    protected $hidden = [
        'id_admin',
        'password',
    ];
}
