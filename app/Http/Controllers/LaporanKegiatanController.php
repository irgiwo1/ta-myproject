<?php

namespace App\Http\Controllers;

use App\Models\LaporanKegiatan;
use App\Models\Lokasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanKegiatanController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'pengawas', 'petugas'])) {
            $query = LaporanKegiatan::with(['user', 'lokasi']);

            // Filter berdasarkan user
            if ($request->filled('id_user')) {
                $query->where('id_user', $request->id_user);
            }

            // Filter berdasarkan lokasi
            if ($request->filled('id_lokasi')) {
                $query->where('id_lokasi', $request->id_lokasi);
            }

            // Filter berdasarkan tanggal awal dan akhir
            if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
                $query->whereBetween('tanggal_kegiatan', [$request->tanggal_awal, $request->tanggal_akhir]);
            }

            // Filter berdasarkan jenis kegiatan
            if ($request->filled('jenis_kegiatan')) {
                $query->where('jenis_kegiatan', $request->jenis_kegiatan);
            }

            // Ambil data laporan yang sudah difilter
            $laporanKegiatans = $query->paginate(10);

            $users = User::all();
            $lokasis = Lokasi::all();

            if (Auth::user()->role == 'admin') {
                return view('admin.laporan.kegiatan.index', compact('laporanKegiatans', 'users', 'lokasis'));
            } elseif (Auth::user()->role == 'pengawas') {
                return view('pengawas.laporan.kegiatan.index', compact('laporanKegiatans', 'users', 'lokasis'));
            } elseif (Auth::user()->role == 'petugas') {
                return view('petugas.laporan.kegiatan.index', compact('laporanKegiatans', 'users', 'lokasis'));
            }
        }

        return redirect()->route('login')->withErrors(['role' => 'Unauthorized']);
    }

    public function create()
    {
        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'pengawas', 'petugas'])) {
            $users = User::all();
            $lokasis = Lokasi::all();

            if (Auth::user()->role == 'admin') {
                return view('admin.laporan.kegiatan.create', compact('users', 'lokasis'));
            } elseif (Auth::user()->role == 'pengawas') {
                return view('pengawas.laporan.kegiatan.create', compact('users', 'lokasis'));
            } elseif (Auth::user()->role == 'petugas') {
                return view('petugas.laporan.kegiatan.create', compact('users', 'lokasis'));
            }
        }

        return redirect()->route('login')->withErrors(['role' => 'Unauthorized']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'id_lokasi' => 'required|exists:lokasi,id_lokasi',
            'tanggal_kegiatan' => 'required|date',
            'jenis_kegiatan' => 'required|in:Harian,Mingguan,Bulanan',
            'deskripsi' => 'required|string|max:255',
        ]);

        LaporanKegiatan::create($request->all());

        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'pengawas', 'petugas'])) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.laporan.kegiatan.index')->with('success', 'Laporan Kegiatan berhasil ditambahkan.');
            } elseif (Auth::user()->role == 'pengawas') {
                return redirect()->route('pengawas.laporan.kegiatan.index')->with('success', 'Laporan Kegiatan berhasil ditambahkan.');
            } elseif (Auth::user()->role == 'petugas') {
                return redirect()->route('petugas.laporan.kegiatan.index')->with('success', 'Laporan Kegiatan berhasil ditambahkan.');
            }
        }

        return redirect()->back()->with('error', 'Akses tidak diizinkan.');
    }

    public function edit(LaporanKegiatan $laporanKegiatan)
    {
        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'pengawas', 'petugas'])) {
            $users = User::all();
            $lokasis = Lokasi::all();

            if (Auth::user()->role == 'admin') {
                return view('admin.laporan.kegiatan.edit', compact('laporanKegiatan', 'users', 'lokasis'));
            } elseif (Auth::user()->role == 'pengawas') {
                return view('pengawas.laporan.kegiatan.edit', compact('laporanKegiatan', 'users', 'lokasis'));
            } elseif (Auth::user()->role == 'petugas') {
                return view('petugas.laporan.kegiatan.edit', compact('laporanKegiatan', 'users', 'lokasis'));
            }
        }

        return redirect()->back()->with('error', 'Akses tidak diizinkan.');
    }

    public function update(Request $request, LaporanKegiatan $laporanKegiatan)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'id_lokasi' => 'required|exists:lokasi,id_lokasi',
            'tanggal_kegiatan' => 'required|date',
            'jenis_kegiatan' => 'required|in:Harian,Mingguan,Bulanan',
            'deskripsi' => 'required|string|max:255',
        ]);

        $laporanKegiatan->update($request->all());

        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'pengawas', 'petugas'])) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.laporan.kegiatan.index')->with('success', 'Laporan Kegiatan berhasil diupdate.');
            } elseif (Auth::user()->role == 'pengawas') {
                return redirect()->route('pengawas.laporan.kegiatan.index')->with('success', 'Laporan Kegiatan berhasil diupdate.');
            } elseif (Auth::user()->role == 'petugas') {
                return redirect()->route('petugas.laporan.kegiatan.index')->with('success', 'Laporan Kegiatan berhasil diupdate.');
            }
        }

        return redirect()->back()->with('error', 'Akses tidak diizinkan.');
    }

    public function destroy(LaporanKegiatan $laporanKegiatan)
    {
        $laporanKegiatan->delete();

        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'pengawas', 'petugas'])) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.laporan.kegiatan.index')->with('success', 'Laporan Kegiatan berhasil dihapus.');
            } elseif (Auth::user()->role == 'pengawas') {
                return redirect()->route('pengawas.laporan.kegiatan.index')->with('success', 'Laporan Kegiatan berhasil dihapus.');
            } elseif (Auth::user()->role == 'petugas') {
                return redirect()->route('petugas.laporan.kegiatan.index')->with('success', 'Laporan Kegiatan berhasil dihapus.');
            }
        }

        return redirect()->back()->with('error', 'Akses tidak diizinkan.');
    }

    public function cetakPDF(Request $request)
    {
        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'pengawas', 'petugas'])) {
            // Ambil data LaporanKegiatan dengan relasi user dan lokasi
            $laporanKegiatans = LaporanKegiatan::with(['user', 'lokasi']);

            // Filter berdasarkan id_user
            if ($request->has('id_user') && $request->id_user) {
                $laporanKegiatans->where('id_user', $request->id_user);
            }

            // Filter berdasarkan id_lokasi
            if ($request->has('id_lokasi') && $request->id_lokasi) {
                $laporanKegiatans->where('id_lokasi', $request->id_lokasi);
            }

            // Filter berdasarkan tanggal awal dan akhir
            if ($request->has('tanggal_awal') && $request->has('tanggal_akhir') && $request->tanggal_awal && $request->tanggal_akhir) {
                $laporanKegiatans->whereBetween('tanggal_kegiatan', [$request->tanggal_awal, $request->tanggal_akhir]);
            }

            // Filter berdasarkan jenis_kegiatan
            if ($request->has('jenis_kegiatan') && $request->jenis_kegiatan) {
                $laporanKegiatans->where('jenis_kegiatan', $request->jenis_kegiatan);
            }

            // Ambil hasil query
            $laporanKegiatans = $laporanKegiatans->get();

            // Inisialisasi PDF
            $pdf = new \Mpdf\Mpdf();
            $html = '';

            // Sesuaikan tampilan PDF berdasarkan peran pengguna
            switch (Auth::user()->role) {
                case 'admin':
                    $html = view('admin.laporan.kegiatan.pdf', compact('laporanKegiatans'))->render();
                    break;
                case 'pengawas':
                    $html = view('pengawas.laporan.kegiatan.pdf', compact('laporanKegiatans'))->render();
                    break;
                case 'petugas':
                    $html = view('petugas.laporan.kegiatan.pdf', compact('laporanKegiatans'))->render();
                    break;
            }

            // Tulis HTML ke dalam PDF dan keluarkan PDF
            $pdf->WriteHTML($html);
            return $pdf->Output('laporan_kegiatan.pdf', 'I');
        }

        // Jika tidak memiliki akses
        return redirect()->back()->with('error', 'Akses tidak diizinkan.');
    }
}
