<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockAssetsMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek flag dari .env dan apakah URL mengarah ke /assets/*
        if (env('BLOCK_ASSETS') === 'true' && ($request->is('assets') || $request->is('assets/*'))) {
            abort(403, 'Akses ke folder /assets/ diblokir oleh sistem.');
        }
        
        return $next($request);
    }
}
