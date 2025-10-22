<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
        return $next($request);
    }

    // Kalau bukan admin, lempar ke halaman login atau 403
    return redirect('/login')->with('error', 'Akses ditolak!');
    }
}