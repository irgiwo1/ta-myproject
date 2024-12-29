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
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Periksa apakah pengguna sudah login dan memiliki peran yang sesuai
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request);
        }

        // Jika tidak sesuai, arahkan kembali ke halaman login dengan pesan kesalahan
        return redirect()->route('login')->withErrors(['role' => 'Anda tidak memiliki akses ke halaman ini.']);


        // $user = session('user'); // Pastikan Anda menyimpan user di session saat login.

        // if ($user && isset($user['role']) && $user['role'] === $role) {
        //     return $next($request);
        // }

        // // Jika tidak sesuai, arahkan ke halaman login
        // return redirect('login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
