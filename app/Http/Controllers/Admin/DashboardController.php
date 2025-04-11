<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Guru;
use App\Models\ProfilSekolah;
use App\Models\Siswa;
use App\Models\Tagihan;
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


        // Borders Guru
        $jumlahGuru = Guru::count();

        // Ambil semua bulan & tahun dari tanggal_bayar
        $daftarBulan = Pembayaran::select(DB::raw('DISTINCT MONTH(tanggal_bayar) as bulan'))
        ->whereNotNull('tanggal_bayar')
        ->orderBy('bulan', 'asc')
        ->pluck('bulan');

        $daftarTahun = Pembayaran::select(DB::raw('DISTINCT YEAR(tanggal_bayar) as tahun'))
        ->whereNotNull('tanggal_bayar')
        ->orderBy('tahun', 'desc')
        ->pluck('tahun');

        // Ambil bulan dan tahun yang dipilih (atau default ke sekarang)
        $bulanDipilih = request('bulan') ?? now()->format('m');
        $tahunDipilih = request('tahun') ?? now()->format('Y');



        // Borders Progress
        $totalSiswa = Siswa::whereIn('status', ['AKTIF', 'PINDAHAN'])->count();
        $sudahBayar = Pembayaran::whereIn('jenis', ['SPP', 'NON-SPP'])
        ->whereMonth('tanggal_bayar', $bulanDipilih)
        ->whereYear('tanggal_bayar', $tahunDipilih)
        ->distinct('id_siswa')
        ->count('id_siswa');

        $progress = $totalSiswa > 0 ? round(($sudahBayar / $totalSiswa) * 100, 2) : 0;

        // Borders Jumlah pemasukan
        $totalPemasukanBulanIni = Pembayaran::whereIn('status', ['LUNAS', 'BELUM LUNAS'])
        ->whereIn('jenis', ['SPP', 'NON-SPP'])
        ->whereMonth('tanggal_bayar', $bulanDipilih)
        ->whereYear('tanggal_bayar', $tahunDipilih)
        ->sum('dibayar');


        // Bars Charts
        $pembayaranSPP = Pembayaran::selectRaw('MONTH(tanggal_bayar) as bulan, SUM(dibayar) as total')
            ->where('jenis', 'SPP')
            ->whereYear('tanggal_bayar', date('Y'))
            ->groupByRaw('MONTH(tanggal_bayar)')
            ->get();

        $pembayaranNonSPP = Pembayaran::selectRaw('MONTH(tanggal_bayar) as bulan, SUM(dibayar) as total')
            ->where('jenis', 'NON-SPP')
            ->whereYear('tanggal_bayar', date('Y'))
            ->groupByRaw('MONTH(tanggal_bayar)')
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
        $tagihanKelas = Tagihan::select('kelas')
            ->selectRaw("COUNT(*) as total")
            ->selectRaw("SUM(CASE WHEN status = 'BELUM DIBAYAR' THEN 1 ELSE 0 END) as belum_bayar")
            ->where('jenis', 'SPP')
            ->whereMonth('tanggal_tagihan', $bulanDipilih)
            ->whereYear('tanggal_tagihan', $tahunDipilih)
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
            'totalPemasukanBulanIni' => $totalPemasukanBulanIni,
            'daftarBulan'      => $daftarBulan,
            'bulanDipilih'     => $bulanDipilih,
            'daftarTahun'      => $daftarTahun,
            'tahunDipilih'     => $tahunDipilih,

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
