<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Admin Middleware
 *
 * Run: php artisan make:middleware AdminMiddleware
 */
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized. Admin access required.');
        }

        return $next($request);
    }
}

// ========================================

/**
 * User Middleware
 *
 * Run: php artisan make:middleware UserMiddleware
 */
class UserMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role !== 'user') {
            abort(403, 'Unauthorized. User access required.');
        }

        return $next($request);
    }
}

// ========================================

/**
 * Role Middleware (Alternative - more flexible)
 *
 * Run: php artisan make:middleware RoleMiddleware
 */
class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role !== $role) {
            abort(403, 'Unauthorized. ' . ucfirst($role) . ' access required.');
        }

        return $next($request);
    }
}

/*
|--------------------------------------------------------------------------
| Middleware Registration Instructions
|--------------------------------------------------------------------------
|
| Add these to your app/Http/Kernel.php file:
|
| protected $middlewareAliases = [
|     // ... other middleware
|     'admin' => \App\Http\Middleware\AdminMiddleware::class,
|     'user' => \App\Http\Middleware\UserMiddleware::class,
|     'role' => \App\Http\Middleware\RoleMiddleware::class,
| ];
|
| If using the RoleMiddleware, you can use it in routes like:
| Route::middleware('role:admin')->group(function () {
|     // Admin routes
| });
|
| Route::middleware('role:user')->group(function () {
|     // User routes
| });
|
*/
