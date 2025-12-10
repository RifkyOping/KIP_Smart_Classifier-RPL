<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Jika belum login
        if (!Auth::check()) {
            return redirect('/')->with('error', 'Silahkan login terlebih dahulu.');
        }

        // Role user
        $userRole = Auth::user()->role;

        // Cek apakah role sesuai
        if (!in_array($userRole, $roles)) {
            return redirect('/beranda')->with('error', 'Anda tidak memiliki akses.');
        }

        return $next($request);
    }
}
