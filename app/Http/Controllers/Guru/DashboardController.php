<?php

namespace App\Http\Controllers\Guru;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProfilSekolah;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Tagihan;
use App\Models\Pembayaran;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Pastikan hanya user yang login bisa mengakses
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $guru = Guru::where('users_id', $user->id_users)->first();

        if (!$guru) {
            return redirect()->back()->with('error', 'Data guru tidak ditemukan.');
        }

        $namaSekolah = ProfilSekolah::first()?->nama_sekolah ?? 'Nama Sekolah';

        // Kelas yang diampu oleh guru sebagai wali kelas
        $kelasDiampu = Kelas::where('pengampu_kelas', $guru->id_guru)->pluck('nama');
        $idKelasDiampu = Kelas::where('pengampu_kelas', $guru->id_guru)->pluck('id_kelas');

        $bulanIni = Carbon::now()->format('m');
        $tahunIni = Carbon::now()->format('Y');

        $bulanDipilih = $request->input('bulan', $bulanIni);
        $tahunDipilih = $request->input('tahun', $tahunIni);

        // Daftar bulan & tahun untuk filter
        $daftarBulan = Pembayaran::selectRaw('DISTINCT MONTH(tanggal_bayar) as bulan')
            ->whereNotNull('tanggal_bayar')
            ->orderBy('bulan')
            ->pluck('bulan');

        $tahunList = Pembayaran::selectRaw('YEAR(tanggal_bayar) as tahun')
            ->distinct()
            ->orderByDesc('tahun')
            ->pluck('tahun');

        // Pemasukan bulan & tahun yang dipilih
        $pemasukanBulanIni = Pembayaran::whereIn('kelas', $kelasDiampu)
            ->whereMonth('tanggal_bayar', $bulanDipilih)
            ->whereYear('tanggal_bayar', $tahunDipilih)
            ->sum('dibayar');

        // Jumlah siswa aktif di kelas yang diampu
        $jumlahSiswa = Siswa::whereIn('id_kelas', $idKelasDiampu)
            ->whereIn('status', ['AKTIF', 'PINDAHAN'])
            ->count();

        // Jumlah tagihan bulan & tahun yang dipilih
        $jumlahTagihan = Tagihan::whereIn('kelas', $kelasDiampu)
            ->whereMonth('tanggal_tagihan', $bulanDipilih)
            ->whereYear('tanggal_tagihan', $tahunDipilih)
            ->where('status', 'BELUM DIBAYAR')
            ->count();

        // Progress pembayaran berdasarkan bulan & tahun
        $totalTagihan = Tagihan::whereIn('kelas', $kelasDiampu)
            ->whereMonth('tanggal_tagihan', $bulanDipilih)
            ->whereYear('tanggal_tagihan', $tahunDipilih)
            ->count();

        $tagihanLunas = Tagihan::whereIn('kelas', $kelasDiampu)
            ->whereMonth('tanggal_tagihan', $bulanDipilih)
            ->whereYear('tanggal_tagihan', $tahunDipilih)
            ->where('status', 'SUDAH DIBAYAR')
            ->count();

        $progress = $totalTagihan > 0 ? round(($tagihanLunas / $totalTagihan) * 100, 2) : 0;

        // Grafik batang: SPP & NON-SPP per bulan dalam setahun
        $pembayaranSPP = Pembayaran::selectRaw('MONTH(tanggal_bayar) as bulan, SUM(dibayar) as total')
            ->whereIn('kelas', $kelasDiampu)
            ->where('jenis', 'SPP')
            ->whereYear('tanggal_bayar', $tahunDipilih)
            ->groupByRaw('MONTH(tanggal_bayar)')
            ->get();

        $pembayaranNonSPP = Pembayaran::selectRaw('MONTH(tanggal_bayar) as bulan, SUM(dibayar) as total')
            ->whereIn('kelas', $kelasDiampu)
            ->where('jenis', 'NON-SPP')
            ->whereYear('tanggal_bayar', $tahunDipilih)
            ->groupByRaw('MONTH(tanggal_bayar)')
            ->get();

        $labels = [];
        $dataSPP = [];
        $dataNonSPP = [];

        for ($i = 1; $i <= 12; $i++) {
            $labels[] = Carbon::create()->month($i)->translatedFormat('F');
            $foundSPP = $pembayaranSPP->firstWhere('bulan', $i);
            $foundNonSPP = $pembayaranNonSPP->firstWhere('bulan', $i);
            $dataSPP[] = $foundSPP ? (int) $foundSPP->total : 0;
            $dataNonSPP[] = $foundNonSPP ? (int) $foundNonSPP->total : 0;
        }

        // Grafik pie: SPP yang belum dibayar berdasarkan kelas
        $tagihanKelas = Tagihan::select('kelas')
            ->selectRaw("COUNT(*) as total")
            ->selectRaw("SUM(CASE WHEN status = 'BELUM DIBAYAR' THEN 1 ELSE 0 END) as belum_bayar")
            ->where('jenis', 'SPP')
            ->whereMonth('tanggal_tagihan', $bulanDipilih)
            ->whereYear('tanggal_tagihan', $tahunDipilih)
            ->whereIn('kelas', $kelasDiampu)
            ->groupBy('kelas')
            ->get();

        $dataPie = $tagihanKelas->map(function ($item) {
            return [
                'kelas' => $item->kelas ?? 'Tanpa Kelas',
                'belum_bayar' => (int) $item->belum_bayar
            ];
        });

        $kelasData = $dataPie->pluck('kelas');
        $jumlahBelumBayar = $dataPie->pluck('belum_bayar');

        $pengaturan = Setting::first();

        return view('guru.dashboard', compact(
            'namaSekolah',
            'guru',
            'jumlahSiswa',
            'bulanDipilih',
            'tahunDipilih',
            'daftarBulan',
            'tahunList',
            'jumlahTagihan',
            'progress',
            'pemasukanBulanIni',
            'labels',
            'dataSPP',
            'dataNonSPP',
            'dataPie',
            'kelasData',
            'jumlahBelumBayar',
            'pengaturan'
        ));
    }


}
