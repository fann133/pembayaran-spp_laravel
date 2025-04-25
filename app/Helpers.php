<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('getDashboardRoute')) {
    function getDashboardRoute()
    {
        if (!Auth::check()) {
            return route('auth'); // Redirect ke login jika belum login
        }

        $user = Auth::user();

        switch ($user->role_id) {
            case 1:
                return route('admin.dashboard');
            case 2:
                return route('siswa.dashboard');
            case 3:
                return route('guru.dashboard');
            case 4:
                return route('bendahara.dashboard');
            case 5:
                return route('kepsek.dashboard');
            default:
                return route('auth'); // Default jika role_id tidak dikenali
        }
    }
}
