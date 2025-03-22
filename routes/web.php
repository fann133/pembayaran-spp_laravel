<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\DashboardController;


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

    // Route Create Account Siswa
    Route::get('/siswa/create-account/{id_siswa}', [SiswaController::class, 'createAccount'])->name('siswa.createAccount');

    // Route Lihat Guru
    Route::get('/guru', [GuruController::class, 'index'])->name('guru.index');

    // Route Tambah Guru
    Route::get('/guru/create', [GuruController::class, 'create'])->name('guru.create');
    Route::post('/guru/store', [GuruController::class, 'store'])->name('guru.store');

    // Route Ubah Guru
    Route::get('/guru/{id}/edit', [GuruController::class, 'edit'])->name('guru.edit');
    Route::put('/guru/{id}', [GuruController::class, 'update'])->name('guru.update');

    // Route Tambah Account Guru
    Route::get('/guru/createAccount/{id_guru}', [GuruController::class, 'createAccount'])->name('guru.createAccount');

    // Route Hapus Guru
    Route::delete('/gurus/{id_guru}', [GuruController::class, 'destroy'])->name('guru.destroy');


    // Route User
    Route::get('/user', [UserController::class, 'index'])->name('user.index');

    // Route Ubah User
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('user.update');


    // Halaman Database
    Route::get('/database', [DatabaseController::class, 'index'])->name('database');
    Route::post('/database/backup', [DatabaseController::class, 'backup'])->name('database.backup');
    Route::get('/database/download', [DatabaseController::class, 'download'])->name('database.download');

});





// Route untuk logout
Route::post('/logout', function() {
    Auth::logout(); // Logout user dari session
    request()->session()->invalidate(); // Hapus session
    request()->session()->regenerateToken(); // Regenerate token CSRF
    
    return redirect('/login');
})->name('logout');



