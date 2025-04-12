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

    
    public function index(Request $request)
    {
        // Ambil bulan sekarang dalam format nama (contoh: April)
        $bulanNow = Carbon::now()->translatedFormat('F'); 

        // Dashboard Nama Sekolah
        $namaSekolah = ProfilSekolah::first()->nama_sekolah;

        // Ambil bulan dan tahun yang dipilih dari request, jika tidak ada default ke sekarang
        $bulanDipilih = $request->input('bulan', now()->format('m'));
        $tahunDipilih = $request->input('tahun', now()->format('Y'));

        // Ambil jumlah siswa dengan status AKTIF atau PINDAHAN
        $totalSiswa = Siswa::whereIn('status', ['AKTIF', 'PINDAHAN'])->count();
        $jumlahSiswaAktif = $totalSiswa;

        // Ambil jumlah guru
        $jumlahGuru = Guru::count();

        // Ambil daftar bulan yang ada di data pembayaran
        $daftarBulan = Pembayaran::select(DB::raw('DISTINCT MONTH(tanggal_bayar) as bulan'))
            ->whereNotNull('tanggal_bayar')
            ->orderBy('bulan', 'asc')
            ->pluck('bulan');

        // Ambil daftar tahun dari pembayaran (untuk dropdown tahun)
        $tahunList = Pembayaran::selectRaw('YEAR(tanggal_bayar) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        // Hitung jumlah siswa yang sudah membayar (SPP atau NON-SPP) di bulan & tahun dipilih
        $sudahBayar = Pembayaran::whereIn('jenis', ['SPP', 'NON-SPP'])
            ->whereMonth('tanggal_bayar', $bulanDipilih)
            ->whereYear('tanggal_bayar', $tahunDipilih)
            ->distinct('id_siswa')
            ->count('id_siswa');

        // Hitung progress pembayaran dalam bentuk persentase
        $progress = $totalSiswa > 0 ? round(($sudahBayar / $totalSiswa) * 100, 2) : 0;

        // Hitung total pemasukan dari pembayaran bulan ini (LUNAS dan BELUM LUNAS)
        $totalPemasukanBulanIni = Pembayaran::whereIn('status', ['LUNAS', 'BELUM LUNAS'])
            ->whereIn('jenis', ['SPP', 'NON-SPP'])
            ->whereMonth('tanggal_bayar', $bulanDipilih)
            ->whereYear('tanggal_bayar', $tahunDipilih)
            ->sum('dibayar');

        // Barchart: Data Pembayaran SPP dan NON-SPP per bulan (berdasarkan tahun yang dipilih)
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

        // Pie Chart: Data tagihan SPP berdasarkan kelas (jumlah belum bayar)
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

        return view('admin.dashboard', [
            // Border Cards
            'namaSekolah' => $namaSekolah,
            'jumlahSiswaAktif' => $jumlahSiswaAktif,
            'jumlahGuru' => $jumlahGuru,
            'progress' => $progress,
            'bulanNow' => $bulanNow,
            'totalPemasukanBulanIni' => $totalPemasukanBulanIni,
            'daftarBulan' => $daftarBulan,
            'bulanDipilih' => $bulanDipilih,
            'tahunDipilih' => $tahunDipilih,

            // Bar Charts
            'labels' => $labels,
            'dataSPP' => $dataSPP,
            'dataNonSPP' => $dataNonSPP,
            'tahunList' => $tahunList,

            // Pie Charts
            'dataPie' => $dataPie,
            'kelasData' => $kelasData,
            'jumlahBelumBayar' => $jumlahBelumBayar
        ]);
    }

}
