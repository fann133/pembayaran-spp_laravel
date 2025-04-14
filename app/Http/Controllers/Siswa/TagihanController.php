<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tagihan;
use App\Models\Siswa;

class TagihanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:siswa']);
    }

    public function index()
    {
        $user = Auth::user();
        $siswa = Siswa::where('users_id', $user->id_users)->first();

        $tagihan = collect(); // default value

        if ($siswa) {
            $tagihan = Tagihan::where('id_siswa', $siswa->id_siswa)
                            ->where('status', 'BELUM DIBAYAR')
                            ->orderBy('created_at', 'desc')
                            ->get();
        }

        return view('siswa.tagihan.index', compact('tagihan'));
    }

    public function show($id)
    {
        $tagihan = Tagihan::findOrFail($id);

        return view('siswa.tagihan.show', compact('tagihan'));
    }
}
