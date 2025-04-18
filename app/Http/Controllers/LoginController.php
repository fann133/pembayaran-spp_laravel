<?php

namespace App\Http\Controllers;


use App\Models\Guru;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        // Validasi input login (username & password wajib diisi)
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
            'g-recaptcha-response' => 'required',
        ], [
            'username.required' => 'Username tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
            'g-recaptcha-response.required' => 'Centang dan selesaikan reCAPTCHA',
        ]);

        // Ambil user berdasarkan username
        $user = User::where('username', $credentials['username'])->first();

        // Cek apakah user ditemukan
        if (!$user) {
            return back()->withErrors(['username' => 'Username tidak ditemukan'])->withInput();
        }

        // Cek apakah password cocok
        if (!Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors(['password' => 'Password salah'])->withInput();
        }

        // Cek apakah reCAPTCHA valid
        $recaptchaResponse = $request->input('g-recaptcha-response');
        
        // Cek apakah kunci reCAPTCHA sudah terpasang
        $secretKey = env('RECAPTCHA_SECRETKEY');
        if (empty($secretKey)) {
            return back()->withErrors(['recaptcha' => 'Konfigurasi reCAPTCHA belum disetting.'])->withInput();
        }

        // Kirim request ke Google reCAPTCHA untuk verifikasi
        $response = Http::timeout(20)->asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $secretKey,
            'response' => $recaptchaResponse,
        ]);

        // Pastikan response dari Google berhasil
        if (!$response->successful()) {
            return back()->withErrors(['recaptcha' => 'Verifikasi reCAPTCHA gagal. Coba lagi.'])->withInput();
        }

        $result = $response->json();
        
        // Cek hasil verifikasi reCAPTCHA
        if (!$result['success']) {
            return back()->withErrors(['recaptcha' => 'Verifikasi reCAPTCHA gagal'])->withInput();
        }

        // Login user
        Auth::login($user);

        // Cek apakah ini login pertama atau bukan (sebelum update)
        if (is_null($user->login_times)) {
            session()->flash('success', 'Login berhasil! Selamat datang.');
        } else {
            session()->flash('success', 'Login berhasil! Selamat datang.');
        }

        // Update login_times ke waktu sekarang
        $user->login_times = now();
        $user->save();

        // Ambil role_id dan id_users
        $role_id = $user->role_id ?? null;
        $userId = $user->id_users ?? null;

        // Jika id_users tidak ditemukan
        if (!$userId) {
            Log::error('ID User tidak ditemukan saat login', ['user' => $user]);
            return redirect()->route('login')->withErrors(['error' => 'Terjadi kesalahan saat login, coba lagi.']);
        }

        // Simpan id_users ke session
        session(['id_users' => $userId]);

        // Log aktivitas login
        Log::info("User login: {$user->username} dengan role {$role_id}", ['id_users' => $userId]);

        $redirectRoute = null;
        $userData = null;

        // Arahkan berdasarkan role_id
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
                $guru = Guru::where('users_id', (string) $userId)->first();
                if ($guru) {
                    $redirectRoute = $this->getRoleRoute($role_id) . '.dashboard';
                    $userData = $guru;
                } else {
                    return redirect()->route('login')->withErrors(['error' => 'Data guru tidak ditemukan.']);
                }
                break;

            default:
                return redirect()->route('login')->withErrors(['error' => 'Role tidak ditemukan.']);
        }

        session()->put('userData', [
            'id' => $userData->id,
            'nama' => $userData->nama ?? $userData->name,
            'role' => $role_id,
        ]);

        return redirect()->route($redirectRoute);
    }

    public function authenticated(Request $request, $user)
    {
        Session::put('login_times', now());

        return redirect()->intended('dashboard');
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
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
