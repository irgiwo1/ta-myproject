<?php

namespace App\Http\Controllers;

use App\Models\LaporanKegiatan;
use App\Models\Lokasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KegiatanBulananController extends Controller
{
    public function index()
    {
        // Cek apakah pengguna terautentikasi dan memiliki role yang diizinkan
        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'pengawas', 'petugas'])) {
            // Ambil data kegiatan bulanan beserta relasinya
            $kegiatanBulanan = LaporanKegiatan::with(['user', 'lokasi'])
                ->where('jenis_kegiatan', 'Bulanan')
                ->paginate(10);

            // Tentukan tampilan berdasarkan role pengguna
            if (Auth::user()->role == 'admin') {
                return view('admin.kegiatan.bulanan.index', compact('kegiatanBulanan'));
            } elseif (Auth::user()->role == 'pengawas') {
                return view('pengawas.kegiatan.bulanan.index', compact('kegiatanBulanan'));
            } elseif (Auth::user()->role == 'petugas') {
                return view('petugas.kegiatan.bulanan.index', compact('kegiatanBulanan'));
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
                return view('admin.kegiatan.bulanan.create', compact('users', 'lokasis'));
            } elseif (Auth::user()->role == 'pengawas') {
                return view('pengawas.kegiatan.bulanan.create', compact('users', 'lokasis'));
            } elseif (Auth::user()->role == 'petugas') {
                return view('petugas.kegiatan.bulanan.create', compact('users', 'lokasis'));
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
            'jenis_kegiatan' => 'Bulanan',
            'deskripsi' => $request->deskripsi,
        ]);

        // Tentukan redirect berdasarkan role pengguna
        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'pengawas', 'petugas'])) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.kegiatan.bulanan.index')->with('success', 'Kegiatan Bulanan berhasil ditambahkan.');
            } elseif (Auth::user()->role == 'pengawas') {
                return redirect()->route('pengawas.kegiatan.bulanan.index')->with('success', 'Kegiatan Bulanan berhasil ditambahkan.');
            } elseif (Auth::user()->role == 'petugas') {
                return redirect()->route('petugas.kegiatan.bulanan.index')->with('success', 'Kegiatan Bulanan berhasil ditambahkan.');
            }
        }

        // Jika role tidak dikenali atau pengguna tidak terautentikasi
        return redirect()->back()->with('error', 'Akses tidak diizinkan.');
    }

    public function edit(LaporanKegiatan $kegiatanBulanan)
    {
        // Cek apakah pengguna terautentikasi dan memiliki role yang diizinkan
        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'pengawas', 'petugas'])) {
            // Ambil data pengguna, lokasi, dan laporan kegiatan yang akan diedit
            $users = User::all();
            $lokasis = Lokasi::all();

            // Tentukan tampilan berdasarkan role pengguna
            if (Auth::user()->role == 'admin') {
                return view('admin.kegiatan.bulanan.edit', compact('kegiatanBulanan', 'users', 'lokasis'));
            } elseif (Auth::user()->role == 'pengawas') {
                return view('pengawas.kegiatan.bulanan.edit', compact('kegiatanBulanan', 'users', 'lokasis'));
            } elseif (Auth::user()->role == 'petugas') {
                return view('petugas.kegiatan.bulanan.edit', compact('kegiatanBulanan', 'users', 'lokasis'));
            }
        }

        // Jika role tidak dikenali atau pengguna tidak terautentikasi
        return redirect()->back()->with('error', 'Akses tidak diizinkan.');
    }

    public function update(Request $request, LaporanKegiatan $kegiatanBulanan)
    {
        // Validasi input
        $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'id_lokasi' => 'required|exists:lokasi,id_lokasi',
            'tanggal_kegiatan' => 'required|date',
            'deskripsi' => 'required|string|max:255',
        ]);

        // Update data di database
        $kegiatanBulanan->update([
            'id_user' => $request->id_user,
            'id_lokasi' => $request->id_lokasi,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'deskripsi' => $request->deskripsi,
        ]);

        // Tentukan redirect berdasarkan role pengguna
        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'pengawas', 'petugas'])) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.kegiatan.bulanan.index')->with('success', 'Kegiatan Bulanan berhasil diupdate.');
            } elseif (Auth::user()->role == 'pengawas') {
                return redirect()->route('pengawas.kegiatan.bulanan.index')->with('success', 'Kegiatan Bulanan berhasil diupdate.');
            } elseif (Auth::user()->role == 'petugas') {
                return redirect()->route('petugas.kegiatan.bulanan.index')->with('success', 'Kegiatan Bulanan berhasil diupdate.');
            }
        }

        // Jika role tidak dikenali atau pengguna tidak terautentikasi
        return redirect()->back()->with('error', 'Akses tidak diizinkan.');
    }

    public function destroy(LaporanKegiatan $kegiatanBulanan)
    {
        // Hapus data dari database
        $kegiatanBulanan->delete();

        // Tentukan redirect berdasarkan role pengguna
        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'pengawas', 'petugas'])) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.kegiatan.bulanan.index')->with('success', 'Kegiatan Bulanan berhasil dihapus.');
            } elseif (Auth::user()->role == 'pengawas') {
                return redirect()->route('pengawas.kegiatan.bulanan.index')->with('success', 'Kegiatan Bulanan berhasil dihapus.');
            } elseif (Auth::user()->role == 'petugas') {
                return redirect()->route('petugas.kegiatan.bulanan.index')->with('success', 'Kegiatan Bulanan berhasil dihapus.');
            }
        }

        // Jika role tidak dikenali atau pengguna tidak terautentikasi
        return redirect()->back()->with('error', 'Akses tidak diizinkan.');
    }
}
