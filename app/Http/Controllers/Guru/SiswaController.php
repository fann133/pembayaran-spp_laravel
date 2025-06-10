<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function index()
    {
        $pengaturan = Setting::first();
        // Ambil data guru yang sedang login
        $guru = auth()->user()->guru; // pastikan relasi user->guru sudah dibuat

        // Ambil semua kelas yang diampu guru ini
        $kelasIds = Kelas::where('pengampu_kelas', $guru->id_guru)->pluck('id_kelas');

        // Ambil siswa yang terdaftar di kelas tersebut
        $siswas = Siswa::whereIn('id_kelas', $kelasIds)
                        ->whereIn('status', ['AKTIF', 'PINDAHAN'])
                        ->get();

        return view('guru.siswa.index', compact('siswas', 'pengaturan'));
    }

    public function show($id_siswa)
    {
        $siswa = Siswa::where('id_siswa', $id_siswa)->firstOrFail();
        $pengaturan = Setting::first();
        return view('guru.siswa.show', compact('siswa', 'pengaturan'));
    }
}




