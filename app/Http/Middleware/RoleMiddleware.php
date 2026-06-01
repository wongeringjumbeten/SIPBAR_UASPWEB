<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        $user = Auth::user();

        // Cek apakah user aktif
        if (!$user->is_active) {
            Auth::logout();
            return redirect('/login')->with('error', 'Akun Anda telah dinonaktifkan');
        }

        // Jika roles parameter kosong, izinkan akses
        if (empty($roles)) {
            return $next($request);
        }

        // Cek apakah role user termasuk dalam roles yang diizinkan
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // Jika role tidak sesuai, redirect ke dashboard masing-masing
        if ($user->role == 'admin') {
            return redirect('/dashboard/admin')->with('error', 'Akses ditolak!');
        } elseif ($user->role == 'petugas') {
            return redirect('/dashboard/petugas')->with('error', 'Akses ditolak!');
        } else {
            return redirect('/dashboard/mahasiswa')->with('error', 'Akses ditolak!');
        }
    }
}
