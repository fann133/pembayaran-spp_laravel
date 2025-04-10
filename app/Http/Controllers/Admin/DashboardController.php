<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Guru;
use App\Models\ProfilSekolah;
use App\Models\Siswa;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Pastikan hanya user yang login bisa mengakses
    }

    
    public function index()
    {
        $bulanNow= Carbon::now()->translatedFormat('F'); 
        $bulanIni = Carbon::now()->month;
        $tahunIni = Carbon::now()->year;

        // Dashboard Nama sekolah
        $namaSekolah = ProfilSekolah::first()->nama_sekolah;


        // Border Siswa Aktif
        $jumlahSiswaAktif = Siswa::whereIn('status', ['AKTIF', 'PINDAHAN'])->count();


        // Border Guru
        $jumlahGuru = Guru::count();


        // Border Progress
        $totalTagihan = DB::table('tagihan')
            ->whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahunIni)
            ->count();

        $totalLunas = DB::table('tagihan')
            ->where('status', 'SUDAH DIBAYAR')
            ->whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahunIni)
            ->count();

        $progress = $totalTagihan > 0
            ? round(($totalLunas / $totalTagihan) * 100, 2)
            : 0;
        

        // Border Jumlah Pemasukan 
        $totalPemasukan = DB::table('pembayaran')->sum('dibayar');


        // Bars Charts
        $pembayaranSPP = DB::table('pembayaran')
            ->select(DB::raw("MONTH(tanggal_bayar) as bulan"), DB::raw("SUM(dibayar) as total"))
            ->where('jenis', 'SPP')
            ->whereYear('tanggal_bayar', date('Y'))
            ->groupBy(DB::raw("MONTH(tanggal_bayar)"))
            ->get();

        $pembayaranNonSPP = DB::table('pembayaran')
            ->select(DB::raw("MONTH(tanggal_bayar) as bulan"), DB::raw("SUM(dibayar) as total"))
            ->where('jenis', 'NON-SPP')
            ->whereYear('tanggal_bayar', date('Y'))
            ->groupBy(DB::raw("MONTH(tanggal_bayar)"))
            ->get();

        $labels = [];
        $dataSPP = [];
        $dataNonSPP = [];

        for ($i = 1; $i <= 12; $i++) {
            $labels[] = Carbon::create()->month($i)->translatedFormat('F');

            $foundSPP = $pembayaranSPP->firstWhere('bulan', $i);
            $foundNonSPP = $pembayaranNonSPP->firstWhere('bulan', $i);

            $dataSPP[] = $foundSPP ? $foundSPP->total : 0;
            $dataNonSPP[] = $foundNonSPP ? $foundNonSPP->total : 0;
        }


        // Pie Charts
            $tagihanKelas = DB::table('tagihan')
                ->select('kelas')
                ->selectRaw("COUNT(*) as total")
                ->selectRaw("SUM(CASE WHEN status = 'BELUM DIBAYAR' THEN 1 ELSE 0 END) as belum_bayar")
                ->where('jenis', 'SPP')
                ->whereMonth('created_at', $bulanIni)
                ->whereYear('created_at', $tahunIni)
                ->groupBy('kelas')
                ->get();

            $dataPie = $tagihanKelas->map(function ($item) {
                return [
                    'kelas' => $item->kelas ?? 'Tanpa Kelas',
                    'belum_bayar' => (int) $item->belum_bayar
                ];
            });

            $kelasData = $dataPie->pluck('kelas'); // label
            $jumlahBelumBayar = $dataPie->pluck('belum');

        return view('admin.dashboard', [
            // Border
            'namaSekolah'      => $namaSekolah,
            'jumlahSiswaAktif' => $jumlahSiswaAktif,
            'jumlahGuru'       => $jumlahGuru,
            'progress'         => $progress,
            'bulanNow'         => $bulanNow,
            'totalPemasukan'   => $totalPemasukan,

            // Bars Charts
            'labels'           => $labels,
            'dataSPP'          => $dataSPP,
            'dataNonSPP'       => $dataNonSPP,
            
            // Pie Charts
            'dataPie'          => $dataPie,
            'kelasData'        => $kelasData,
            'jumlahBelumBayar' => $jumlahBelumBayar
        ]);        
    }
}
