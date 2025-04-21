<?php

namespace App\Http\Controllers\Guru;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Tagihan;
use App\Models\Pembayaran;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Pastikan hanya user yang login bisa mengakses
    }

    public function index()
    {
        $user = Auth::user();

        $guru = Guru::where('users_id', $user->id_users)->first();
        if (!$guru) {
            return redirect()->back()->with('error', 'Data guru tidak ditemukan.');
        }

        // Ambil semua kelas yang diampu
        $kelasDiampu = Kelas::where('pengampu_kelas', $guru->id_guru)->pluck('nama');

        // --- Pemasukan Bulan Ini ---
        $bulanIni = Carbon::now()->format('m');
        $tahunIni = Carbon::now()->format('Y');

        $pemasukanBulanIni = Pembayaran::whereIn('kelas', $kelasDiampu)
            ->whereMonth('tanggal_bayar', $bulanIni)
            ->whereYear('tanggal_bayar', $tahunIni)
            ->sum('dibayar');

        // (Tambahan sebelumnya)
        $idKelasDiampu = Kelas::where('pengampu_kelas', $guru->id_guru)->pluck('id_kelas');

        $jumlahSiswa = Siswa::whereIn('id_kelas', $idKelasDiampu)
            ->whereIn('status', ['AKTIF', 'PINDAHAN'])
            ->count();

        $jumlahTagihan = Tagihan::whereIn('kelas', $kelasDiampu)
            ->where('status', 'BELUM DIBAYAR')
            ->count();

        $totalTagihan = Tagihan::whereIn('kelas', $kelasDiampu)->count();
        $tagihanLunas = Tagihan::whereIn('kelas', $kelasDiampu)->where('status', 'SUDAH DIBAYAR')->count();
        $progress = $totalTagihan > 0 ? round(($tagihanLunas / $totalTagihan) * 100, 2) : 0;

        return view('guru.dashboard', compact(
            'guru',
            'jumlahSiswa',
            'jumlahTagihan',
            'progress',
            'pemasukanBulanIni'
        ));
    }

}
