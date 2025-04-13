<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller; // Jangan lupa tambahkan ini
use App\Models\Tagihan;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Pastikan hanya user yang login bisa mengakses
    }

    public function index()
    {
        $user = Auth::user();
        $tagihan = collect(); // Gunakan collect() agar selalu berupa koleksi

        if ($user && $user->role_id == 2) { // Role Siswa
            $siswa = Siswa::where('users_id', $user->id_users)->first(); // Gunakan relasi yang benar
            if ($siswa) {
                $tagihan = Tagihan::where('id_siswa', $siswa->id_siswa)
                            ->where('status', 'BELUM DIBAYAR')
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();
            }
        }

        $tagihanCount = $tagihan->count();

        return view('siswa.dashboard', compact('tagihan', 'tagihanCount'));
    }
}
