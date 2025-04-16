<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function index()
    {
        // Ambil data guru yang sedang login
        $guru = auth()->user()->guru; // pastikan relasi user->guru sudah dibuat

        // Ambil semua kelas yang diampu guru ini
        $kelasIds = Kelas::where('pengampu_kelas', $guru->id_guru)->pluck('id_kelas');

        // Ambil siswa yang terdaftar di kelas tersebut
        $siswas = Siswa::whereIn('id_kelas', $kelasIds)
                        ->whereIn('status', ['AKTIF', 'PINDAHAN'])
                        ->get();

        return view('guru.siswa.index', compact('siswas'));
    }
}




