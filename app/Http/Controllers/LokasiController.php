<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LokasiController extends Controller
{
    public function index()
    {
        // Cek apakah pengguna terautentikasi dan memiliki role yang diizinkan
        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'pengawas', 'petugas'])) {
            // Ambil semua data lokasi
            $lokasi = Lokasi::all();

            // Tentukan tampilan berdasarkan role pengguna
            if (Auth::user()->role == 'admin') {
                return view('admin.master.lokasi.index', compact('lokasi'));
            } elseif (Auth::user()->role == 'pengawas') {
                return view('pengawas.master.lokasi.index', compact('lokasi'));
            } elseif (Auth::user()->role == 'petugas') {
                return view('petugas.master.lokasi.index', compact('lokasi'));
            }
        }

        // Jika tidak memiliki role yang sesuai, redirect ke halaman login dengan pesan error
        return redirect()->route('login')->withErrors(['role' => 'Unauthorized']);
    }

    public function create()
    {
        return view('admin.master.lokasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lokasi' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
        ]);

        Lokasi::create($request->all());
        return redirect()->route('admin.master.lokasi.index')->with('success', 'Lokasi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $lokasi = Lokasi::findOrFail($id);
        return view('admin.master.lokasi.edit', compact('lokasi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lokasi' => 'required|string|max:255',
            'alamat' => 'required|string',
        ]);

        $lokasi = Lokasi::findOrFail($id);
        $lokasi->update([
            'nama_lokasi' => $request->nama_lokasi,
            'alamat' => $request->alamat,
        ]);

        // Redirect langsung ke daftar lokasi dengan pesan sukses
        return redirect()->route('admin.master.lokasi.index')->with('success', 'Lokasi berhasil diperbarui!');
    }


    public function destroy($id)
    {
        $lokasi = Lokasi::findOrFail($id);
        $lokasi->delete();

        return redirect()->route('admin.master.lokasi.index')->with('success', 'Lokasi berhasil dihapus!');
    }
}
