<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login'); // Pastikan Anda memiliki view 'auth/login.blade.php'
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Cari pengguna berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Verifikasi password
        if ($user && Hash::check($request->password, $user->password)) {
            // Simpan data pengguna ke session
            session(['user' => [
                'id' => $user->id,
                'role' => $user->role,
                'name' => $user->name,
            ]]);

            // Arahkan berdasarkan role
            if ($user->role === 'admin') {
                return redirect('/admin')->with('success', 'Login sebagai Admin berhasil.');
            } elseif ($user->role === 'pengawas') {
                return redirect('/pengawas')->with('success', 'Login sebagai Pengawas berhasil.');
            } elseif ($user->role === 'petugas') {
                return redirect('/petugas')->with('success', 'Login sebagai Petugas berhasil.');
            }
        }

        // Jika login gagal
        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    // Proses logout
    public function logout()
    {
        session()->forget('user'); // Hapus data pengguna dari session
        return redirect('/login')->with('success', 'Logout berhasil.');
    }
}
