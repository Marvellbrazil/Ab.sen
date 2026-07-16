<?php

namespace App\Events;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ClassUpdated
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public Kelas $kelas,
        public array $oldData,
        public array $newData,
        public User $updater
    ) {}
}
