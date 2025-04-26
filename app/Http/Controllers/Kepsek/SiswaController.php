<?php

namespace App\Http\Controllers\Kepsek;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Siswa; // Pastikan model Siswa diimpor
use App\Models\User; // Pastikan model User diimpor
use App\Models\Kelas; // Pastikan model User diimpor
use App\Models\Biaya; // Pastikan model User diimpor
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::with('kelasData')->get();
        $siswa = Siswa::orderBy('created_at', 'desc')->orderBy('updated_at', 'desc')->get();
        return view('kepsek.siswa.index', compact('siswa', 'siswas'));
    }

    public function show($id_siswa)
    {
        $siswa = Siswa::where('id_siswa', $id_siswa)->firstOrFail();

        return view('kepsek.siswa.show', compact('siswa'));
    }
}
