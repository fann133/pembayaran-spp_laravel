<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Guru;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        // Validasi input login
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Cek apakah kredensial cocok
        if (Auth::attempt($credentials)) {
            $user = Auth::user(); // Ambil data pengguna yang login
            $role_id = $user->role_id; // Ambil role_id dari user
            $userId = $user->id_users; // Ambil primary key dari tabel users
            
            // Debugging
            Log::info('Login berhasil', ['role_id' => $role_id, 'userId' => $userId]);

            // Tentukan redirect berdasarkan role_id
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
                        \Log::error('Data siswa tidak ditemukan', ['userId' => $userId]);
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
                        \Log::error('Data guru tidak ditemukan', ['userId' => $userId]);
                        return redirect()->route('login')->withErrors(['error' => 'Data guru tidak ditemukan.']);
                    }
                    break;

                default:
                    \Log::error('Role tidak ditemukan', ['role_id' => $role_id]);
                    return redirect()->route('login')->withErrors(['error' => 'Role tidak ditemukan']);
            }

            // Simpan data user di session
            session()->put('userData', $userData);

            // Redirect ke halaman yang sesuai
            return redirect()->route($redirectRoute);
        }

        // Jika login gagal
        return back()->withErrors(['error' => 'Username atau password salah']);
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
