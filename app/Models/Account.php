<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Account extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'accounts';
    protected $primaryKey = 'id_account';

    protected $fillable = [
        'name',
        'username',
        'email',
        'raw_password',
        'password',
        'role',
        'profile'
    ];

    protected $hidden = [
        'raw_password',
        'password',
        'remember_token',
    ];

    protected $casts = [
        'last_login' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Define the default attributes
    protected $attributes = [
        'role' => 'user',
    ];

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'id_account';
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->{$this->getAuthIdentifierName()};
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Check if user is admin
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is regular user
     *
     * @return bool
     */
    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    /**
     * Get formatted last login time
     *
     * @return string
     */
    public function getFormattedLastLogin(): string
    {
        if (!$this->last_login) {
            return 'Never';
        }

        return $this->last_login->diffForHumans();
    }

    /**
     * Get user's initials for avatar
     *
     * @return string
     */
    public function getInitials(): string
    {
        $names = explode(' ', trim($this->name));
        $initials = '';

        foreach ($names as $name) {
            $initials .= strtoupper(substr($name, 0, 1));
        }

        return substr($initials, 0, 2);
    }

    /**
     * Get first name
     *
     * @return string
     */
    public function getFirstName(): string
    {
        return explode(' ', trim($this->name))[0];
    }

    /**
     * Scope for admin users
     */
    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    /**
     * Scope for regular users
     */
    public function scopeUsers($query)
    {
        return $query->where('role', 'user');
    }

    /**
     * Scope for recent users (last 30 days)
     */
    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', Carbon::now()->subDays($days));
    }

    /**
     * Scope for active users (logged in within specified days)
     */
    public function scopeActive($query, $days = 30)
    {
        return $query->where('last_login', '>=', Carbon::now()->subDays($days));
    }

    /**
     * Get role badge color for UI
     *
     * @return string
     */
    public function getRoleBadgeColor(): string
    {
        return match($this->role) {
            'admin' => 'danger',
            'user' => 'primary',
            default => 'secondary'
        };
    }

    /**
     * Check if account was created today
     *
     * @return bool
     */
    public function isNewUser(): bool
    {
        return $this->created_at->isToday();
    }

    /**
     * Get account age in days
     *
     * @return int
     */
    public function getAccountAge(): int
    {
        return $this->created_at->diffInDays(Carbon::now());
    }
}
