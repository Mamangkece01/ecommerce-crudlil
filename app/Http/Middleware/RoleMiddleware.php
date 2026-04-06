<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Cek apakah user sudah login dan role-nya sesuai dengan parameter yang diberikan
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request);
        }

        // Kalau tidak sesuai, kembalikan ke home atau dashboard
        return redirect('/')->with('error', 'Akses ditolak! Anda tidak memiliki izin untuk halaman ini.');
    }
}
