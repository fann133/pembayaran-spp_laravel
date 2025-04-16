<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Siswa;

class PembayaranController extends Controller
{
    public function index()
    {
        $guru = auth()->user()->guru;

        if (!$guru) {
            return back()->with('error', 'Data guru tidak ditemukan.');
        }

        $kelasIds = \App\Models\Kelas::where('pengampu_kelas', $guru->id_guru)->pluck('id_kelas');

        $siswaIds = \App\Models\Siswa::whereIn('kelas', $kelasIds)->pluck('id_siswa');

        $pembayarans = Pembayaran::whereIn('id_siswa', $siswaIds)->get();

        return view('guru.pembayaran.index', compact('pembayarans'));
    }
}

