<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // Cek apakah pengguna terautentikasi dan memiliki role yang diizinkan
        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'pengawas', 'petugas'])) {
            // Ambil semua data user dengan relasi lokasi
            $users = User::with('lokasi')->get();

            // Tentukan tampilan berdasarkan role pengguna
            if (Auth::user()->role == 'admin') {
                return view('admin.userManagemen.index', compact('users'));
            } elseif (Auth::user()->role == 'pengawas') {
                return view('pengawas.userManagemen.index', compact('users'));
            } elseif (Auth::user()->role == 'petugas') {
                return view('petugas.userManagemen.index', compact('users'));
            }
        }

        // Jika tidak memiliki role yang sesuai, redirect ke halaman login dengan pesan error
        return redirect()->route('login')->withErrors(['role' => 'Unauthorized']);
    }

    public function create()
    {
        $lokasi = Lokasi::all();
        return view('admin.userManagemen.create', compact('lokasi'));
    }

    private function validateUser(Request $request, User $user = null)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email' . ($user ? ",{$user->id_user},id_user" : ''),
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:admin,pengawas,petugas',
            'nomor_hp' => 'required|string|max:15',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_lokasi' => 'required|exists:lokasi,id_lokasi',
        ];

        return $request->validate($rules);
    }

    public function store(Request $request)
    {
        $this->validateUser($request);

        $user = new User();
        $user->name = $request->name;
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->nomor_hp = $request->nomor_hp;
        $user->id_lokasi = $request->id_lokasi;
        $user->is_active = $request->has('is_active');

        if ($request->hasFile('foto')) {
            $user->foto = $request->file('foto')->store('public/foto_users');
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit($id_user)
    {
        $lokasi = Lokasi::all();
        $user = User::findOrFail($id_user); // Cari berdasarkan id_user
        return view('admin.userManagemen.edit', compact('user', 'lokasi'));
    }

    public function update(Request $request, $id_user)
    {
        $user = User::findOrFail($id_user);

        $this->validateUser($request, $user);

        try {
            $user->name = $request->name;
            $user->fullname = $request->fullname;
            $user->email = $request->email;

            if ($request->password) {
                $user->password = Hash::make($request->password);
            }

            $user->role = $request->role;
            $user->nomor_hp = $request->nomor_hp;
            $user->id_lokasi = $request->id_lokasi;
            $user->is_active = $request->has('is_active');

            if ($request->hasFile('foto')) {
                if ($user->foto && Storage::exists($user->foto)) {
                    Storage::delete($user->foto);
                }

                $user->foto = $request->file('foto')->store('public/foto_users');
            }

            $user->save();

            return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update user: ' . $e->getMessage());
        }
    }

    public function destroy($id_user)
    {
        try {
            // Cari pengguna berdasarkan id_user
            $user = User::findOrFail($id_user);

            // Hapus file foto jika ada
            if ($user->foto && Storage::exists($user->foto)) {
                Storage::delete($user->foto);
            }

            // Hapus pengguna dari database
            $user->delete();

            return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.users.index')->with('error', 'Failed to delete user: ' . $e->getMessage());
        }
    }
}
