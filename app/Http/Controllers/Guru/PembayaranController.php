<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\Kelas;

class PembayaranController extends Controller
{
    public function index()
    {
        $guru = auth()->user()->guru;

        if (!$guru) {
            return back()->with('error', 'Data guru tidak ditemukan.');
        }

        $kelasIds = Kelas::where('pengampu_kelas', $guru->id_guru)->pluck('id_kelas');

        $siswaIds = Siswa::whereIn('id_kelas', $kelasIds)->pluck('id_siswa');

        $pembayarans = Pembayaran::whereIn('id_siswa', $siswaIds)->get();

        return view('guru.pembayaran.index', compact('pembayarans'));
    }
}

