<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Jika belum login, atau role-nya tidak sesuai dengan yang diminta rute
        if (!Auth::check() || Auth::user()->role !== $role) {
            // Tampilkan error 403 Forbidden (Akses Ditolak)
            abort(403, 'Akses Ditolak. Anda salah masuk kamar nih! 😎');
        }

        return $next($request);
    }
}
