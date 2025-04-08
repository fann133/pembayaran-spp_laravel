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
        
        $namaSekolah = ProfilSekolah::first()->nama_sekolah;
        $jumlahSiswaAktif = Siswa::whereIn('status', ['AKTIF', 'PINDAHAN'])->count();
        $jumlahGuru = Guru::count();
        
        return view('admin.dashboard', compact('jumlahSiswaAktif', 'jumlahGuru', 'namaSekolah', 'labels', 'dataSPP', 'dataNonSPP'));
    }
}
