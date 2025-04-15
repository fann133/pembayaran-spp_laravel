<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Guru;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Pastikan hanya user yang login bisa mengakses
    }

    public function index()
    {
        $user = Auth::user();

        // Ambil data guru berdasarkan id_users
        $guru = Guru::where('users_id', $user->id)->first();

        return view('bendahara.dashboard', compact('guru'));
    }
}
