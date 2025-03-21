<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Guru;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    // Fungsi untuk menangani login
    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $user = Auth::user(); // Ambil data user
        
            $user->update(['login_times' => now()]);
        
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['login' => 'Username atau password salah']);
    }

    // Fungsi logout
    public function logout(Request $request)
    {
        Auth::logout(); // Logout pengguna
        $request->session()->invalidate(); // Hapus sesi
        $request->session()->regenerateToken(); // Regenerasi token CSRF

        return redirect()->route('login'); // Redirect ke halaman login
    }

    public function index()
    {
        $users = User::all(); // Ambil semua data user
        return view('user.index', compact('users'));
    }

    public function create()
    {
        return view('user.create'); // Pastikan ada file Blade users/create.blade.php
    }


    public function getAllNames()
    {
        // Ambil data siswa dengan NIS sebagai username dan role_id = 2
        $siswas = Siswa::select('nama', 'nis as username')
                    ->get()
                    ->map(function ($siswa) {
                            return [
                                'nama' => $siswa->nama,
                                'username' => $siswa->username,
                                'role' => 2 // Role 2 untuk siswa
                            ];
                    });

        // Ambil data guru dengan NIP sebagai username dan role_id = 3
        $gurus = Guru::select('nama', 'nip as username')
                    ->get()
                    ->map(function ($guru) {
                        return [
                            'nama' => $guru->nama,
                            'username' => $guru->username,
                            'role' => 3 // Role 3 untuk guru
                        ];
                    });

        // Gabungkan data siswa dan guru
        $users = $siswas->merge($gurus);

        return response()->json($users);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users',
                'role_id' => 'required|in:1,2,3,4,5',
            ]);

            // Generate password random (8 karakter)
            $randomPassword = mt_rand(10000, 99999);

            // Pastikan ID UUID di-generate sebelum insert
            User::create([
                'id_users' => Str::uuid(), // Tambahkan UUID untuk id_users
                'name' => (string) $request->name,
                'username' => (string) $request->username,
                'password' => Hash::make($randomPassword),
                'bypass' => (string) $randomPassword,
                'role_id' => (int) $request->role_id,
            ]);

            return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan! Password: ' . $randomPassword);
        } catch (\Exception $e) {
            dd('Error:', $e->getMessage()); // Debug jika masih error
        }
    }
}
