<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Pastikan hanya user yang login bisa mengakses
    }

    
    public function index()
    {
        $jumlahSiswaAktif = Siswa::where('status', 'AKTIF')->count();
        
        return view('dashboard', compact('jumlahSiswaAktif'));
    }
}
