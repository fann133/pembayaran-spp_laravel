<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Biaya;

class BiayaController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->input('kategori'); // Ambil kategori dari request

        $query = Biaya::query();
        
        if ($kategori) {
            $query->where('kategori', $kategori);
        }

        return view('admin.biaya.index', [
            'biayaList' => $query->get(),
            'kategoriTerpilih' => $kategori,
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



    public function edit($id)
    {
        $biaya = Biaya::findOrFail($id);
        return view('admin.biaya.edit', compact('biaya'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|in:SPP,NON-SPP',
            'kode' => 'required|string|max:50|unique:biaya,kode,'.$id.',id_biaya',
            'deskripsi' => 'nullable|string',
            'jumlah' => 'required|numeric',
            'status' => 'required|in:AKTIF,NON AKTIF',
            'kategori' => 'required|in:Atas,Menengah,Bawah',
        ]);

        $biaya = Biaya::findOrFail($id);
        $biaya->update([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'kode' => $request->kode,
            'deskripsi' => $request->deskripsi,
            'jumlah' => $request->jumlah,
            'status' => $request->status,
            'kategori' => $request->kategori,
        ]);

        return redirect()->route('admin.biaya.index')->with('success', 'Data Biaya berhasil diperbarui.');
    }

    public function destroy($id_biaya)
    {
        $biaya = Biaya::findOrFail($id_biaya);
        $biaya->delete();

        return redirect()->route('admin.biaya.index')
            ->with('success', 'Biaya berhasil dihapus.');
    }

}
