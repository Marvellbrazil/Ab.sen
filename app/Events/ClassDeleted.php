<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ClassDeleted
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public int $idKelas,
        public string $namaKelas,
        public User $deleter,
        public array $memberUserIds
    ) {}
}
