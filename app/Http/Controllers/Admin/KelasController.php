<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Support\Str;

class KelasController extends Controller
{
    public function index()
    {
        $gurus = Guru::all();
        $kelas = Kelas::all();
        return view('admin.kelas.index', compact('kelas', 'gurus'));
    }

    public function create()
    {
        $gurus = Guru::all();
        return view('admin.kelas.create', compact('gurus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kode_kelas' => 'required|string|max:255|unique:kelas,kode_kelas',
            'deskripsi' => 'nullable|string',
            'pengampu_kelas' => 'required|exists:gurus,id_guru|unique:kelas,pengampu_kelas',
        ], [
            'pengampu_kelas.unique' => 'Guru ini sudah mengampu kelas lain!',
        ]);

        Kelas::create([
            'id_kelas' => Str::uuid(),
            'nama' => $request->nama,
            'kode_kelas' => $request->kode_kelas,
            'deskripsi' => $request->deskripsi,
            'pengampu_kelas' => $request->pengampu_kelas,
        ]);

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil ditambahkan!');
    }

    public function show($id_kelas)
    {
        $kelas = Kelas::with('guruPengampu')->findOrFail($id_kelas);
        
        // Ambil semua siswa yang ada di kelas ini
        $siswa = Siswa::where('kelas', $kelas->id_kelas)->get();

        return view('admin.kelas.show', compact('kelas', 'siswa'));
    }


    public function edit($id_kelas)
    {
        $kelas = Kelas::findOrFail($id_kelas);
        $gurus = Guru::all(); // Ambil semua guru untuk dropdown pengampu kelas

        return view('admin.kelas.edit', compact('kelas', 'gurus'));
    }

    public function update(Request $request, $id_kelas)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kode_kelas' => 'required|string|max:50',
            'pengampu_kelas' => 'nullable|exists:gurus,id_guru',
            'deskripsi' => 'nullable|string',
        ]);

        $kelas = Kelas::findOrFail($id_kelas);
        $kelas->update([
            'nama' => $request->nama,
            'kode_kelas' => $request->kode_kelas,
            'pengampu_kelas' => $request->pengampu_kelas,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil diperbarui');
    }


}
