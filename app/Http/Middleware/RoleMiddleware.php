<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Cek apakah user sudah login dan memiliki role yang sesuai
        if (Auth::check() && Auth::user()->role->name === $role) {
            return $next($request);
        }

        // Jika tidak sesuai, kembalikan ke halaman welcome dengan pesan error
        return redirect('/')->withErrors(['access' => 'Anda tidak memiliki hak akses untuk halaman tersebut.']);
    }
}
