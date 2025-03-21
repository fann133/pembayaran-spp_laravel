<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('login');
});

// Route untuk menampilkan halaman login
Route::get('/login', function () {
    return view('login'); // Pastikan ada file resources/views/login.blade.php
})->name('login');

// Route untuk autentikasi login
Route::post('/login/authenticate', [UserController::class, 'authenticate'])->name('login.authenticate');


// Route Grub
Route::middleware(['auth'])->group(function () {
    // Route Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route Lihat Siswa
    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');

    // Route Tambah Siswa
    Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
    Route::post('/siswa/store', [SiswaController::class, 'store'])->name('siswa.store');

    // Route Ubah Siswa
    Route::get('/siswas/{id}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
    Route::post('/siswas/{id}/update', [SiswaController::class, 'update'])->name('siswa.update');

    // Route Hapus Siswa
    Route::delete('/siswas/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');

    // Route User
    Route::get('/user', [UserController::class, 'index'])->name('user.index');

    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::get('/get-all-names', [UserController::class, 'getAllNames']);
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');



});





// Route untuk logout
Route::post('/logout', function() {
    Auth::logout(); // Logout user dari session
    request()->session()->invalidate(); // Hapus session
    request()->session()->regenerateToken(); // Regenerate token CSRF
    
    return redirect('/login');
})->name('logout');



