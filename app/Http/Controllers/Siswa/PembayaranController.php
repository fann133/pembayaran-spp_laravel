<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\Pembayaran;

class PembayaranController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:siswa']);
    }

    public function index()
    {
        $user = Auth::user();
        $siswa = Siswa::where('users_id', $user->id_users)->first();

        $pembayaran = collect();

        if ($siswa) {
            $pembayaran = Pembayaran::where('id_siswa', $siswa->id_siswa)
                            ->orderBy('tanggal_bayar', 'desc')
                            ->get();
        }

        return view('siswa.pembayaran.index', compact('pembayaran'));
    }

    public function show($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        return view('siswa.pembayaran.show', compact('pembayaran'));
    }
}
