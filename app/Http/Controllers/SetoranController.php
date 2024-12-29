<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Models\Setoran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SetoranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Cek apakah pengguna terautentikasi dan memiliki role yang diizinkan
        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'pengawas', 'petugas'])) {
            // Ambil data Setoran beserta relasinya
            $setorans = Setoran::with(['user', 'lokasi'])->get();

            // Tentukan tampilan berdasarkan role pengguna
            if (Auth::user()->role == 'admin') {
                return view('admin.setoran.index', compact('setorans'));
            } elseif (Auth::user()->role == 'pengawas') {
                return view('pengawas.setoran.index', compact('setorans'));
            } elseif (Auth::user()->role == 'petugas') {
                return view('petugas.setoran.index', compact('setorans'));
            }
        }
        // Jika tidak memiliki role yang sesuai, redirect ke halaman login dengan pesan error
        return redirect()->route('login')->withErrors(['role' => 'Unauthorized']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'pengawas', 'petugas'])) {
            // Ambil data pengguna dan lokasi
            $users = User::all();
            $lokasis = Lokasi::all();

            // Tentukan tampilan berdasarkan role pengguna
            if (Auth::user()->role == 'admin') {
                return view('admin.setoran.create', compact('users', 'lokasis'));
            } elseif (Auth::user()->role == 'pengawas') {
                return view('pengawas.setoran.create', compact('users', 'lokasis'));
            } elseif (Auth::user()->role == 'petugas') {
                return view('petugas.setoran.create', compact('users', 'lokasis'));
            }
        }

        // Jika role tidak dikenali atau pengguna tidak terautentikasi
        return redirect()->back()->with('error', 'Akses tidak diizinkan.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'id_lokasi' => 'required|exists:lokasi,id_lokasi',
            'jenis_setoran' => 'required|string|max:255',
            'shift' => 'required|string|max:255',
            'pendapatan_awal' => 'required|numeric',
            'pengeluaran' => 'required|numeric',
            'keterangan' => 'required|string|max:255',
            'pendapatan_akhir' => 'required|numeric',
            'pendapatan_sistem' => 'required|numeric',
            'selisih_setoran' => 'required|numeric',
            'tanggal_transaksi' => 'required|date',
            'nomor_hp' => 'required|string|max:15',
        ]);

        Setoran::create([
            'id_user' => $request->id_user,
            'id_lokasi' => $request->id_lokasi,
            'jenis_setoran' => $request->jenis_setoran,
            'shift' => $request->shift,
            'pendapatan_awal' => $request->pendapatan_awal,
            'pengeluaran' => $request->pengeluaran,
            'keterangan' => $request->keterangan,
            'pendapatan_akhir' => $request->pendapatan_akhir,
            'pendapatan_sistem' => $request->pendapatan_sistem,
            'selisih_setoran' => $request->selisih_setoran,
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'nomor_hp' => $request->nomor_hp,
        ]);

        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'pengawas', 'petugas'])) {
            // Tentukan redirect berdasarkan role pengguna
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.setoran.index')->with('success', 'Setoran berhasil ditambahkan.');
            } elseif (Auth::user()->role == 'pengawas') {
                return redirect()->route('pengawas.setoran.index')->with('success', 'Setoran berhasil ditambahkan.');
            } elseif (Auth::user()->role == 'petugas') {
                return redirect()->route('petugas.setoran.index')->with('success', 'Setoran berhasil ditambahkan.');
            }
        }

        // Jika role tidak dikenali atau pengguna tidak terautentikasi
        return redirect()->back()->with('error', 'Akses tidak diizinkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setoran $setoran)
    {
        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'pengawas', 'petugas'])) {
            // Ambil data pengguna, lokasi, dan setoran yang akan diedit
            $users = User::all();
            $lokasis = Lokasi::all();

            // Tentukan tampilan berdasarkan role pengguna
            if (Auth::user()->role == 'admin') {
                return view('admin.setoran.edit', compact('setoran', 'users', 'lokasis'));
            } elseif (Auth::user()->role == 'pengawas') {
                return view('pengawas.setoran.edit', compact('setoran', 'users', 'lokasis'));
            } elseif (Auth::user()->role == 'petugas') {
                return view('petugas.setoran.edit', compact('setoran', 'users', 'lokasis'));
            }
        }

        // Jika role tidak dikenali atau pengguna tidak terautentikasi
        return redirect()->back()->with('error', 'Akses tidak diizinkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setoran $setoran)
    {
        // Validasi input
        $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'id_lokasi' => 'required|exists:lokasi,id_lokasi',
            'jenis_setoran' => 'required|string',
            'shift' => 'required|string',
            'pendapatan_awal' => 'required|numeric',
            'pengeluaran' => 'required|numeric',
            'keterangan' => 'required|string|max:255',
            'pendapatan_akhir' => 'required|numeric',
            'pendapatan_sistem' => 'required|numeric',
            'selisih_setoran' => 'required|numeric',
            'tanggal_transaksi' => 'required|date',
            'nomor_hp' => 'required|string',
        ]);

        // Update data setoran
        $setoran->id_user = $request->id_user;
        $setoran->id_lokasi = $request->id_lokasi;
        $setoran->jenis_setoran = $request->jenis_setoran;
        $setoran->shift = $request->shift;
        $setoran->pendapatan_awal = $request->pendapatan_awal;
        $setoran->pengeluaran = $request->pengeluaran;
        $setoran->keterangan = $request->keterangan;
        $setoran->pendapatan_akhir = $request->pendapatan_akhir;
        $setoran->pendapatan_sistem = $request->pendapatan_sistem;
        $setoran->selisih_setoran = $request->selisih_setoran;
        $setoran->tanggal_transaksi = \Carbon\Carbon::parse($request->tanggal_transaksi);
        $setoran->nomor_hp = $request->nomor_hp;

        // Simpan perubahan
        $setoran->save();

        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'pengawas', 'petugas'])) {
            // Tentukan redirect berdasarkan role pengguna
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.setoran.index')->with('success', 'Setoran berhasil diperbarui!');
            } elseif (Auth::user()->role == 'pengawas') {
                return redirect()->route('pengawas.setoran.index')->with('success', 'Setoran berhasil diperbarui!');
            } elseif (Auth::user()->role == 'petugas') {
                return redirect()->route('petugas.setoran.index')->with('success', 'Setoran berhasil diperbarui!');
            }
        }

        // Jika role tidak dikenali atau pengguna tidak terautentikasi
        return redirect()->back()->with('error', 'Akses tidak diizinkan.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setoran $setoran)
    {
        $setoran->delete();

        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'pengawas', 'petugas'])) {
            // Tentukan redirect berdasarkan role pengguna
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.setoran.index')->with('success', 'Setoran berhasil dihapus.');
            } elseif (Auth::user()->role == 'pengawas') {
                return redirect()->route('pengawas.setoran.index')->with('success', 'Setoran berhasil dihapus.');
            } elseif (Auth::user()->role == 'petugas') {
                return redirect()->route('petugas.setoran.index')->with('success', 'Setoran berhasil dihapus.');
            }
        }

        // Jika role tidak dikenali atau pengguna tidak terautentikasi
        return redirect()->back()->with('error', 'Akses tidak diizinkan.');
    }
}
