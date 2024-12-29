<?php

namespace App\Http\Controllers;

use App\Models\LaporanKegiatan;
use App\Models\Lokasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KegiatanHarianController extends Controller
{
    public function index()
    {
        // Cek apakah pengguna terautentikasi dan memiliki role yang diizinkan
        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'pengawas', 'petugas'])) {
            // Ambil data kegiatan harian beserta relasinya
            $kegiatanHarian = LaporanKegiatan::with(['user', 'lokasi'])
                ->where('jenis_kegiatan', 'Harian')
                ->paginate(10);

            // Tentukan tampilan berdasarkan role pengguna
            if (Auth::user()->role == 'admin') {
                return view('admin.kegiatan.harian.index', compact('kegiatanHarian'));
            } elseif (Auth::user()->role == 'pengawas') {
                return view('pengawas.kegiatan.harian.index', compact('kegiatanHarian'));
            } elseif (Auth::user()->role == 'petugas') {
                return view('petugas.kegiatan.harian.index', compact('kegiatanHarian'));
            }
        }
        // Jika tidak memiliki role yang sesuai, redirect ke halaman login dengan pesan error
        return redirect()->route('login')->withErrors(['role' => 'Unauthorized']);
    }

    public function create()
    {
        // Cek apakah pengguna terautentikasi dan memiliki role yang diizinkan
        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'pengawas', 'petugas'])) {
            // Ambil data user dan lokasi untuk form
            $users = User::all();
            $lokasis = Lokasi::all();

            // Tentukan tampilan berdasarkan role pengguna
            if (Auth::user()->role == 'admin') {
                return view('admin.kegiatan.harian.create', compact('users', 'lokasis'));
            } elseif (Auth::user()->role == 'pengawas') {
                return view('pengawas.kegiatan.harian.create', compact('users', 'lokasis'));
            } elseif (Auth::user()->role == 'petugas') {
                return view('petugas.kegiatan.harian.create', compact('users', 'lokasis'));
            }
        }

        // Jika tidak memiliki role yang sesuai, redirect ke halaman login dengan pesan error
        return redirect()->route('login')->withErrors(['role' => 'Unauthorized']);
    }


    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'id_lokasi' => 'required|exists:lokasi,id_lokasi',
            'tanggal_kegiatan' => 'required|date',
            'deskripsi' => 'required|string|max:255',
        ]);

        // Simpan data ke database
        LaporanKegiatan::create([
            'id_user' => $request->id_user,
            'id_lokasi' => $request->id_lokasi,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'jenis_kegiatan' => 'Harian',
            'deskripsi' => $request->deskripsi,
        ]);

        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'pengawas', 'petugas'])) {
            // Tentukan redirect berdasarkan role pengguna
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.kegiatan.harian.index')->with('success', 'Kegiatan Harian berhasil ditambahkan.');
            } elseif (Auth::user()->role == 'pengawas') {
                return redirect()->route('pengawas.kegiatan.harian.index')->with('success', 'Kegiatan Harian berhasil ditambahkan.');
            } elseif (Auth::user()->role == 'petugas') {
                return redirect()->route('petugas.kegiatan.harian.index')->with('success', 'Kegiatan Harian berhasil ditambahkan.');
            }
        }

        // Jika role tidak dikenali atau pengguna tidak terautentikasi
        return redirect()->back()->with('error', 'Akses tidak diizinkan.');
    }

    public function edit(LaporanKegiatan $kegiatanHarian)
    {
        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'pengawas', 'petugas'])) {
            // Ambil data pengguna, lokasi, dan laporan kegiatan yang akan diedit
            $users = User::all();
            $lokasis = Lokasi::all();

            // Tentukan tampilan berdasarkan role pengguna
            if (Auth::user()->role == 'admin') {
                return view('admin.kegiatan.harian.edit', compact('kegiatanHarian', 'users', 'lokasis'));
            } elseif (Auth::user()->role == 'pengawas') {
                return view('pengawas.kegiatan.harian.edit', compact('kegiatanHarian', 'users', 'lokasis'));
            } elseif (Auth::user()->role == 'petugas') {
                return view('petugas.kegiatan.harian.edit', compact('kegiatanHarian', 'users', 'lokasis'));
            }
        }

        // Jika role tidak dikenali atau pengguna tidak terautentikasi
        return redirect()->back()->with('error', 'Akses tidak diizinkan.');
    }


    public function update(Request $request, LaporanKegiatan $kegiatanHarian)
    {
        // Validasi input
        $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'id_lokasi' => 'required|exists:lokasi,id_lokasi',
            'tanggal_kegiatan' => 'required|date',
            'deskripsi' => 'required|string|max:255',
        ]);

        // Update data di database
        $kegiatanHarian->update([
            'id_user' => $request->id_user,
            'id_lokasi' => $request->id_lokasi,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'deskripsi' => $request->deskripsi,
        ]);

        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'pengawas', 'petugas'])) {
            // Tentukan redirect berdasarkan role pengguna
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.kegiatan.harian.index')->with('success', 'Kegiatan Harian berhasil diupdate.');
            } elseif (Auth::user()->role == 'pengawas') {
                return redirect()->route('pengawas.kegiatan.harian.index')->with('success', 'Kegiatan Harian berhasil diupdate.');
            } elseif (Auth::user()->role == 'petugas') {
                return redirect()->route('petugas.kegiatan.harian.index')->with('success', 'Kegiatan Harian berhasil diupdate.');
            }
        }

        // Jika role tidak dikenali atau pengguna tidak terautentikasi
        return redirect()->back()->with('error', 'Akses tidak diizinkan.');
    }

    public function destroy(LaporanKegiatan $kegiatanHarian)
    {
        // Hapus data dari database
        $kegiatanHarian->delete();

        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'pengawas', 'petugas'])) {
            // Tentukan redirect berdasarkan role pengguna
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.kegiatan.harian.index')->with('success', 'Kegiatan Harian berhasil dihapus.');
            } elseif (Auth::user()->role == 'pengawas') {
                return redirect()->route('pengawas.kegiatan.harian.index')->with('success', 'Kegiatan Harian berhasil dihapus.');
            } elseif (Auth::user()->role == 'petugas') {
                return redirect()->route('petugas.kegiatan.harian.index')->with('success', 'Kegiatan Harian berhasil dihapus.');
            }
        }

        // Jika role tidak dikenali atau pengguna tidak terautentikasi
        return redirect()->back()->with('error', 'Akses tidak diizinkan.');
    }
}
