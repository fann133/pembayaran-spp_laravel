<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class GuruController extends Controller
{
    // Table Guru
    public function index()
    {
        $pengaturan = Setting::first();
        $guru = Guru::orderBy('created_at', 'desc')->orderBy('updated_at', 'desc')->get();
        return view('admin.guru.index', compact('guru', 'pengaturan'));
    }

    // Halaman Tambah Guru
    public function create()
    {
        $pengaturan = Setting::first();
        return view('admin.guru.create', compact('pengaturan'));
    }

    // Sistem Tambah Guru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'          => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'nip'           => 'required|string|max:255|regex:/^[0-9]+$/|unique:gurus',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir'  => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'tanggal_lahir' => 'required|date',
            'agama'         => 'required|string|max:50',
            'status'        => 'required|in:TETAP,HONOR,MAGANG',
            'role_id'       => 'required|in:3,4,5',
        ], [
            'nama.required'          => 'Nama tidak boleh kosong.',
            'nama.regex'             => 'Nama hanya boleh berisi huruf.',
            'nip.required'           => 'NIP tidak boleh kosong.',
            'nip.unique'             => 'NIP sudah digunakan.',
            'nip.regex'              => 'NIP hanya boleh berisi angka.',
            'tempat_lahir.required'  => 'Tempat lahir tidak boleh kosong.',
            'tempat_lahir.regex'     => 'Tempat lahir hanya boleh berisi huruf.',
            'tanggal_lahir.required' => 'Tanggal lahir tidak boleh kosong.',
            'tanggal_lahir.date'     => 'Format tanggal lahir tidak valid.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in'       => 'Jenis kelamin tidak valid.',
            'agama.required'         => 'Agama wajib dipilih.',
            'status.required'        => 'Status wajib dipilih.',
            'status.in'              => 'Status tidak valid.',
            'role_id.required'       => 'Jabatan wajib dipilih.',
            'role_id.in'             => 'Role tidak valid.',
        ]);

         if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', $validator->errors()->first()); // tampilkan error flash
        }
        Guru::create([
            'id_guru'       => Str::uuid(), // Generate UUID untuk id_guru
            'nip'           => $request->nip,
            'nama'          => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir'  => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama'         => $request->agama,
            'status'        => $request->status,
            'role_id'       => $request->role_id,
        ]);

        return redirect()->route('admin.guru.index')->with('success', 'Data Guru berhasil ditambahkan.');
    }

    // Halaman Ubah Guru
    public function edit($id)
    {
        $pengaturan = Setting::first();
        $guru = Guru::findOrFail($id);
        return view('admin.guru.edit', compact('guru', 'pengaturan'));
    }

    // Sistem Ubah Guru
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama'          => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'nip'           => 'required|max:255|regex:/^[0-9]+$/|unique:gurus,nip,' . $id . ',id_guru',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir'  => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'tanggal_lahir' => 'required|date',
            'agama'         => 'required|string|max:255',
            'status'        => 'required|in:TETAP,HONOR,MAGANG',
            'role_id'       => 'required|in:3,4,5',
        ], [
            'nama.required'          => 'Nama wajib diisi.',
            'nama.regex'             => 'Nama hanya boleh berisi huruf.',
            'nip.required'           => 'NIP wajib diisi.',
            'nip.unique'             => 'NIP sudah digunakan.',
            'nip.regex'              => 'NIP hanya boleh berisi angka.',
            'tempat_lahir.required'  => 'Tempat lahir wajib diisi.',
            'tempat_lahir.regex'     => 'Tempat lahir hanya boleh berisi huruf.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in'       => 'Jenis kelamin tidak valid.',
            'tempat_lahir.required'  => 'Tempat lahir wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date'     => 'Format tanggal lahir tidak valid.',
            'agama.required'         => 'Agama wajib diisi.',
            'status.required'        => 'Status wajib dipilih.',
            'status.in'              => 'Status tidak valid.',
            'role_id.required'       => 'Role wajib dipilih.',
            'role_id.in'             => 'Role tidak valid.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', $validator->errors()->first()); // tampilkan error flash
        }

        $guru = Guru::findOrFail($id);
        $guru->update($request->all());
        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function createAccount($id_guru)
    {
        // Cari data guru berdasarkan ID
        $guru = Guru::findOrFail($id_guru);

        // Cek apakah user dengan username NIP sudah ada
        if (User::where('username', $guru->nip)->exists()) {
            return redirect()->back()->with('error', 'Akun sudah dibuat sebelumnya!');
        }

        // Generate password random (5 karakter)
        $randomPassword = mt_rand(10000, 99999);

        // Buat akun di tabel users
        $user = User::create([
            'id_users'  => Str::uuid(), // UUID untuk primary key
            'name'      => $guru->nama,
            'username'  => $guru->nip, // Username diambil dari NIP
            'password'  => Hash::make($randomPassword),
            'bypass'    => $randomPassword, // Simpan password asli (opsional)
            'role_id'   => $guru->role_id, // Role ID untuk guru
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
        return redirect()->route('admin.guru.index')->with('success', 'Guru dan User terkait berhasil dihapus.');
    }

}
