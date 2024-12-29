<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\KegiatanBulananController;
use App\Http\Controllers\KegiatanHarianController;
use App\Http\Controllers\KegiatanMingguanController;
use App\Http\Controllers\LaporanKegiatanController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\PengawasController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\SetoranController;
use App\Http\Controllers\SetoranPerUserController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticate;

// Halaman Welcome
Route::get('/', function () {
    return view('welcome');
});

// Admin routes
Route::group(['middleware' => Authenticate::class], function () {

    // Admin routes with role check
    Route::group(['middleware' => function ($request, $next) {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }
        return redirect()->route('login')->withErrors(['role' => 'Unauthorized']);
    }], function () {

        // Dashboard Admin
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

        // Admin dashboard tambahan jika diperlukan
        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard');
        });

        // Admin masterData lokasi
        Route::prefix('admin/master/lokasi')->name('admin.master.lokasi.')->group(function () {
            Route::get('/', [LokasiController::class, 'index'])->name('index');
            Route::get('/create', [LokasiController::class, 'create'])->name('create');
            Route::post('/', [LokasiController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [LokasiController::class, 'edit'])->name('edit');
            Route::put('/{id}', [LokasiController::class, 'update'])->name('update');
            Route::delete('/{id}', [LokasiController::class, 'destroy'])->name('destroy');
        });

        // Admin masterData jkendaraan
        Route::get('/admin/master/jenisKendaraan', function () {
            return view('admin.master.jenisKendaraan');
        });

        // Admin masterData tipe
        Route::get('/admin/master/tipe', function () {
            return view('admin.master.tipe');
        });

        // Setoran Admin
        Route::prefix('admin/setoran')->name('admin.setoran.')->group(function () {
            Route::get('/', [SetoranController::class, 'index'])->name('index');
            Route::get('/create', [SetoranController::class, 'create'])->name('create');
            Route::post('/', [SetoranController::class, 'store'])->name('store');
            Route::get('/{setoran}/edit', [SetoranController::class, 'edit'])->name('edit');
            Route::put('/{setoran}', [SetoranController::class, 'update'])->name('update');
            Route::delete('/{setoran}', [SetoranController::class, 'destroy'])->name('destroy');
        });

        // Admin Laporan kegiatan
        Route::prefix('admin/laporan/kegiatan')->name('admin.laporan.kegiatan.')->group(function () {
            Route::get('/', [LaporanKegiatanController::class, 'index'])->name('index');
            Route::get('/create', [LaporanKegiatanController::class, 'create'])->name('create');
            Route::post('/', [LaporanKegiatanController::class, 'store'])->name('store');
            Route::get('/{kegiatan}/edit', [LaporanKegiatanController::class, 'edit'])->name('edit');
            Route::put('/{kegiatan}', [LaporanKegiatanController::class, 'update'])->name('update');
            Route::delete('/{kegiatan}', [LaporanKegiatanController::class, 'destroy'])->name('destroy');

            // Route untuk cetak PDF
            Route::get('/cetak', [LaporanKegiatanController::class, 'cetakPDF'])->name('cetak');
        });


        // Admin Laporan SetoranPerUser
        Route::prefix('admin/laporan/setoranPerUser')->name('admin.laporan.setoranPerUser.')->group(function () {
            Route::get('/', [SetoranPerUserController::class, 'index'])->name('index');
            Route::get('/create', [SetoranPerUserController::class, 'create'])->name('create');
            Route::post('/', [SetoranPerUserController::class, 'store'])->name('store');
            Route::get('/{setoran}/edit', [SetoranPerUserController::class, 'edit'])->name('edit');
            Route::put('/{setoran}', [SetoranPerUserController::class, 'update'])->name('update');
            Route::delete('/{setoran}', [SetoranPerUserController::class, 'destroy'])->name('destroy');

            // Route untuk cetak PDF
            Route::get('/cetak-pdf', [SetoranPerUserController::class, 'cetakPdf'])->name('cetak-pdf');
        });


        // Admin Kegiatan Harian 
        Route::prefix('admin/kegiatan/harian')->name('admin.kegiatan.harian.')->group(function () {
            Route::get('/', [KegiatanHarianController::class, 'index'])->name('index');
            Route::get('/create', [KegiatanHarianController::class, 'create'])->name('create');
            Route::post('/', [KegiatanHarianController::class, 'store'])->name('store');
            Route::get('/{kegiatanHarian}/edit', [KegiatanHarianController::class, 'edit'])->name('edit');
            Route::put('/{kegiatanHarian}', [KegiatanHarianController::class, 'update'])->name('update');
            Route::delete('/{kegiatanHarian}', [KegiatanHarianController::class, 'destroy'])->name('destroy');
        });

        // Admin Kegiatan Mingguan
        Route::prefix('admin/kegiatan/mingguan')->name('admin.kegiatan.mingguan.')->group(function () {
            Route::get('/', [KegiatanMingguanController::class, 'index'])->name('index');
            Route::get('/create', [KegiatanMingguanController::class, 'create'])->name('create');
            Route::post('/', [KegiatanMingguanController::class, 'store'])->name('store');
            Route::get('/{kegiatanMingguan}/edit', [KegiatanMingguanController::class, 'edit'])->name('edit');
            Route::put('/{kegiatanMingguan}', [KegiatanMingguanController::class, 'update'])->name('update');
            Route::delete('/{kegiatanMingguan}', [KegiatanMingguanController::class, 'destroy'])->name('destroy');
        });

        // Admin Kegiatan Bulanan
        Route::prefix('admin/kegiatan/bulanan')->name('admin.kegiatan.bulanan.')->group(function () {
            Route::get('/', [KegiatanBulananController::class, 'index'])->name('index');
            Route::get('/create', [KegiatanBulananController::class, 'create'])->name('create');
            Route::post('/', [KegiatanBulananController::class, 'store'])->name('store');
            Route::get('/{kegiatanBulanan}/edit', [KegiatanBulananController::class, 'edit'])->name('edit');
            Route::put('/{kegiatanBulanan}', [KegiatanBulananController::class, 'update'])->name('update');
            Route::delete('/{kegiatanBulanan}', [KegiatanBulananController::class, 'destroy'])->name('destroy');
        });

        // UserManagemen
        Route::prefix('admin/userManagemen')->name('admin.users.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/create', [UserController::class, 'create'])->name('create');
            Route::post('/', [UserController::class, 'store'])->name('store');
            Route::get('/{id_user}/edit', [UserController::class, 'edit'])->name('edit');
            Route::put('/{id_user}', [UserController::class, 'update'])->name('update');
            Route::delete('/{id_user}', [UserController::class, 'destroy'])->name('destroy');
        });
    });
});



// Pengawas routes
Route::group(['middleware' => Authenticate::class], function () {

    Route::group(['middleware' => function ($request, $next) {
        if (Auth::check() && Auth::user()->role === 'pengawas') {
            return $next($request);
        }
        return redirect()->route('login')->withErrors(['role' => 'Unauthorized']);
    }], function () {
        Route::get('/pengawas', [PengawasController::class, 'index'])->name('pengawas.dashboard');

        // Pengawas dashboard tambahan jika diperlukan
        Route::get('/pengawas/dashboard', function () {
            return view('pengawas.dashboard');
        });
        // Pengawas masterData lokasi
        Route::prefix('pengawas/master/lokasi')->name('pengawas.master.lokasi.')->group(function () {
            Route::get('/', [LokasiController::class, 'index'])->name('index');
        });
        // Pengawas masterData jkendaraan
        Route::get('/pengawas/master/jenisKendaraan', function () {
            return view('pengawas.master.jenisKendaraan');
        });
        // Pengawas masterData tipe
        Route::get('/pengawas/master/tipe', function () {
            return view('pengawas.master.tipe');
        });
        // Setoran Pengawas
        Route::prefix('pengawas/setoran')->name('pengawas.setoran.')->group(function () {
            Route::get('/', [SetoranController::class, 'index'])->name('index');
        });
        // Pengawas Laporan kegiatan
        Route::prefix('pengawas/laporan/kegiatan')->name('pengawas.laporan.kegiatan.')->group(function () {
            Route::get('/', [LaporanKegiatanController::class, 'index'])->name('index');
            Route::get('/create', [LaporanKegiatanController::class, 'create'])->name('create');
            Route::post('/', [LaporanKegiatanController::class, 'store'])->name('store');
            Route::get('/{kegiatan}/edit', [LaporanKegiatanController::class, 'edit'])->name('edit');
            Route::put('/{kegiatan}', [LaporanKegiatanController::class, 'update'])->name('update');
            Route::delete('/{kegiatan}', [LaporanKegiatanController::class, 'destroy'])->name('destroy');

            // Route untuk cetak PDF
            Route::get('/cetak', [LaporanKegiatanController::class, 'cetakPDF'])->name('cetak');
        });

        // Pengawas Laporan SetoranPerUser
        Route::prefix('pengawas/laporan/setoranPerUser')->name('pengawas.laporan.setoranPerUser.')->group(function () {
            Route::get('/', [SetoranPerUserController::class, 'index'])->name('index');
            Route::get('/create', [SetoranPerUserController::class, 'create'])->name('create');
            Route::post('/', [SetoranPerUserController::class, 'store'])->name('store');
            Route::get('/{setoran}/edit', [SetoranPerUserController::class, 'edit'])->name('edit');
            Route::put('/{setoran}', [SetoranPerUserController::class, 'update'])->name('update');
            Route::delete('/{setoran}', [SetoranPerUserController::class, 'destroy'])->name('destroy');

            // Route untuk cetak PDF
            Route::get('/cetak-pdf', [SetoranPerUserController::class, 'cetakPdf'])->name('cetak-pdf');
        });

        // Pengawas Kegiatan Harian 
        Route::prefix('pengawas/kegiatan/harian')->name('pengawas.kegiatan.harian.')->group(function () {
            Route::get('/', [KegiatanHarianController::class, 'index'])->name('index');
            Route::get('/create', [KegiatanHarianController::class, 'create'])->name('create');
            Route::post('/', [KegiatanHarianController::class, 'store'])->name('store');
            Route::get('/{kegiatanHarian}/edit', [KegiatanHarianController::class, 'edit'])->name('edit');
            Route::put('/{kegiatanHarian}', [KegiatanHarianController::class, 'update'])->name('update');
            Route::delete('/{kegiatanHarian}', [KegiatanHarianController::class, 'destroy'])->name('destroy');
        });
        // Pengawas Kegiatan Mingguan
        Route::prefix('pengawas/kegiatan/mingguan')->name('pengawas.kegiatan.mingguan.')->group(function () {
            Route::get('/', [KegiatanMingguanController::class, 'index'])->name('index');
            Route::get('/create', [KegiatanMingguanController::class, 'create'])->name('create');
            Route::post('/', [KegiatanMingguanController::class, 'store'])->name('store');
            Route::get('/{kegiatanMingguan}/edit', [KegiatanMingguanController::class, 'edit'])->name('edit');
            Route::put('/{kegiatanMingguan}', [KegiatanMingguanController::class, 'update'])->name('update');
            Route::delete('/{kegiatanMingguan}', [KegiatanMingguanController::class, 'destroy'])->name('destroy');
        });
        // Pengawas Kegiatan Bulanan
        Route::prefix('pengawas/kegiatan/bulanan')->name('pengawas.kegiatan.bulanan.')->group(function () {
            Route::get('/', [KegiatanBulananController::class, 'index'])->name('index');
            Route::get('/create', [KegiatanBulananController::class, 'create'])->name('create');
            Route::post('/', [KegiatanBulananController::class, 'store'])->name('store');
            Route::get('/{kegiatanBulanan}/edit', [KegiatanBulananController::class, 'edit'])->name('edit');
            Route::put('/{kegiatanBulanan}', [KegiatanBulananController::class, 'update'])->name('update');
            Route::delete('/{kegiatanBulanan}', [KegiatanBulananController::class, 'destroy'])->name('destroy');
        });
        // UserManagemen
        Route::prefix('pengawas/userManagemen')->name('pengawas.users.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
        });
    });
});

// Petugas routes
Route::group(['middleware' => Authenticate::class], function () {

    Route::group(['middleware' => function ($request, $next) {
        if (Auth::check() && Auth::user()->role === 'petugas') {
            return $next($request);
        }
        return redirect()->route('login')->withErrors(['role' => 'Unauthorized']);
    }], function () {
        Route::get('/petugas', [PetugasController::class, 'index'])->name('petugas.dashboard');

        // Pengawas dashboard tambahan jika diperlukan
        Route::get('/petugas/dashboard', function () {
            return view('petugas.dashboard');
        });
        // Pengawas masterData lokasi
        Route::prefix('petugas/master/lokasi')->name('petugas.master.lokasi.')->group(function () {
            Route::get('/', [LokasiController::class, 'index'])->name('index');
        });

        // Pengawas masterData jkendaraan
        Route::get('/petugas/master/jenisKendaraan', function () {
            return view('petugas.master.jenisKendaraan');
        });
        // Pengawas masterData tipe
        Route::get('/petugas/master/tipe', function () {
            return view('petugas.master.tipe');
        });
        // Setoran Pengawas
        Route::prefix('petugas/setoran')->name('petugas.setoran.')->group(function () {
            Route::get('/', [SetoranController::class, 'index'])->name('index');
            Route::get('/create', [SetoranController::class, 'create'])->name('create');
            Route::post('/', [SetoranController::class, 'store'])->name('store');
            Route::put('/{setoran}', [SetoranController::class, 'update'])->name('update');
            Route::delete('/{setoran}', [SetoranController::class, 'destroy'])->name('destroy');
        });
        // Pengawas Laporan kegiatan
        Route::prefix('petugas/laporan/kegiatan')->name('petugas.laporan.kegiatan.')->group(function () {
            Route::get('/', [LaporanKegiatanController::class, 'index'])->name('index');
            Route::get('/create', [LaporanKegiatanController::class, 'create'])->name('create');
            Route::post('/', [LaporanKegiatanController::class, 'store'])->name('store');
            Route::get('/{kegiatan}/edit', [LaporanKegiatanController::class, 'edit'])->name('edit');
            Route::put('/{kegiatan}', [LaporanKegiatanController::class, 'update'])->name('update');
            Route::delete('/{kegiatan}', [LaporanKegiatanController::class, 'destroy'])->name('destroy');

            // Route untuk cetak PDF
            Route::get('/cetak', [LaporanKegiatanController::class, 'cetakPDF'])->name('cetak');
        });

        // Pengawas Laporan SetoranPerUser
        Route::prefix('petugas/laporan/setoranPerUser')->name('petugas.laporan.setoranPerUser.')->group(function () {
            Route::get('/', [SetoranPerUserController::class, 'index'])->name('index');
            Route::get('/create', [SetoranPerUserController::class, 'create'])->name('create');
            Route::post('/', [SetoranPerUserController::class, 'store'])->name('store');
            Route::get('/{setoran}/edit', [SetoranPerUserController::class, 'edit'])->name('edit');
            Route::put('/{setoran}', [SetoranPerUserController::class, 'update'])->name('update');
            Route::delete('/{setoran}', [SetoranPerUserController::class, 'destroy'])->name('destroy');

            // Route untuk cetak PDF
            Route::get('/cetak-pdf', [SetoranPerUserController::class, 'cetakPdf'])->name('cetak-pdf');
        });

        // Pengawas Kegiatan Harian 
        Route::prefix('petugas/kegiatan/harian')->name('petugas.kegiatan.harian.')->group(function () {
            Route::get('/', [KegiatanHarianController::class, 'index'])->name('index');
            Route::get('/create', [KegiatanHarianController::class, 'create'])->name('create');
            Route::post('/', [KegiatanHarianController::class, 'store'])->name('store');
            Route::get('/{kegiatanHarian}/edit', [KegiatanHarianController::class, 'edit'])->name('edit');
            Route::put('/{kegiatanHarian}', [KegiatanHarianController::class, 'update'])->name('update');
            Route::delete('/{kegiatanHarian}', [KegiatanHarianController::class, 'destroy'])->name('destroy');
        });
        // Pengawas Kegiatan Mingguan
        Route::prefix('petugas/kegiatan/mingguan')->name('petugas.kegiatan.mingguan.')->group(function () {
            Route::get('/', [KegiatanMingguanController::class, 'index'])->name('index');
            Route::get('/create', [KegiatanMingguanController::class, 'create'])->name('create');
            Route::post('/', [KegiatanMingguanController::class, 'store'])->name('store');
            Route::get('/{kegiatanMingguan}/edit', [KegiatanMingguanController::class, 'edit'])->name('edit');
            Route::put('/{kegiatanMingguan}', [KegiatanMingguanController::class, 'update'])->name('update');
            Route::delete('/{kegiatanMingguan}', [KegiatanMingguanController::class, 'destroy'])->name('destroy');
        });
        // Pengawas Kegiatan Bulanan
        Route::prefix('petugas/kegiatan/bulanan')->name('petugas.kegiatan.bulanan.')->group(function () {
            Route::get('/', [KegiatanBulananController::class, 'index'])->name('index');
            Route::get('/create', [KegiatanBulananController::class, 'create'])->name('create');
            Route::post('/', [KegiatanBulananController::class, 'store'])->name('store');
            Route::get('/{kegiatanBulanan}/edit', [KegiatanBulananController::class, 'edit'])->name('edit');
            Route::put('/{kegiatanBulanan}', [KegiatanBulananController::class, 'update'])->name('update');
            Route::delete('/{kegiatanBulanan}', [KegiatanBulananController::class, 'destroy'])->name('destroy');
        });
        // UserManagemen
        Route::prefix('petugas/userManagemen')->name('petugas.users.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
        });
    });
});

// Halaman Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Halaman Register
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Proses Login
Route::post('/login', function () {
    $credentials = request()->only('email', 'password');
    if (Auth::attempt($credentials)) {
        // Cek role pengguna dan redirect ke halaman yang sesuai
        $role = Auth::user()->role;
        switch ($role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'pengawas':
                return redirect()->route('pengawas.dashboard');
            case 'petugas':
                return redirect()->route('petugas.dashboard');
            default:
                return redirect()->route('login')->withErrors(['role' => 'Role tidak valid.']);
        }
    }

    return back()->withErrors(['email' => 'Email atau password salah.']);
})->name('login');

// Proses Register
Route::post('/register', function () {
    $data = request()->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'required|in:admin,pengawas,petugas',
    ]);

    // Enkripsi password
    $data['password'] = bcrypt($data['password']);

    // Simpan user baru ke database
    \App\Models\User::create($data);

    // Redirect ke halaman login setelah registrasi
    return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
})->name('register');

// Route Logout
Route::post('/logout', function () {
    // Hapus session pengguna
    Auth::logout();
    session()->flush();

    // Redirect ke halaman login setelah logout
    return redirect()->route('login');
})->name('logout');

//Route Lokasi Admmin
// Route::resource('admin/master/lokasi', LokasiController::class);
// Route::get('admin/master/lokasi/create', [LokasiController::class, 'create'])->name('lokasi.create');
// Route::post('admin/master/lokasi', [LokasiController::class, 'store'])->name('lokasi.store');
// Route::get('admin/master/lokasi/{id}/edit', [LokasiController::class, 'edit'])->name('lokasi.edit');
// Route::put('admin/master/lokasi/{id}', [LokasiController::class, 'update'])->name('lokasi.update');
// Route::delete('admin/master/lokasi/{id}', [LokasiController::class, 'destroy'])->name('lokasi.destroy');

// Route::resource('pengawas/master/lokasi', LokasiController::class);

// Route::resource('petugas/master/lokasi', LokasiController::class);

//User controler
// Admin routes
// Route::prefix('admin')->group(function () {
//     Route::get('userManagemen', [UserController::class, 'index'])->name('admin.users.index');
//     Route::get('userManagemen/create', [UserController::class, 'create'])->name('admin.users.create');
//     Route::post('userManagemen', [UserController::class, 'store'])->name('admin.users.store');
//     Route::get('userManagemen/{id_user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
//     Route::put('userManagemen/{id_user}', [UserController::class, 'update'])->name('admin.users.update');
//     Route::delete('userManagemen/{id_user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
// });

// Pengawas routes
// Route::prefix('pengawas')->group(function () {
//     Route::get('userManagemen', [UserController::class, 'index'])->name('pengawas.users.index');
// });

// // Petugas routes
// Route::prefix('petugas')->group(function () {
//     Route::get('userManagemen', [UserController::class, 'index'])->name('petugas.users.index');
// });

//User setoran
//admin
// Route::resource('admin/setoran', SetoranController::class);
// Route::get('admin/setoran/create', [SetoranController::class, 'create'])->name('setoran.create');
// Route::post('/setoran', [SetoranController::class, 'store'])->name('setoran.store');
// Route::get('admin/setoran/{setoran}/edit', [SetoranController::class, 'edit'])->name('setoran.edit');
// Route::put('/setoran/{setoran}', [SetoranController::class, 'update'])->name('setoran.update');
// Route::delete('/setoran/{setoran}', [SetoranController::class, 'destroy'])->name('setoran.destroy');

// //pengawas
// Route::resource('pengawas/setoran', SetoranController::class);

// //petugas
// Route::resource('petugas/setoran', SetoranController::class);
// Route::get('petugas/setoran/create', [SetoranController::class, 'create'])->name('setoran.create');
// Route::post('/setoran', [SetoranController::class, 'store'])->name('setoran.store');
// Route::delete('/setoran/{setoran}', [SetoranController::class, 'destroy'])->name('setoran.destroy');

// //laporan kegiatan
// Route::prefix('admin/laporan')->group(function () {
//     Route::get('kegiatan', [LaporanKegiatanController::class, 'index'])->name('laporan_kegiatan.index');
//     Route::get('kegiatan/create', [LaporanKegiatanController::class, 'create'])->name('laporan_kegiatan.create');
//     Route::post('kegiatan', [LaporanKegiatanController::class, 'store'])->name('laporan_kegiatan.store');
//     Route::get('kegiatan/{id}/edit', [LaporanKegiatanController::class, 'edit'])->name('laporan_kegiatan.edit');
//     Route::put('kegiatan/{id}', [LaporanKegiatanController::class, 'update'])->name('laporan_kegiatan.update');
//     Route::delete('kegiatan/{id}', [LaporanKegiatanController::class, 'destroy'])->name('laporan_kegiatan.destroy');

//     // Route untuk cetak PDF
//     Route::get('kegiatan/cetak', [LaporanKegiatanController::class, 'cetakPDF'])->name('laporan_kegiatan.cetak');
// });

// Route::prefix('pengawas/laporan')->group(function () {
//     Route::get('kegiatan', [LaporanKegiatanController::class, 'index'])->name('laporan_kegiatan.index');
//     Route::get('kegiatan/create', [LaporanKegiatanController::class, 'create'])->name('laporan_kegiatan.create');
//     Route::post('kegiatan', [LaporanKegiatanController::class, 'store'])->name('laporan_kegiatan.store');
//     Route::get('kegiatan/{id}/edit', [LaporanKegiatanController::class, 'edit'])->name('laporan_kegiatan.edit');
//     Route::put('kegiatan/{id}', [LaporanKegiatanController::class, 'update'])->name('laporan_kegiatan.update');
//     Route::delete('kegiatan/{id}', [LaporanKegiatanController::class, 'destroy'])->name('laporan_kegiatan.destroy');

//     // Route untuk cetak PDF
//     Route::get('kegiatan/cetak', [LaporanKegiatanController::class, 'cetakPDF'])->name('laporan_kegiatan.cetak');
// });

// Route::prefix('petugas/laporan')->group(function () {
//     Route::get('kegiatan', [LaporanKegiatanController::class, 'index'])->name('laporan_kegiatan.index');
//     Route::get('kegiatan/create', [LaporanKegiatanController::class, 'create'])->name('laporan_kegiatan.create');
//     Route::post('kegiatan', [LaporanKegiatanController::class, 'store'])->name('laporan_kegiatan.store');
//     Route::get('kegiatan/{id}/edit', [LaporanKegiatanController::class, 'edit'])->name('laporan_kegiatan.edit');
//     Route::put('kegiatan/{id}', [LaporanKegiatanController::class, 'update'])->name('laporan_kegiatan.update');
//     Route::delete('kegiatan/{id}', [LaporanKegiatanController::class, 'destroy'])->name('laporan_kegiatan.destroy');

//     // Route untuk cetak PDF
//     Route::get('kegiatan/cetak', [LaporanKegiatanController::class, 'cetakPDF'])->name('laporan_kegiatan.cetak');
// });

//laporan setoran peruser
// Route::prefix('admin/laporan')->group(function () {
//     Route::get('setoranPerUser', [SetoranPerUserController::class, 'index'])->name('setoranPerUser.index');
//     Route::get('setoranPerUser/create', [SetoranPerUserController::class, 'create'])->name('setoranPerUser.create');
//     Route::post('setoranPerUser', [SetoranPerUserController::class, 'store'])->name('setoranPerUser.store');
//     Route::get('setoranPerUser/{setoran}/edit', [SetoranPerUserController::class, 'edit'])->name('setoranPerUser.edit');
//     Route::put('setoranPerUser/{setoran}', [SetoranPerUserController::class, 'update'])->name('setoranPerUser.update');
//     Route::delete('setoranPerUser/{setoran}', [SetoranPerUserController::class, 'destroy'])->name('setoranPerUser.destroy');

//     // Tambahkan rute untuk perUser
//     Route::get('setoranPerUser/per-user', [SetoranPerUserController::class, 'perUser'])->name('setoran.per-user');
//     Route::get('admin/laporan/setoranPerUser/cetak-pdf', [SetoranPerUserController::class, 'cetakPdf'])->name('setoran.cetak-pdf');
// });

// Route::prefix('pengawas/laporan')->group(function () {
//     Route::get('setoranPerUser', [SetoranPerUserController::class, 'index'])->name('setoranPerUser.index');
//     Route::get('setoranPerUser/create', [SetoranPerUserController::class, 'create'])->name('setoranPerUser.create');
//     Route::post('setoranPerUser', [SetoranPerUserController::class, 'store'])->name('setoranPerUser.store');
//     Route::get('setoranPerUser/{setoran}/edit', [SetoranPerUserController::class, 'edit'])->name('setoranPerUser.edit');
//     Route::put('setoranPerUser/{setoran}', [SetoranPerUserController::class, 'update'])->name('setoranPerUser.update');
//     Route::delete('setoranPerUser/{setoran}', [SetoranPerUserController::class, 'destroy'])->name('setoranPerUser.destroy');

//     // Tambahkan rute untuk perUser
//     Route::get('setoranPerUser/per-user', [SetoranPerUserController::class, 'perUser'])->name('setoran.per-user');
//     Route::get('admin/laporan/setoranPerUser/cetak-pdf', [SetoranPerUserController::class, 'cetakPdf'])->name('setoran.cetak-pdf');
// });

// Route::prefix('petugas/laporan')->group(function () {
//     Route::get('setoranPerUser', [SetoranPerUserController::class, 'index'])->name('setoranPerUser.index');
//     Route::get('setoranPerUser/create', [SetoranPerUserController::class, 'create'])->name('setoranPerUser.create');
//     Route::post('setoranPerUser', [SetoranPerUserController::class, 'store'])->name('setoranPerUser.store');
//     Route::get('setoranPerUser/{setoran}/edit', [SetoranPerUserController::class, 'edit'])->name('setoranPerUser.edit');
//     Route::put('setoranPerUser/{setoran}', [SetoranPerUserController::class, 'update'])->name('setoranPerUser.update');
//     Route::delete('setoranPerUser/{setoran}', [SetoranPerUserController::class, 'destroy'])->name('setoranPerUser.destroy');

//     // Tambahkan rute untuk perUser
//     Route::get('setoranPerUser/per-user', [SetoranPerUserController::class, 'perUser'])->name('setoran.per-user');
//     Route::get('admin/laporan/setoranPerUser/cetak-pdf', [SetoranPerUserController::class, 'cetakPdf'])->name('setoran.cetak-pdf');
// });


// //kegiatan harian
// Route::prefix('admin/kegiatan')->group(function () {
//     Route::get('harian', [KegiatanHarianController::class, 'index'])->name('kegiatan_harian.index');
//     Route::get('harian/create', [KegiatanHarianController::class, 'create'])->name('kegiatan_harian.create');
//     Route::post('harian', [KegiatanHarianController::class, 'store'])->name('kegiatan_harian.store');
//     Route::get('harian/{kegiatanHarian}/edit', [KegiatanHarianController::class, 'edit'])->name('kegiatan_harian.edit');
//     Route::put('harian/{kegiatanHarian}', [KegiatanHarianController::class, 'update'])->name('kegiatan_harian.update');
//     Route::delete('harian/{kegiatanHarian}', [KegiatanHarianController::class, 'destroy'])->name('kegiatan_harian.destroy');
// });

// Route::prefix('pengawas/kegiatan')->group(function () {
//     Route::get('harian', [KegiatanHarianController::class, 'index'])->name('kegiatan_harian.index');
//     Route::get('harian/create', [KegiatanHarianController::class, 'create'])->name('kegiatan_harian.create');
//     Route::post('harian', [KegiatanHarianController::class, 'store'])->name('kegiatan_harian.store');
//     Route::get('harian/{kegiatanHarian}/edit', [KegiatanHarianController::class, 'edit'])->name('kegiatan_harian.edit');
//     Route::put('harian/{kegiatanHarian}', [KegiatanHarianController::class, 'update'])->name('kegiatan_harian.update');
//     Route::delete('harian/{kegiatanHarian}', [KegiatanHarianController::class, 'destroy'])->name('kegiatan_harian.destroy');
// });

// Route::prefix('petugas/kegiatan')->group(function () {
//     Route::get('harian', [KegiatanHarianController::class, 'index'])->name('kegiatan_harian.index');
//     Route::get('harian/create', [KegiatanHarianController::class, 'create'])->name('kegiatan_harian.create');
//     Route::post('harian', [KegiatanHarianController::class, 'store'])->name('kegiatan_harian.store');
//     Route::get('harian/{kegiatanHarian}/edit', [KegiatanHarianController::class, 'edit'])->name('kegiatan_harian.edit');
//     Route::put('harian/{kegiatanHarian}', [KegiatanHarianController::class, 'update'])->name('kegiatan_harian.update');
//     Route::delete('harian/{kegiatanHarian}', [KegiatanHarianController::class, 'destroy'])->name('kegiatan_harian.destroy');
// });

//kegiatan mingguan
// Route::prefix('admin/kegiatan')->group(function () {
//     Route::get('mingguan', [KegiatanMingguanController::class, 'index'])->name('kegiatan_mingguan.index');
//     Route::get('mingguan/create', [KegiatanMingguanController::class, 'create'])->name('kegiatan_mingguan.create');
//     Route::post('mingguan', [KegiatanMingguanController::class, 'store'])->name('kegiatan_mingguan.store');
//     Route::get('mingguan/{kegiatanMingguan}/edit', [KegiatanMingguanController::class, 'edit'])->name('kegiatan_mingguan.edit');
//     Route::put('mingguan/{kegiatanMingguan}', [KegiatanMingguanController::class, 'update'])->name('kegiatan_mingguan.update');
//     Route::delete('mingguan/{kegiatanMingguan}', [KegiatanMingguanController::class, 'destroy'])->name('kegiatan_mingguan.destroy');
// });

// Route::prefix('pengawas/kegiatan')->group(function () {
//     Route::get('mingguan', [KegiatanMingguanController::class, 'index'])->name('kegiatan_mingguan.index');
//     Route::get('mingguan/create', [KegiatanMingguanController::class, 'create'])->name('kegiatan_mingguan.create');
//     Route::post('mingguan', [KegiatanMingguanController::class, 'store'])->name('kegiatan_mingguan.store');
//     Route::get('mingguan/{kegiatanMingguan}/edit', [KegiatanMingguanController::class, 'edit'])->name('kegiatan_mingguan.edit');
//     Route::put('mingguan/{kegiatanMingguan}', [KegiatanMingguanController::class, 'update'])->name('kegiatan_mingguan.update');
//     Route::delete('mingguan/{kegiatanMingguan}', [KegiatanMingguanController::class, 'destroy'])->name('kegiatan_mingguan.destroy');
// });

// Route::prefix('petugas/kegiatan')->group(function () {
//     Route::get('mingguan', [KegiatanMingguanController::class, 'index'])->name('kegiatan_mingguan.index');
//     Route::get('mingguan/create', [KegiatanMingguanController::class, 'create'])->name('kegiatan_mingguan.create');
//     Route::post('mingguan', [KegiatanMingguanController::class, 'store'])->name('kegiatan_mingguan.store');
//     Route::get('mingguan/{kegiatanMingguan}/edit', [KegiatanMingguanController::class, 'edit'])->name('kegiatan_mingguan.edit');
//     Route::put('mingguan/{kegiatanMingguan}', [KegiatanMingguanController::class, 'update'])->name('kegiatan_mingguan.update');
//     Route::delete('mingguan/{kegiatanMingguan}', [KegiatanMingguanController::class, 'destroy'])->name('kegiatan_mingguan.destroy');
// });


// //kegiatan bulanan
// Route::prefix('admin/kegiatan')->group(function () {
//     Route::get('bulanan', [KegiatanBulananController::class, 'index'])->name('kegiatan_bulanan.index');
//     Route::get('bulanan/create', [KegiatanBulananController::class, 'create'])->name('kegiatan_bulanan.create');
//     Route::post('bulanan', [KegiatanBulananController::class, 'store'])->name('kegiatan_bulanan.store');
//     Route::get('bulanan/{kegiatanBulanan}/edit', [KegiatanBulananController::class, 'edit'])->name('kegiatan_bulanan.edit');
//     Route::put('bulanan/{kegiatanBulanan}', [KegiatanBulananController::class, 'update'])->name('kegiatan_bulanan.update');
//     Route::delete('bulanan/{kegiatanBulanan}', [KegiatanBulananController::class, 'destroy'])->name('kegiatan_bulanan.destroy');
// });

// Route::prefix('pengawas/kegiatan')->group(function () {
//     Route::get('bulanan', [KegiatanBulananController::class, 'index'])->name('kegiatan_bulanan.index');
//     Route::get('bulanan/create', [KegiatanBulananController::class, 'create'])->name('kegiatan_bulanan.create');
//     Route::post('bulanan', [KegiatanBulananController::class, 'store'])->name('kegiatan_bulanan.store');
//     Route::get('bulanan/{kegiatanBulanan}/edit', [KegiatanBulananController::class, 'edit'])->name('kegiatan_bulanan.edit');
//     Route::put('bulanan/{kegiatanBulanan}', [KegiatanBulananController::class, 'update'])->name('kegiatan_bulanan.update');
//     Route::delete('bulanan/{kegiatanBulanan}', [KegiatanBulananController::class, 'destroy'])->name('kegiatan_bulanan.destroy');
// });

// Route::prefix('petugas/kegiatan')->group(function () {
//     Route::get('bulanan', [KegiatanBulananController::class, 'index'])->name('kegiatan_bulanan.index');
//     Route::get('bulanan/create', [KegiatanBulananController::class, 'create'])->name('kegiatan_bulanan.create');
//     Route::post('bulanan', [KegiatanBulananController::class, 'store'])->name('kegiatan_bulanan.store');
//     Route::get('bulanan/{kegiatanBulanan}/edit', [KegiatanBulananController::class, 'edit'])->name('kegiatan_bulanan.edit');
//     Route::put('bulanan/{kegiatanBulanan}', [KegiatanBulananController::class, 'update'])->name('kegiatan_bulanan.update');
//     Route::delete('bulanan/{kegiatanBulanan}', [KegiatanBulananController::class, 'destroy'])->name('kegiatan_bulanan.destroy');
// });
