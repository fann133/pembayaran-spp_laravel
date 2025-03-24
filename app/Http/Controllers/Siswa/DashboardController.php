<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller; // Jangan lupa tambahkan ini
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Pastikan hanya user yang login bisa mengakses
    }

    public function index()
    {
        return view('siswa.dashboard'); // Pastikan view ada di resources/views/siswa/dashboard.blade.php
    }
}
