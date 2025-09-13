<?php

namespace Illuminate\Http;

interface Request
{
    /**
     * @return \App\Models\Account|null
     */
    public function user($guard = null);
}