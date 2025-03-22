<?php

namespace App\Http\Controllers;
use App\Models\Guru;
use App\Models\User;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    // Table Guru
    public function index()
    {
        $guru = Guru::orderBy('created_at', 'desc')->orderBy('updated_at', 'desc')->get();
        return view('guru.index', compact('guru'));
    }

    // Halaman Tambah Guru
    public function create()
    {
        return view('guru.create');
    }

    // Sistem Tambah Guru
    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|string|max:255|unique:gurus',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|string|max:50',
            'status' => 'required|in:TETAP,HONOR,MAGANG',
            'role_id' => 'required|in:3,4,5',
        ]);

        Guru::create([
            'id_guru' => Str::uuid(), // Generate UUID untuk id_guru
            'nip' => $request->nip,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama' => $request->agama,
            'status' => $request->status,
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('guru.index')->with('success', 'Data Guru berhasil ditambahkan.');
    }


    // Halaman Ubah Guru
    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        return view('guru.edit', compact('guru'));
    }

    // Sistem Ubah Guru
    public function update(Request $request, $id)
    {
        $request->validate([
            'nip' => 'required|unique:gurus,nip,' . $id . ',id_guru',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|string|max:255',
            'status' => 'required|in:TETAP,HONOR,MAGANG',
            'role_id' => 'required|in:3,4,5',
        ]);

        $guru = Guru::findOrFail($id);
        $guru->update($request->all());

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function createAccount($id_guru)
    {
        // Cari data guru berdasarkan ID
        $guru = Guru::findOrFail($id_guru);

        // Cek apakah user dengan username NIP sudah ada
        if (User::where('username', $guru->nip)->exists()) {
            return redirect()->back()->with('error', 'Akun sudah dibuat sebelumnya!');
        }

        // Generate password random (8 karakter)
        $randomPassword = mt_rand(10000, 99999);

        // Buat akun di tabel users
        $user = User::create([
            'id_users' => Str::uuid(), // UUID untuk primary key
            'name' => $guru->nama,
            'username' => $guru->nip, // Username diambil dari NIP
            'password' => Hash::make($randomPassword),
            'bypass' => $randomPassword, // Simpan password asli (opsional)
            'role_id' => $guru->role_id, // Role ID untuk guru
        ]);

        // Update `users_id` di tabel gurus
        $guru->update(['users_id' => $user->id_users]);

        return redirect()->back()->with('success', 'Akun berhasil dibuat! Password: ' . $randomPassword);
    }


    // Hapus Siswa
    public function destroy($id)
    {
        $siswa = Guru::findOrFail($id);
        $siswa->delete(); // Ini otomatis akan menghapus user karena foreign key CASCADE

        return redirect()->route('guru.index')->with('success', 'Guru dan User terkait berhasil dihapus.');
    }

}
