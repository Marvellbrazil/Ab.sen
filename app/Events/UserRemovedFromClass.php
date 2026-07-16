<?php

namespace App\Events;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserRemovedFromClass
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public Kelas $kelas,
        public User $user,
        public User $remover
    ) {}
}
