<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Biaya;

class BiayaController extends Controller
{
    public function index()
    {
        return view('admin.biaya.index', [
            'biayaAtas' => Biaya::where('kategori', 'Atas')->get(),
            'biayaMenengah' => Biaya::where('kategori', 'Menengah')->get(),
            'biayaBawah' => Biaya::where('kategori', 'Bawah')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.biaya.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255', // ✅ Tambah nama
            'jenis' => 'required|in:SPP,NON-SPP', // ✅ Ubah ke ENUM
            'kode' => 'required|string|max:50|unique:biaya,kode',
            'deskripsi' => 'nullable|string',
            'jumlah' => 'required|string',
            'status' => 'required|in:AKTIF,NON AKTIF', 
            'kategori' => 'required|in:Atas,Menengah,Bawah',
        ]);

        Biaya::create([
            'nama' => $request->nama, // ✅ Tambah nama
            'jenis' => $request->jenis,
            'kode' => $request->kode,
            'deskripsi' => $request->deskripsi,
            'jumlah' => $request->jumlah,
            'status' => $request->status,
            'kategori' => $request->kategori,
        ]);

        return redirect()->route('admin.biaya.index')->with('success', 'Biaya berhasil ditambahkan.');
    }


}
