<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Siswa; 
use App\Models\User;
use App\Models\Kelas;
use App\Models\Biaya;
use App\Models\Setting; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    public function index()
    {
        $pengaturan = Setting::first();
        $siswas = Siswa::with('kelasData')->get();
        $siswa = Siswa::orderBy('created_at', 'desc')->orderBy('updated_at', 'desc')->get();
        return view('bendahara.siswa.index', compact('siswa', 'siswas', 'pengaturan'));
    }

    // Tambah Siswa
    public function create()
    {
        $pengaturan = Setting::first();
        $categories = Biaya::select('kategori')->distinct()->get();
        $kelas = Kelas::all(); // Ambil semua kelas
        return view('bendahara.siswa.create', compact('kelas', 'categories', 'pengaturan'));
    }

    // Simpan data siswa baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'          => 'required|string|max:255',
            'nis'           => 'required|string|unique:siswas,nis',
            'tempat_lahir'  => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'id_kelas'      => 'required|exists:kelas,id_kelas',
            'category'      => 'required|in:Atas,Menengah,Bawah',
            'status'        => 'required|in:AKTIF,LULUS,PINDAHAN,KELUAR',
        ], [
            'nama.required'           => 'Nama tidak boleh kosong.',
            'nis.required'            => 'NIS tidak boleh kosong.',
            'nis.unique'              => 'NIS telah digunakan.',
            'tempat_lahir.required'   => 'Tempat lahir tidak boleh kosong.',
            'tanggal_lahir.required'  => 'Tanggal lahir tidak boleh kosong.',
            'tanggal_lahir.date'      => 'Format tanggal lahir tidak valid.',
            'jenis_kelamin.required'  => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in'        => 'Jenis kelamin tidak valid.',
            'id_kelas.required'       => 'Kelas wajib dipilih.',
            'id_kelas.exists'         => 'Kelas tidak ditemukan.',
            'category.required'       => 'Kategori wajib dipilih.',
            'category.in'             => 'Kategori tidak valid.',
            'status.required'         => 'Status wajib dipilih.',
            'status.in'               => 'Status tidak valid.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', $validator->errors()->first()); // tampilkan error flash
        }

        $kelas = Kelas::where('id_kelas', $request->id_kelas)->first();
        $category = Biaya::where('kategori', $request->category)->first();

        // Simpan ke tabel siswa
        Siswa::create([
            'nama'          => $request->nama,
            'nis'           => $request->nis,
            'tempat_lahir'  => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'id_kelas'      => $request->id_kelas, // Simpan ID kelas di kolom id_kelas
            'kelas'         => $kelas->nama, // Simpan nama kelas di kolom kelas
            'category'      => $category->kategori,
            'status'        => $request->status,
        ]);

        return redirect()->route('bendahara.siswa.index')->with('success', 'Siswa berhasil ditambahkan');
    }

    // Tampilan View Edit Siswa
    public function edit($id)
    {
        $pengaturan = Setting::first();
        $categories = Biaya::select('kategori')->distinct()->get();
        $kelas = Kelas::all();
        $siswa = Siswa::findOrFail($id);
        return view('bendahara.siswa.edit', compact('siswa', 'kelas', 'categories', 'pengaturan'));
    }

    // Ubah Siswa
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama'          => 'required|string|max:255',
            'nis'           => 'required|string|unique:siswas,nis,' . $id . ',id_siswa',
            'tempat_lahir'  => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'id_kelas'      => 'required|exists:kelas,id_kelas',
            'category'      => 'required|in:Atas,Menengah,Bawah',
            'status'        => 'required|in:AKTIF,LULUS,PINDAHAN,KELUAR',
        ], [
            'nama.required'           => 'Nama tidak boleh kosong.',
            'nis.required'            => 'NIS tidak boleh kosong.',
            'nis.unique'              => 'NIS telah digunakan.',
            'tempat_lahir.required'   => 'Tempat lahir tidak boleh kosong.',
            'tanggal_lahir.required'  => 'Tanggal lahir tidak boleh kosong.',
            'tanggal_lahir.date'      => 'Format tanggal lahir tidak valid.',
            'jenis_kelamin.required'  => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in'        => 'Jenis kelamin tidak valid.',
            'id_kelas.required'       => 'Kelas wajib dipilih.',
            'id_kelas.exists'         => 'Kelas tidak ditemukan.',
            'category.required'       => 'Kategori wajib dipilih.',
            'category.in'             => 'Kategori tidak valid.',
            'status.required'         => 'Status wajib dipilih.',
            'status.in'               => 'Status tidak valid.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', $validator->errors()->first()); // tampilkan error flash
        }

        $siswa = Siswa::findOrFail($id);
        $kelas = Kelas::where('id_kelas', $request->id_kelas)->first();
        $category = Biaya::where('kategori', $request->category)->first();

        // Update data siswa
        $siswa->update([
            'nama'          => $request->nama,
            'nis'           => $request->nis,
            'tempat_lahir'  => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'id_kelas'      => $request->id_kelas, // Simpan ID kelas
            'kelas'         => $kelas->nama, // Simpan Nama kelas
            'category'      => $category->kategori,
            'status'        => $request->status,
        ]);

        return redirect()->route('bendahara.siswa.index')->with('success', 'Data siswa berhasil diperbarui');
    }

    public function show($id_siswa)
    {
        $siswa = Siswa::where('id_siswa', $id_siswa)->firstOrFail();
        $pengaturan = Setting::first();
        return view('bendahara.siswa.show', compact('siswa', 'pengaturan'));
    }
}
