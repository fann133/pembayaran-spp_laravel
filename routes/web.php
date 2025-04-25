<?php

use Illuminate\Http\Request;
use App\Models\Biaya;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProfilController as AdminProfilController; 
use App\Http\Controllers\Admin\SiswaController as AdminSiswaController;
use App\Http\Controllers\Admin\GuruController as AdminGuruController;
use App\Http\Controllers\Admin\KelasController as AdminKelasController;
use App\Http\Controllers\Admin\BiayaController as AdminBiayaController;
use App\Http\Controllers\Admin\TagihanController as AdminTagihanController;
use App\Http\Controllers\Admin\PembayaranController as AdminPembayaranController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\AplikasiController as AdminAplikasiController;
use App\Http\Controllers\Admin\DatabaseController as AdminDatabaseController;

use App\Http\Controllers\Siswa\DashboardController as SiswaDashboardController;
use App\Http\Controllers\Siswa\TagihanController as SiswaTagihanController;
use App\Http\Controllers\Siswa\PembayaranController as SiswaPembayaranController;

use App\Http\Controllers\Guru\DashboardController as GuruDashboardController;
use App\Http\Controllers\Guru\SiswaController as GuruSiswaController;
use App\Http\Controllers\Guru\TagihanController as GuruTagihanController;
use App\Http\Controllers\Guru\PembayaranController as GuruPembayaranController;

use App\Http\Controllers\Bendahara\DashboardController as BendaharaDashboardController;
use App\Http\Controllers\Bendahara\SiswaController as BendaharaSiswaController;
use App\Http\Controllers\Bendahara\TagihanController as BendaharaTagihanController;
use App\Http\Controllers\Bendahara\PembayaranController as BendaharaPembayaranController;

use App\Http\Controllers\Kepsek\DashboardController as KepsekDashboardController;



Route::fallback(function () {
    return response()->view('blank', [], 404);
});
// Halaman Login
Route::get('/', function () {
    return view('auth');
});

Route::get('/auth', function () {
    return view('auth');
})->name('auth');

Route::post('/login/authenticate', [LoginController::class, 'authenticate'])->name('login.authenticate');

Route::middleware(['auth', 'session.timeout'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [GuruDashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [BendaharaDashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [KepsekDashboardController::class, 'index'])->name('dashboard');
});

Route::post('/login', [LoginController::class, 'authenticate'])->middleware('throttle:10,1');

// Middleware Authentication dan Role Protection
Route::middleware(['auth'])->group(function () {
    // **ADMIN ROUTES**
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        // Manajemen Profil
        Route::get('/profil-sekolah', [AdminProfilController::class, 'index'])->name('admin.profil.index');
        Route::post('/profil-sekolah', [AdminProfilController::class, 'update'])->name('admin.profil.update');

        // Manajemen Siswa
        Route::get('/siswa', [AdminSiswaController::class, 'index'])->name('admin.siswa.index');
        Route::get('/siswa/create', [AdminSiswaController::class, 'create'])->name('admin.siswa.create');
        Route::post('/siswa/store', [AdminSiswaController::class, 'store'])->name('admin.siswa.store');
        Route::get('/siswa/{id_siswa}', [AdminSiswaController::class, 'createAccount'])->name('admin.siswa.createAccount');
        Route::get('/siswa/edit/{id}', [AdminSiswaController::class, 'edit'])->name('admin.siswa.edit');
        Route::post('/siswa/{id}/update', [AdminSiswaController::class, 'update'])->name('admin.siswa.update');
        Route::delete('/siswa/{id}', [AdminSiswaController::class, 'destroy'])->name('admin.siswa.destroy');

        // Manajemen Guru
        Route::get('/guru', [AdminGuruController::class, 'index'])->name('admin.guru.index');
        Route::get('/guru/create', [AdminGuruController::class, 'create'])->name('admin.guru.create');
        Route::post('/guru/store', [AdminGuruController::class, 'store'])->name('admin.guru.store');
        Route::get('/guru/{id_guru}', [AdminGuruController::class, 'createAccount'])->name('admin.guru.createAccount');
        Route::get('/guru/edit/{id}', [AdminGuruController::class, 'edit'])->name('admin.guru.edit');
        Route::put('/guru/{id}', [AdminGuruController::class, 'update'])->name('admin.guru.update');
        Route::delete('/guru/{id_guru}', [AdminGuruController::class, 'destroy'])->name('admin.guru.destroy');

        // Manajemen Kelas
        Route::get('/kelas', [AdminKelasController::class, 'index'])->name('admin.kelas.index');
        Route::get('/kelas/create', [AdminKelasController::class, 'create'])->name('admin.kelas.create');
        Route::post('/kelas/store', [AdminKelasController::class, 'store'])->name('admin.kelas.store');
        Route::get('/kelas/{id_kelas}', [AdminKelasController::class, 'show'])->name('admin.kelas.show');
        Route::get('/kelas/edit/{id_kelas}', [AdminKelasController::class, 'edit'])->name('admin.kelas.edit');
        Route::put('/kelas/{id_kelas}', [AdminKelasController::class, 'update'])->name('admin.kelas.update');
        Route::delete('/kelas/{id_kelas}', [AdminKelasController::class, 'destroy'])->name('admin.kelas.destroy');

        // Manajemen Biaya
        Route::get('/biaya', [AdminBiayaController::class, 'index'])->name('admin.biaya.index');
        Route::get('/biaya/create', [AdminBiayaController::class, 'create'])->name('admin.biaya.create');
        Route::post('/biaya', [AdminBiayaController::class, 'store'])->name('admin.biaya.store');
        Route::get('/biaya/edit/{id}', [AdminBiayaController::class, 'edit'])->name('admin.biaya.edit');
        Route::put('/biaya/{id}', [AdminBiayaController::class, 'update'])->name('admin.biaya.update');
        Route::delete('/biaya/{id_biaya}', [AdminBiayaController::class, 'destroy'])->name('admin.biaya.destroy');

        // Manajemen Tagihan
        Route::get('/tagihan', [AdminTagihanController::class, 'index'])->name('admin.tagihan.index');
        Route::get('/tagihan/create', [AdminTagihanController::class, 'create'])->name('admin.tagihan.create');
        Route::post('/tagihan', [AdminTagihanController::class, 'store'])->name('admin.tagihan.store');  
        Route::get('/get-biaya', function (Request $request) {
            $spp = $request->query('spp');
            $kategori = $request->query('kategori');
        
            $query = Biaya::where('kategori', $kategori)->where('status', 'AKTIF');
            if ($spp == 1) {
                return response()->json($query->where('jenis', 'SPP')->first());
            } else {
                return response()->json($query->where('jenis', 'NON-SPP')->get());
            }
        });
        Route::get('/tagihan/payment/{id}', [AdminTagihanController::class, 'payment'])->name('admin.tagihan.payment');
        Route::post('/tagihan/payment/{id}', [AdminTagihanController::class, 'processPayment'])->name('admin.tagihan.processPayment');
        Route::get('/tagihan/print/{id_tagihan}', [AdminTagihanController::class, 'print'])->name('admin.tagihan.print');
        Route::post('/tagihan/printAll', [AdminTagihanController::class, 'printAll'])->name('admin.tagihan.printAll');
        Route::delete('/tagihan/{id}', [AdminTagihanController::class, 'destroy'])->name('admin.tagihan.destroy');

        // Manajemen Pembayaran
        Route::get('/pembayaran', [AdminPembayaranController::class, 'index'])->name('admin.pembayaran.index');
        Route::get('/pembayaran/print/{id}', [AdminPembayaranController::class, 'print'])->name('admin.pembayaran.print');
        Route::post('/pembayaran/printAll', [AdminPembayaranController::class, 'printAll'])->name('admin.pembayaran.printAll');
        Route::post('/pembayaran/export-excel', [AdminPembayaranController::class, 'exportExcel'])->name('admin.pembayaran.exportExcel');
        Route::delete('/pembayaran/{id}', [AdminPembayaranController::class, 'destroy'])->name('admin.pembayaran.destroy');

        // Manajemen User
        Route::get('/user', [AdminUserController::class, 'index'])->name('admin.user.index');
        Route::get('/users/edit/{id}', [AdminUserController::class, 'edit'])->name('admin.user.edit');
        Route::put('/users/{id}', [AdminUserController::class, 'update'])->name('admin.user.update');

        // Manajemen Settings
        Route::get('/pengaturan', [AdminAplikasiController::class, 'index'])->name('admin.pengaturan');
        Route::post('/pengaturan/update', [AdminAplikasiController::class, 'update'])->name('admin.pengaturan.update');

        // Database Management
        Route::get('/database', [AdminDatabaseController::class, 'index'])->name('admin.database');
        Route::post('/database/backup', [AdminDatabaseController::class, 'backup'])->name('admin.database.backup');
        Route::get('/database/download', [AdminDatabaseController::class, 'download'])->name('admin.database.download');
    });

    // **SISWA ROUTES**
        Route::middleware('role:siswa')->prefix('siswa')->group(function () {
        Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('siswa.dashboard');

        Route::get('/tagihan', [SiswaTagihanController::class, 'index'])->name('siswa.tagihan.index');
        Route::get('/tagihan/{id}', [SiswaTagihanController::class, 'show'])->name('siswa.tagihan.show');

        // Route siswa untuk halaman pembayaran
        Route::get('/pembayaran', [SiswaPembayaranController::class, 'index'])->name('siswa.pembayaran.index');
        Route::get('/pembayaran/{id}', [SiswaPembayaranController::class, 'show'])->name('siswa.pembayaran.show');
    });

    // **GURU ROUTES**
    Route::middleware('role:guru')->prefix('guru')->group(function () {
        Route::get('/dashboard', [GuruDashboardController::class, 'index'])->name('guru.dashboard');

        Route::get('/siswa', [GuruSiswaController::class, 'index'])->name('guru.siswa.index');

        Route::get('/tagihan', [GuruTagihanController::class, 'index'])->name('guru.tagihan.index');
        Route::get('/tagihan/payment/{id}', [GuruTagihanController::class, 'payment'])->name('guru.tagihan.payment');
        Route::post('/tagihan/payment/{id}', [GuruTagihanController::class, 'processPayment'])->name('guru.tagihan.processPayment');
        Route::get('/tagihan/print/{id_tagihan}', [GuruTagihanController::class, 'print'])->name('guru.tagihan.print');
        Route::post('/tagihan/printAll', [GuruTagihanController::class, 'printAll'])->name('guru.tagihan.printAll');
        Route::delete('/tagihan/{id}', [GuruTagihanController::class, 'destroy'])->name('tagihan.destroy');


        Route::get('/pembayaran', [GuruPembayaranController::class, 'index'])->name('guru.pembayaran.index');
        Route::get('/pembayaran/print/{id}', [GuruPembayaranController::class, 'print'])->name('guru.pembayaran.print');
        Route::post('/pembayaran/printAll', [GuruPembayaranController::class, 'printAll'])->name('guru.pembayaran.printAll');
        Route::post('/pembayaran/export-excel', [GuruPembayaranController::class, 'exportExcel'])->name('guru.pembayaran.exportExcel');
        Route::delete('/pembayaran/{id}', [GuruPembayaranController::class, 'destroy'])->name('pembayaran.destroy');

    });

    // **BENDAHARA ROUTES**
    Route::middleware('role:bendahara')->prefix('bendahara')->group(function () {
        Route::get('/dashboard', [BendaharaDashboardController::class, 'index'])->name('bendahara.dashboard');

        Route::get('/siswa', [BendaharaSiswaController::class, 'index'])->name('bendahara.siswa.index');
        Route::get('/siswa/{id_siswa}', [BendaharaSiswaController::class, 'show'])->name('bendahara.siswa.show');

        Route::get('/tagihan', [BendaharaTagihanController::class, 'index'])->name('bendahara.tagihan.index');
        Route::get('/tagihan/create', [BendaharaTagihanController::class, 'create'])->name('bendahara.tagihan.create');
        Route::post('/tagihan', [BendaharaTagihanController::class, 'store'])->name('bendahara.tagihan.store');  
        Route::get('/get-biaya', function (Request $request) {
            $spp = $request->query('spp');
            $kategori = $request->query('kategori');
        
            $query = Biaya::where('kategori', $kategori)->where('status', 'AKTIF');
            if ($spp == 1) {
                return response()->json($query->where('jenis', 'SPP')->first());
            } else {
                return response()->json($query->where('jenis', 'NON-SPP')->get());
            }
        });
        Route::get('/tagihan/payment/{id}', [BendaharaTagihanController::class, 'payment'])->name('bendahara.tagihan.payment');
        Route::post('/tagihan/payment/{id}', [BendaharaTagihanController::class, 'processPayment'])->name('bendahara.tagihan.processPayment');
        Route::get('/tagihan/print/{id_tagihan}', [BendaharaTagihanController::class, 'print'])->name('bendahara.tagihan.print');
        Route::post('/tagihan/printAll', [BendaharaTagihanController::class, 'printAll'])->name('bendahara.tagihan.printAll');
        Route::delete('/tagihan/{id}', [BendaharaTagihanController::class, 'destroy'])->name('bendahara.tagihan.destroy');

        Route::get('/pembayaran', [BendaharaPembayaranController::class, 'index'])->name('bendahara.pembayaran.index');
        Route::get('/pembayaran/print/{id}', [BendaharaPembayaranController::class, 'print'])->name('bendahara.pembayaran.print');
        Route::post('/pembayaran/printAll', [BendaharaPembayaranController::class, 'printAll'])->name('bendahara.pembayaran.printAll');
        Route::post('/pembayaran/export-excel', [BendaharaPembayaranController::class, 'exportExcel'])->name('bendahara.pembayaran.exportExcel');
        Route::delete('/pembayaran/{id}', [BendaharaPembayaranController::class, 'destroy'])->name('bendahara.pembayaran.destroy');
    });

    // **KEPSEK ROUTES**
    Route::middleware('role:kepsek')->prefix('kepsek')->group(function () {
        Route::get('/dashboard', [KepsekDashboardController::class, 'index'])->name('kepsek.dashboard');
    });
});

// **LOGOUT ROUTE**
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/auth');
})->name('logout');
