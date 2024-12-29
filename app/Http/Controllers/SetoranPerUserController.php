<?php

namespace App\Http\Controllers;

use App\Models\Setoran;
use App\Models\Lokasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mpdf\Mpdf;

class SetoranPerUserController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'pengawas', 'petugas'])) {
            $query = Setoran::with(['user', 'lokasi']);

            // Apply filters
            if ($request->filled('id_user')) {
                $query->where('id_user', $request->id_user);
            }
            if ($request->filled('id_lokasi')) {
                $query->where('id_lokasi', $request->id_lokasi);
            }
            if ($request->filled('jenis_setoran')) {
                $query->where('jenis_setoran', $request->jenis_setoran);
            }
            if ($request->filled('shift')) {
                $query->where('shift', $request->shift);
            }
            if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
                $query->whereBetween('tanggal_transaksi', [$request->tanggal_awal, $request->tanggal_akhir]);
            }

            // Paginate filtered data
            $setorans = $query->paginate(10);

            $users = User::all();
            $lokasis = Lokasi::all();

            // Role-based view rendering
            switch (Auth::user()->role) {
                case 'admin':
                    return view('admin.laporan.setoranPerUser.index', compact('setorans', 'users', 'lokasis'));
                case 'pengawas':
                    return view('pengawas.laporan.setoranPerUser.index', compact('setorans', 'users', 'lokasis'));
                case 'petugas':
                    return view('petugas.laporan.setoranPerUser.index', compact('setorans', 'users', 'lokasis'));
            }
        }

        return redirect()->route('login')->withErrors(['role' => 'Unauthorized']);
    }

    public function create()
    {
        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'pengawas', 'petugas'])) {
            $users = User::all();
            $lokasis = Lokasi::all();

            switch (Auth::user()->role) {
                case 'admin':
                    return view('admin.laporan.setoranPerUser.create', compact('users', 'lokasis'));
                case 'pengawas':
                    return view('pengawas.laporan.setoranPerUser.create', compact('users', 'lokasis'));
                case 'petugas':
                    return view('petugas.laporan.setoranPerUser.create', compact('users', 'lokasis'));
            }
        }

        return redirect()->route('login')->withErrors(['role' => 'Unauthorized']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'id_lokasi' => 'required|exists:lokasi,id_lokasi',
            'jenis_setoran' => 'required|string',
            'shift' => 'required|string|max:50',
            'pendapatan_awal' => 'required|numeric',
            'pengeluaran' => 'required|numeric',
            'pendapatan_akhir' => 'required|numeric',
            'pendapatan_sistem' => 'required|numeric',
            'selisih_setoran' => 'required|numeric',
            'tanggal_transaksi' => 'required|date',
            'nomor_hp' => 'required|string|max:15',
        ]);

        Setoran::create($request->all());

        // Redirect based on user role
        return $this->redirectWithRole('Setoran berhasil ditambahkan.');
    }

    public function edit(Setoran $setoran)
    {
        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'pengawas', 'petugas'])) {
            $users = User::all();
            $lokasis = Lokasi::all();

            switch (Auth::user()->role) {
                case 'admin':
                    return view('admin.laporan.setoranPerUser.edit', compact('setoran', 'users', 'lokasis'));
                case 'pengawas':
                    return view('pengawas.laporan.setoranPerUser.edit', compact('setoran', 'users', 'lokasis'));
                case 'petugas':
                    return view('petugas.laporan.setoranPerUser.edit', compact('setoran', 'users', 'lokasis'));
            }
        }

        return redirect()->back()->with('error', 'Akses tidak diizinkan.');
    }

    public function update(Request $request, Setoran $setoran)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'id_lokasi' => 'required|exists:lokasi,id_lokasi',
            'jenis_setoran' => 'required|string',
            'shift' => 'required|string|max:50',
            'pendapatan_awal' => 'required|numeric',
            'pengeluaran' => 'required|numeric',
            'pendapatan_akhir' => 'required|numeric',
            'pendapatan_sistem' => 'required|numeric',
            'selisih_setoran' => 'required|numeric',
            'tanggal_transaksi' => 'required|date',
            'nomor_hp' => 'required|string|max:15',
        ]);

        $setoran->update($request->all());

        // Redirect based on user role
        return $this->redirectWithRole('Setoran berhasil diupdate.');
    }

    public function destroy(Setoran $setoran)
    {
        $setoran->delete();

        // Redirect based on user role
        return $this->redirectWithRole('Setoran berhasil dihapus.');
    }

    private function redirectWithRole($message)
    {
        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'pengawas', 'petugas'])) {
            switch (Auth::user()->role) {
                case 'admin':
                    return redirect()->route('admin.laporan.setoranPerUser.index')->with('success', $message);
                case 'pengawas':
                    return redirect()->route('pengawas.laporan.setoranPerUser.index')->with('success', $message);
                case 'petugas':
                    return redirect()->route('petugas.laporan.setoranPerUser.index')->with('success', $message);
            }
        }

        return redirect()->back()->with('error', 'Akses tidak diizinkan.');
    }

    public function cetakPdf(Request $request)
    {
        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'pengawas', 'petugas'])) {
            // Prepare query with filters
            $setorans = Setoran::with(['user', 'lokasi'])
                ->when($request->id_user, function ($query) use ($request) {
                    $query->where('id_user', $request->id_user);
                })
                ->when($request->id_lokasi, function ($query) use ($request) {
                    $query->where('id_lokasi', $request->id_lokasi);
                })
                ->when($request->jenis_setoran, function ($query) use ($request) {
                    $query->where('jenis_setoran', $request->jenis_setoran);
                })
                ->when($request->shift, function ($query) use ($request) {
                    $query->where('shift', $request->shift);
                })
                ->when($request->tanggal_awal && $request->tanggal_akhir, function ($query) use ($request) {
                    $query->whereBetween('tanggal_transaksi', [$request->tanggal_awal, $request->tanggal_akhir]);
                })
                ->get();

            // Ensure data is available
            if ($setorans->isEmpty()) {
                return redirect()->back()->with('error', 'Data setoran tidak ditemukan.');
            }

            // Generate PDF based on user role
            $pdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
            $html = '';

            switch (Auth::user()->role) {
                case 'admin':
                    $html = view('admin.laporan.setoranPerUser.pdf', compact('setorans'))->render();
                    break;
                case 'pengawas':
                    $html = view('pengawas.laporan.setoranPerUser.pdf', compact('setorans'))->render();
                    break;
                case 'petugas':
                    $html = view('petugas.laporan.setoranPerUser.pdf', compact('setorans'))->render();
                    break;
            }

            // Write HTML to PDF and return output
            $pdf->WriteHTML($html);
            return $pdf->Output('laporan_setoran_per_user.pdf', 'I');
        }

        return redirect()->back()->with('error', 'Akses tidak diizinkan.');
    }
}
