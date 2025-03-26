<?php


use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboardController;
use App\Http\Controllers\Guru\DashboardController as GuruDashboardController;
use App\Http\Controllers\Bendahara\DashboardController as BendaharaDashboardController;
use App\Http\Controllers\Kepsek\DashboardController as KepsekDashboardController;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\BiayaController;
use App\Http\Controllers\Admin\TagihanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DatabaseController;


Route::fallback(function () {
    return response()->view('blank', [], 404);
});
// Halaman Login
Route::get('/', function () {
    return view('login');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login/authenticate', [LoginController::class, 'authenticate'])->name('login.authenticate');

// Middleware Authentication dan Role Protection
Route::middleware(['auth'])->group(function () {
    // **ADMIN ROUTES**
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        // Manajemen Siswa
        Route::get('/siswa', [SiswaController::class, 'index'])->name('admin.siswa.index');
        Route::get('/siswa/create', [SiswaController::class, 'create'])->name('admin.siswa.create');
        Route::post('/siswa/store', [SiswaController::class, 'store'])->name('admin.siswa.store');
        Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])->name('admin.siswa.edit');
        Route::post('/siswa/{id}/update', [SiswaController::class, 'update'])->name('admin.siswa.update');
        Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->name('admin.siswa.destroy');
        Route::get('/siswa/create-account/{id_siswa}', [SiswaController::class, 'createAccount'])->name('admin.siswa.createAccount');

        // Manajemen Guru
        Route::get('/guru', [GuruController::class, 'index'])->name('admin.guru.index');
        Route::get('/guru/create', [GuruController::class, 'create'])->name('admin.guru.create');
        Route::post('/guru/store', [GuruController::class, 'store'])->name('admin.guru.store');
        Route::get('/guru/{id}/edit', [GuruController::class, 'edit'])->name('admin.guru.edit');
        Route::put('/guru/{id}', [GuruController::class, 'update'])->name('admin.guru.update');
        Route::get('/guru/createAccount/{id_guru}', [GuruController::class, 'createAccount'])->name('admin.guru.createAccount');
        Route::delete('/guru/{id_guru}', [GuruController::class, 'destroy'])->name('admin.guru.destroy');


        Route::get('/kelas', [KelasController::class, 'index'])->name('admin.kelas.index');
        Route::get('/kelas/create', [KelasController::class, 'create'])->name('admin.kelas.create');
        Route::post('/kelas/store', [KelasController::class, 'store'])->name('admin.kelas.store');
        Route::get('/kelas/{id_kelas}', [KelasController::class, 'show'])->name('admin.kelas.show');
        Route::get('/kelas/{id_kelas}/edit', [KelasController::class, 'edit'])->name('admin.kelas.edit');
        Route::put('/kelas/{id_kelas}', [KelasController::class, 'update'])->name('admin.kelas.update');
        Route::delete('/kelas/{id_kelas}', [KelasController::class, 'destroy'])->name('admin.kelas.destroy');


        Route::get('/biaya', [BiayaController::class, 'index'])->name('admin.biaya.index');
        Route::get('/biaya/create', [BiayaController::class, 'create'])->name('admin.biaya.create');
        Route::post('/biaya', [BiayaController::class, 'store'])->name('admin.biaya.store');        
        Route::get('/biaya/{id}/edit', [BiayaController::class, 'edit'])->name('admin.biaya.edit');
        Route::put('/biaya/{id}', [BiayaController::class, 'update'])->name('admin.biaya.update');
        Route::delete('/biaya/{id_biaya}', [BiayaController::class, 'destroy'])->name('admin.biaya.destroy');

        Route::get('/tagihan', [TagihanController::class, 'index'])->name('admin.tagihan.index');

        // Manajemen User
        Route::get('/user', [UserController::class, 'index'])->name('admin.user.index');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('admin.user.update');

        // Database Management
        Route::get('/database', [DatabaseController::class, 'index'])->name('admin.database');
        Route::post('/database/backup', [DatabaseController::class, 'backup'])->name('admin.database.backup');
        Route::get('/database/download', [DatabaseController::class, 'download'])->name('admin.database.download');
    });

    // **SISWA ROUTES**
    Route::middleware('role:siswa')->prefix('siswa')->group(function () {
        Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('siswa.dashboard');
    });

    // // **GURU ROUTES**
    // Route::middleware('role:guru')->prefix('guru')->group(function () {
    //     Route::get('/dashboard', [GuruDashboardController::class, 'index'])->name('guru.dashboard');
    // });

    // // **BENDAHARA ROUTES**
    // Route::middleware('role:bendahara')->prefix('bendahara')->group(function () {
    //     Route::get('/dashboard', [BendaharaDashboardController::class, 'index'])->name('bendahara.dashboard');
    // });

    // // **KEPSEK ROUTES**
    // Route::middleware('role:kepsek')->prefix('kepsek')->group(function () {
    //     Route::get('/dashboard', [KepsekDashboardController::class, 'index'])->name('kepsek.dashboard');
    // });
});

// **LOGOUT ROUTE**
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');
