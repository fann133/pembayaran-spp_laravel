<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Tagihan;
use App\Models\Siswa;
use Illuminate\Support\Facades\Log;

class TagihanController extends Controller
{

public function index()
{
    $guru = auth()->user()->guru;

    
    if (!$guru) {
        return back()->with('error', 'Data guru tidak ditemukan.');
    }

    // Cari kelas yang dia ampu
    $kelasIds = \App\Models\Kelas::where('pengampu_kelas', $guru->id_guru)->pluck('id_kelas');

    // Ambil siswa dari kelas tersebut
    $siswaIds = Siswa::whereIn('kelas', $kelasIds)->pluck('id_siswa');
    Log::info($siswaIds); // cek apakah ada siswa yang ketarik

    dd(auth()->user()->guru);

    // Ambil tagihan berdasarkan siswa tersebut
    $tagihans = Tagihan::whereIn('id_siswa', $siswaIds)->get();

    return view('guru.tagihan.index', compact('tagihans'));
}

}


