<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Biaya;
use App\Models\Setting;
use Illuminate\Support\Facades\Validator;

class BiayaController extends Controller
{
    public function index(Request $request)
    {
        $pengaturan = Setting::first();
        $kategori = $request->input('kategori'); // Ambil kategori dari request
        $query = Biaya::query();
        
        if ($kategori) {
            $query->where('kategori', $kategori);
        }

        return view('bendahara.biaya.index', [
            'biayaList'         => $query->get(),
            'kategoriTerpilih'  => $kategori,
            'pengaturan'        => $pengaturan
        ]);
    }

    public function create()
    {
        $pengaturan = Setting::first();
        return view('bendahara.biaya.create', compact('pengaturan'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'jumlah' => preg_replace('/[^\d]/', '', $request->jumlah)
        ]);

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'jenis' => 'required|in:SPP,NON-SPP',
            'kode' => 'required|string|max:50|unique:biaya,kode',
            'deskripsi' => 'nullable|string',
            'jumlah' => 'required|string',
            'status' => 'required|in:AKTIF,NON AKTIF', 
            'kategori' => 'required|in:Atas,Menengah,Bawah',
        ],[
            'nama.required'     => 'Nama Biaya wajib diisi.',
            'kode.required'     => 'Kode Biaya wajib diisi.',
            'kode.unique'       => 'Kode biaya sudah digunakan.',
            'jenis.required'    => 'Jenis biaya wajib diisi.',
            'jenis.in'          => 'Jenis biaya tidak valid.',
            'jumlah.required'   => 'Jumlah wajib diisi.',
            'jumlah.numeric'    => 'Jumlah harus berupa angka.',
            'status.required'   => 'Status wajib dipilih.',
            'status.in'         => 'Status tidak valid.',
            'kategori.required' => 'Kategori wajib dipilih.',
            'kategori.in'       => 'Kategori tidak valid.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', $validator->errors()->first()); // tampilkan error flash
        }

        $jumlah = str_replace('.', '', $request->jumlah);

        Biaya::create([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'kode' => $request->kode,
            'deskripsi' => $request->deskripsi,
            'jumlah' => $jumlah,
            'status' => $request->status,
            'kategori' => $request->kategori,
        ]);

        return redirect()->route('bendahara.biaya.index')->with('success', 'Biaya berhasil ditambahkan.');
    }



    public function edit($id)
    {
        $pengaturan = Setting::first();
        $biaya = Biaya::findOrFail($id);
        return view('bendahara.biaya.edit', compact('biaya', 'pengaturan'));
    }


    public function update(Request $request, $id)
    {
        $request->merge([
            'jumlah' => preg_replace('/[^\d]/', '', $request->jumlah)
        ]);
        
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'jenis' => 'required|in:SPP,NON-SPP',
            'kode' => 'required|string|max:50|unique:biaya,kode,'.$id.',id_biaya',
            'deskripsi' => 'nullable|string',
            'jumlah' => 'required|numeric',
            'status' => 'required|in:AKTIF,NON AKTIF',
            'kategori' => 'required|in:Atas,Menengah,Bawah',
        ],[
            'nama.required'     => 'Nama Biaya wajib diisi.',
            'kode.required'     => 'Kode Biaya wajib diisi.',
            'kode.unique'       => 'Kode biaya sudah digunakan.',
            'jenis.required'    => 'Jenis biaya wajib diisi.',
            'jenis.in'          => 'Jenis biaya tidak valid.',
            'jumlah.required'   => 'Jumlah wajib diisi.',
            'jumlah.numeric'    => 'Jumlah harus berupa angka.',
            'status.required'   => 'Status wajib dipilih.',
            'status.in'         => 'Status tidak valid.',
            'kategori.required' => 'Kategori wajib dipilih.',
            'kategori.in'       => 'Kategori tidak valid.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', $validator->errors()->first());
        }

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

        return redirect()->route('bendahara.biaya.index')->with('success', 'Data Biaya berhasil diperbarui.');
    }

    public function destroy($id_biaya)
    {
        $biaya = Biaya::findOrFail($id_biaya);
        $biaya->delete();

        return redirect()->route('bendahara.biaya.index')
            ->with('success', 'Biaya berhasil dihapus.');
    }

}
