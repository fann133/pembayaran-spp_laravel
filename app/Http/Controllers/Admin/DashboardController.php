<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Guru;
use App\Models\ProfilSekolah;
use App\Models\Siswa;
use App\Models\Tagihan;
use App\Models\Pembayaran;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Pastikan hanya user yang login bisa mengakses
    }

    
    public function index(Request $request)
    {
        $bulanNow = Carbon::now()->translatedFormat('F'); 
        $namaSekolah = ProfilSekolah::first()->nama_sekolah ?? 'Nama Sekolah';

        $bulanDipilih = $request->input('bulan', now()->format('m'));
        $tahunDipilih = $request->input('tahun', now()->format('Y'));
        $tanggal = Carbon::now()->format('Y-m-d');

        $totalSiswa = Siswa::whereIn('status', ['AKTIF', 'PINDAHAN'])->count();
        $jumlahSiswaAktif = $totalSiswa;
        $jumlahGuru = Guru::count();

        $daftarBulan = Pembayaran::select(DB::raw('DISTINCT MONTH(tanggal_bayar) as bulan'))
            ->whereNotNull('tanggal_bayar')
            ->orderBy('bulan', 'asc')
            ->pluck('bulan');

        $tahunList = Pembayaran::selectRaw('YEAR(tanggal_bayar) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        // Ini data tagihan untuk progress
        $totalTagihan = Tagihan::whereMonth('tanggal_tagihan', $bulanDipilih)
            ->whereYear('tanggal_tagihan', $tahunDipilih)
            ->count();

        $sudahBayarTagihan = Tagihan::whereMonth('tanggal_tagihan', $bulanDipilih)
            ->whereYear('tanggal_tagihan', $tahunDipilih)
            ->where('status', 'SUDAH DIBAYAR')
            ->count();

        $progress = $totalTagihan > 0 ? round(($sudahBayarTagihan / $totalTagihan) * 100, 2) : 0;

        $totalPemasukanBulanIni = Pembayaran::whereIn('status', ['LUNAS', 'BELUM LUNAS'])
            ->whereIn('jenis', ['SPP', 'NON-SPP'])
            ->whereMonth('tanggal_bayar', $bulanDipilih)
            ->whereYear('tanggal_bayar', $tahunDipilih)
            ->sum('dibayar');

        $pembayaranSPP = Pembayaran::selectRaw('MONTH(tanggal_bayar) as bulan, SUM(dibayar) as total')
            ->where('jenis', 'SPP')
            ->whereYear('tanggal_bayar', $tahunDipilih)
            ->groupByRaw('MONTH(tanggal_bayar)')
            ->get();

        $pembayaranNonSPP = Pembayaran::selectRaw('MONTH(tanggal_bayar) as bulan, SUM(dibayar) as total')
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

            $dataSPP[] = $foundSPP ? $foundSPP->total : 0;
            $dataNonSPP[] = $foundNonSPP ? $foundNonSPP->total : 0;
        }

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

        $kelasData = $dataPie->pluck('kelas');
        $jumlahBelumBayar = $dataPie->pluck('belum_bayar');

        $pengaturan = Setting::first();


        return view('admin.dashboard', [
            'namaSekolah'               => $namaSekolah,
            'jumlahSiswaAktif'          => $jumlahSiswaAktif,
            'jumlahGuru'                => $jumlahGuru,
            'progress'                  => $progress,
            'bulanNow'                  => $bulanNow,
            'totalPemasukanBulanIni'    => $totalPemasukanBulanIni,
            'daftarBulan'               => $daftarBulan,
            'bulanDipilih'              => $bulanDipilih,
            'tahunDipilih'              => $tahunDipilih,
            'sudahBayarTagihan'         => $sudahBayarTagihan,
            'totalTagihan'              => $totalTagihan,
            'labels'                    => $labels,
            'dataSPP'                   => $dataSPP,
            'dataNonSPP'                => $dataNonSPP,
            'tahunList'                 => $tahunList,
            'dataPie'                   => $dataPie,
            'kelasData'                 => $kelasData,
            'jumlahBelumBayar'          => $jumlahBelumBayar,
            'pengaturan'                => $pengaturan
        ]);
    }
}