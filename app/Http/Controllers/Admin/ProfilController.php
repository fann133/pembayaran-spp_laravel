<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProfilSekolah;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function index()
    {
        $profil = ProfilSekolah::first();
        return view('admin.profil.index', compact('profil'));
    }

    public function update(Request $request)
{
    $request->validate([
        'nama_sekolah' => 'required',
        'kepala_sekolah' => 'required',
        'npsn' => 'nullable',
        'alamat_sekolah' => 'required',
        'email' => 'nullable|email',
        'website' => 'nullable|url',
        'telepon' => 'nullable',
        'tahun_pelajaran' => 'required',
        'logo' => 'nullable|image|max:2048',
    ]);

    $profil = ProfilSekolah::first();

    if (!$profil) {
        $profil = new ProfilSekolah();
        $profil->id_profil = (string) Str::uuid();
    }

    if ($request->hasFile('logo')) {
        $folder = public_path('assets/img/profil-sekolah');
    
        // Cari logo terakhir
        $files = glob($folder . '/logo*.{jpg,jpeg,png,gif}', GLOB_BRACE);
        $max = 0;
    
        foreach ($files as $file) {
            if (preg_match('/logo(\d+)\./', basename($file), $matches)) {
                $num = (int) $matches[1];
                if ($num > $max) {
                    $max = $num;
                }
            }
        }
    
        $nextNumber = $max + 1;
        $ext = $request->logo->getClientOriginalExtension();
        $filename = 'logo' . $nextNumber . '.' . $ext;
    
        // Hapus logo lama
        if ($profil->logo && file_exists($folder . '/' . $profil->logo)) {
            @unlink($folder . '/' . $profil->logo);
        }
    
        // Simpan logo baru
        $request->logo->move($folder, $filename);
        $profil->logo = $filename;
    }
    
    // Manual isi data agar lebih aman
    $profil->nama_sekolah = $request->nama_sekolah;
    $profil->kepala_sekolah = $request->kepala_sekolah;
    $profil->npsn = $request->npsn;
    $profil->alamat_sekolah = $request->alamat_sekolah;
    $profil->email = $request->email;
    $profil->website = $request->website;
    $profil->telepon = $request->telepon;
    $profil->tahun_pelajaran = $request->tahun_pelajaran;

    $profil->save();

    return back()->with('success', 'Profil sekolah berhasil diperbarui.');
}



}

