<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    public function index()
    {
        $gurus = Guru::all();
        $kelas = Kelas::all();
        $pengaturan = Setting::first();
        return view('admin.kelas.index', compact('kelas', 'gurus', 'pengaturan'));
    }

    public function create()
    {
        $gurus = Guru::all();
        $pengaturan = Setting::first();
        return view('admin.kelas.create', compact('gurus', 'pengaturan'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'           => 'required|string|max:255',
            'kode_kelas'     => 'required|string|max:255|unique:kelas,kode_kelas',
            'deskripsi'      => 'nullable|string',
            'pengampu_kelas' => 'nullable|exists:gurus,id_guru|unique:kelas,pengampu_kelas',
        ], [
            'nama.required'           => 'Nama kelas tidak boleh kosong.',
            'nama.string'             => 'Nama kelas harus berupa teks.',
            'nama.max'                => 'Nama kelas maksimal 255 karakter.',
            'kode_kelas.required'     => 'Kode kelas tidak boleh kosong.',
            'kode_kelas.string'       => 'Kode kelas harus berupa teks.',
            'kode_kelas.max'          => 'Kode kelas maksimal 255 karakter.',
            'kode_kelas.unique'       => 'Kode kelas sudah digunakan.',
            'deskripsi.string'        => 'Deskripsi harus berupa teks.',
            'pengampu_kelas.exists'   => 'Guru pengampu tidak ditemukan.',
            'pengampu_kelas.unique'   => 'Guru ini sudah mengampu kelas lain!',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', $validator->errors()->first()); // tampilkan error flash
        }

        Kelas::create([
            'id_kelas'       => Str::uuid(),
            'nama'           => $request->nama,
            'kode_kelas'     => $request->kode_kelas,
            'deskripsi'      => $request->deskripsi,
            'pengampu_kelas' => $request->pengampu_kelas,
        ]);

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil ditambahkan!');
    }

    public function show($id_kelas)
    {
        $kelas = Kelas::with('guruPengampu')->findOrFail($id_kelas);
        $pengaturan = Setting::first();
        $siswa = Siswa::where('id_kelas', $kelas->id_kelas)->get();
        return view('admin.kelas.show', compact('kelas', 'siswa', 'pengaturan'));
    }


    public function edit($id_kelas)
    {
        $kelas = Kelas::findOrFail($id_kelas);
        $gurus = Guru::all(); // Ambil semua guru untuk dropdown pengampu kelas
        $pengaturan = Setting::first();
        return view('admin.kelas.edit', compact('kelas', 'gurus', 'pengaturan'));
    }

    public function update(Request $request, $id_kelas)
    {
        $validator = Validator::make($request->all(), [
            'nama'           => 'required|string|max:255',
            'kode_kelas'     => 'required|string|max:255|unique:kelas,kode_kelas,' . $id_kelas . ',id_kelas',
            'pengampu_kelas' => 'nullable|exists:gurus,id_guru',
            'deskripsi'      => 'nullable|string',
        ], [
            'nama.required'           => 'Nama kelas wajib diisi.',
            'nama.string'             => 'Nama kelas harus berupa teks.',
            'nama.max'                => 'Nama kelas maksimal 255 karakter.',
            'kode_kelas.required'     => 'Kode kelas wajib diisi.',
            'kode_kelas.string'       => 'Kode kelas harus berupa teks.',
            'kode_kelas.max'          => 'Kode kelas maksimal 50 karakter.',
            'kode_kelas.unique'       => 'Kode kelas sudah digunakan.',
            'pengampu_kelas.exists'   => 'Guru pengampu tidak ditemukan.',
            'deskripsi.string'        => 'Deskripsi harus berupa teks.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', $validator->errors()->first()); // tampilkan error flash
        }

        $kelas = Kelas::findOrFail($id_kelas);
        $kelas->update([
            'nama'           => $request->nama,
            'kode_kelas'     => $request->kode_kelas,
            'pengampu_kelas' => $request->pengampu_kelas,
            'deskripsi'      => $request->deskripsi,
        ]);

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil diperbarui');
    }

    public function destroy($id_kelas)
    {
        $kelas = Kelas::findOrFail($id_kelas);
        $kelas->delete();

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil dihapus.');
    }
}
