<?php

namespace App\Http\Controllers;


use App\Models\Guru;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        // Validasi input login
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Cek apakah username ada
        $user = User::where('username', $credentials['username'])->first();

        if (!$user) {
            // Username tidak ditemukan
            return back()->withErrors(['username' => 'Username tidak ditemukan']);
        }

        // Cek apakah password cocok
        if (!Hash::check($credentials['password'], $user->password)) {
            // Password salah
            return back()->withErrors(['password' => 'Password salah']);
        }

        // Login user
        Auth::login($user);

        $role_id = $user->role_id ?? null;
        $userId = $user->id_users ?? null;

        if (!$userId) {
            Log::error('ID User tidak ditemukan saat login', ['user' => $user]);
            return redirect()->route('login')->withErrors(['error' => 'Terjadi kesalahan saat login, coba lagi.']);
        }

        session(['id_users' => $userId]);

        $redirectRoute = null;
        $userData = null;

        switch ($role_id) {
            case 1:
                $redirectRoute = 'admin.dashboard';
                $userData = $user;
                break;

            case 2:
                $siswa = Siswa::where('users_id', (string) $userId)->first();
                if ($siswa) {
                    $redirectRoute = 'siswa.dashboard';
                    $userData = $siswa;
                } else {
                    return redirect()->route('login')->withErrors(['error' => 'Data siswa tidak ditemukan.']);
                }
                break;

            case 3:
            case 4:
            case 5:
                $guru = Guru::where('id_users', (string) $userId)->first();
                if ($guru) {
                    $redirectRoute = $this->getRoleRoute($role_id) . '.dashboard';
                    $userData = $guru;
                } else {
                    return redirect()->route('login')->withErrors(['error' => 'Data guru tidak ditemukan.']);
                }
                break;

            default:
                return redirect()->route('login')->withErrors(['error' => 'Role tidak ditemukan']);
        }

        session()->put('userData', $userData);

        return redirect()->route($redirectRoute);
    }





    /**
     * Fungsi untuk menentukan route berdasarkan role_id
     */
    private function getRoleRoute($role_id)
    {
        $roles = [
            3 => 'guru',
            4 => 'bendahara',
            5 => 'kepsek',
        ];
        return $roles[$role_id] ?? 'login';
    }

    /**
     * Fungsi logout
     */
    public function logout(Request $request)
    {
        Auth::logout(); // Logout user
        $request->session()->invalidate(); // Hapus session
        $request->session()->regenerateToken(); // Regenerasi token CSRF

        return redirect()->route('login'); // Redirect ke halaman login
    }
}
