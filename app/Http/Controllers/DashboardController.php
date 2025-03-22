<?php

namespace App\Http\Controllers;

use App\Models\Guru;
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
        $jumlahSiswaAktif = Siswa::whereIn('status', ['AKTIF', 'PINDAHAN'])->count();
        $jumlahGuru = Guru::count();
        
        return view('dashboard', compact('jumlahSiswaAktif', 'jumlahGuru'));
    }
}
