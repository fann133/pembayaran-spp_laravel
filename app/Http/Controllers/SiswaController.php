<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa; // Pastikan model Siswa diimpor
use App\Models\User; // Pastikan model User diimpor
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::orderBy('created_at', 'desc')->orderBy('updated_at', 'desc')->get();
        return view('siswa.index', compact('siswa'));
    }

    // Tambah Siswa
    public function create()
    {
        return view('siswa.create'); // Menampilkan form tambah siswa
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|unique:siswas,nis',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'kelas' => 'required|string',
            'category' => 'required|in:atas,menengah,bawah',
            'status' => 'required|in:AKTIF,LULUS,PINDAHAN,KELUAR',
        ]);

        Siswa::create([
            'id_siswa' => Str::uuid(), // Generate UUID otomatis
            'nama' => $request->nama,
            'nis' => $request->nis,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'kelas' => $request->kelas,
            'category' => $request->category,
            'status' => $request->status,
        ]);
        
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan!');
    }


    // Ubah Siswa
    public function edit($id)
    {
        
        $siswa = Siswa::findOrFail($id);
        return view('siswa.edit', compact('siswa'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->update([
            'nama' => $request->nama,
            'nis' => $request->nis,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'kelas' => $request->kelas,
            'category' => $request->category,
            'status' => $request->status,
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui');
    }


    // Hapus Siswa
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete(); // Ini otomatis akan menghapus user karena foreign key CASCADE

        return redirect()->route('siswa.index')->with('success', 'Siswa dan user terkait berhasil dihapus.');
    }



    // create account siswa
    public function createAccount($id_siswa)
    {
        // Cari data siswa berdasarkan ID
        $siswa = Siswa::findOrFail($id_siswa);

        // Cek apakah user dengan username NIS sudah ada
        if (User::where('username', $siswa->nis)->exists()) {
            return redirect()->back()->with('error', 'Akun sudah dibuat sebelumnya!');
        }

        // Generate password random (8 karakter)
        $randomPassword = mt_rand(10000, 99999);

        // Buat akun di tabel users
        $user = User::create([
            'id_users' => Str::uuid(), // UUID untuk primary key
            'name' => $siswa->nama,
            'username' => $siswa->nis, // Username diambil dari NIS
            'password' => Hash::make($randomPassword),
            'bypass' => $randomPassword, // Simpan password asli (opsional)
            'role_id' => 2, // Role ID untuk siswa
        ]);

        // Update `users_id` di tabel siswas
        $siswa->update(['users_id' => $user->id_users]);

        return redirect()->back()->with('success', 'Akun berhasil dibuat! Password: ' . $randomPassword);
    }


}
