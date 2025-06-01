<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProfilSekolah;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;


class ProfilController extends Controller
{
    public function index()
    {
        $profil = ProfilSekolah::first();
        $pengaturan = Setting::first();
        return view('admin.profil.index', compact('profil', 'pengaturan'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_sekolah'      => 'required',
            'kepala_sekolah'    => 'required',
            'npsn'              => 'required',
            'alamat_sekolah'    => 'required',
            'email'             => 'required|email',
            'website'           => 'required|url',
            'telepon'           => 'required',
            'tahun_pelajaran'   => 'required',
            'naungan'           => 'required',
            'nsm'               => 'required',
            'akreditasi'        => 'required',
            'sk'                => 'required',
            'kode_pos'          => 'required',
            'nip'               => 'required',
            'logo'              => 'nullable|image|max:5048',
            'logo_naungan'      => 'nullable|image|max:5048',
        ], [
            'nama_sekolah.required'   => 'Nama Sekolah tidak boleh kosong.',
            'kepala_sekolah.required' => 'Kepala Sekolah tidak boleh kosong.',
            'npsn.required'           => 'NPSN Sekolah tidak boleh kosong.',
            'alamat_sekolah.required' => 'Alamat Sekolah tidak boleh kosong.',
            'email.required'          => 'Email Sekolah tidak boleh kosong.',
            'website.required'        => 'Website Sekolah tidak boleh kosong.',
            'telepon.required'        => 'Telepon Sekolah tidak boleh kosong.',
            'tahun_pelajaran.required'=> 'Tahun Pelajaran tidak boleh kosong.',
            'naungan.required'        => 'Naungan tidak boleh kosong.',
            'nsm.required'            => 'NSM tidak boleh kosong.',
            'akreditasi.required'     => 'Akreditasi tidak boleh kosong.',
            'sk.required'             => 'SK tidak boleh kosong.',
            'kode_pos.required'       => 'Kode pos tidak boleh kosong.',
            'nip.required'            => 'NIP Kepala Sekolah tidak boleh kosong.',
            'logo.max'                => 'Ukuran logo sekolah tidak boleh lebih dari 5 MB',
            'logo_naungan.max'        => 'Ukuran logo sekolah tidak boleh lebih dari 5 MB'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', $validator->errors()->first());  // Flash error pesan pertama
        }

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

        if ($request->hasFile('logo_naungan')) {
            $folder = public_path('assets/img/profil-sekolah');
            $ext = $request->logo_naungan->getClientOriginalExtension();
            $filename = 'logo_naungan.' . $ext;
        
            if ($profil->logo_naungan && file_exists($folder . '/' . $profil->logo_naungan)) {
                @unlink($folder . '/' . $profil->logo_naungan);
            }
        
            $request->logo_naungan->move($folder, $filename);
            $profil->logo_naungan = $filename;
        }
        
        // Manual isi data agar lebih aman
        $profil->nama_sekolah     = $request->nama_sekolah;
        $profil->kepala_sekolah   = $request->kepala_sekolah;
        $profil->npsn             = $request->npsn;
        $profil->alamat_sekolah   = $request->alamat_sekolah;
        $profil->email            = $request->email;
        $profil->website          = $request->website;
        $profil->telepon          = $request->telepon;
        $profil->tahun_pelajaran  = $request->tahun_pelajaran;
        $profil->naungan          = $request->naungan;
        $profil->nsm              = $request->nsm;
        $profil->akreditasi       = $request->akreditasi;
        $profil->sk               = $request->sk;
        $profil->kode_pos         = $request->kode_pos;
        $profil->nip              = $request->nip;

        $profil->save();

        return redirect()->route('admin.profil')->with('success', 'Profil berhasil diperbarui!');
    }

}