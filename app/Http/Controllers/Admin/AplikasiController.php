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
        $validator = \Validator::make($request->all(), [
            'nama_aplikasi' => 'required|max:30',
            'ikon_sidebar' => 'required',
            'tema' => 'required',
            'footer' => 'required',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ], [
            'nama_aplikasi.required' => 'Nama Aplikasi tidak boleh kosong.',
            'nama_aplikasi.max'      => 'Nama aplikasi maksimal 30 karakter.',
            'ikon_sidebar'           => 'Ikon Sidebar tidak boleh kosong.',
            'tema.required'          => 'Tema tidak boleh kosong.',
            'footer.required'        => 'Footer tidak boleh kosong.',
            'logo.image'             => 'File logo harus berupa gambar.',
            'logo.mimes'             => 'Logo harus berekstensi PNG, JPG, atau JPEG.',
            'logo.max'               => 'Ukuran logo maksimal 2MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', $validator->errors()->first());  // Flash error pesan pertama
        }

        $setting = Setting::first();

        if ($request->hasFile('logo')) {
            $request->file('logo')->storeAs('public/logo-login', 'logo.png');
            $setting->logo = 'assets/img/logo-login/logo.png';
        }

        // Pastikan ikon_sidebar disimpan lowercase
        $setting->nama_aplikasi = $request->nama_aplikasi;
        $setting->ikon_sidebar = strtolower($request->ikon_sidebar);
        $setting->tema = $request->tema;
        $setting->footer = $request->footer;
        $setting->save();

        return redirect()->route('admin.pengaturan')->with('success', 'Pengaturan berhasil diperbarui!');
    }
}

