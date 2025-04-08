<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Guru;
use App\Models\ProfilSekolah;
use App\Models\Siswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Pastikan hanya user yang login bisa mengakses
    }

    
    public function index()
    {
        $namaSekolah = ProfilSekolah::first()->nama_sekolah;
        $jumlahSiswaAktif = Siswa::whereIn('status', ['AKTIF', 'PINDAHAN'])->count();
        $jumlahGuru = Guru::count();
        
        return view('admin.dashboard', compact('jumlahSiswaAktif', 'jumlahGuru', 'namaSekolah'));
    }
}
