<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class AplikasiController extends Controller
{
    public function index()
    {
        $pengaturan = Setting::first(); // Ambil baris pertama

        return view('admin.pengaturan.index', compact('pengaturan'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_aplikasi' => 'required',
            'ikon_sidebar' => 'required',
            'warna_sidebar' => 'required',
            'footer' => 'required',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $setting = Setting::first();

        if ($request->hasFile('logo')) {
            $request->file('logo')->storeAs('public/logo-login', 'logo.png');
            $setting->logo = 'assets/img/logo-login/logo.png';
        }

        $setting->nama_aplikasi = $request->nama_aplikasi;
        $setting->ikon_sidebar = $request->ikon_sidebar;
        $setting->warna_sidebar = $request->warna_sidebar;
        $setting->footer = $request->footer;
        $setting->save();

        return redirect()->route('admin.pengaturan')->with('success', 'Pengaturan berhasil diperbarui!');
    }
}

