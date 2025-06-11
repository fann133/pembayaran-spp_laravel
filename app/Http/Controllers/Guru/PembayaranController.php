<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\ProfilSekolah;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Pembayaran;
use App\Models\Setting;
use Mpdf\Mpdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Exports\PembayaranExport;
use Maatwebsite\Excel\Facades\Excel;

class PembayaranController extends Controller
{
    public function index()
    {
        $guru = auth()->user()->guru;

        if (!$guru) {
            return back()->with('error', 'Data guru tidak ditemukan.');
        }

        $kelasIds       = Kelas::where('pengampu_kelas', $guru->id_guru)->pluck('id_kelas');
        $siswaIds       = Siswa::whereIn('id_kelas', $kelasIds)->pluck('id_siswa');
        $pembayarans    = Pembayaran::whereIn('id_siswa', $siswaIds)->get();
        $pengaturan     = Setting::first();

        return view('guru.pembayaran.index', compact('pembayarans', 'pengaturan'));
    }

    public function print($id)
    {
        $profil = ProfilSekolah::first();
        $pembayaran = Pembayaran::with('siswa') // cukup siswa saja kalau memang ada relasinya
            ->findOrFail($id);

        $html = view('guru.pembayaran.print', compact('pembayaran', 'profil'))->render();

        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output('Pembayaran.pdf', 'I'); // I = tampil di browser
    }

    public function printAll(Request $request)
    {
        $profil = ProfilSekolah::first();
        $ids = $request->input('pembayaran_id');

        if (empty($ids)) {
            return redirect()->back()->with('error', 'Pilih dulu data pembayaran siswa!');
        }

        $pembayaran = Pembayaran::whereIn('id_pembayaran', $ids)->get();
        
        $html = view('guru.pembayaran.print-pdf', compact('pembayaran', 'profil'))->render();

        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);

        // Mengembalikan response langsung agar headers benar
        return response($mpdf->Output('Data-Pembayaran.pdf', 'S'))
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="Data-Pembayaran.pdf"');
    }

    public function exportExcel(Request $request)
    {
        $ids = $request->input('pembayaran_id');
        
        if (empty($ids)) {
            return redirect()->back()->with('error', 'Pilih dulu data pembayaran siswa!');
        }

        $timestamp = Carbon::now()->format('His_d-m-Y'); // Format: jammenitdetik_tanggal-bulan-tahun
        $filename = 'Data_Pembayaran_' . $timestamp . '.xlsx';
        return Excel::download(new PembayaranExport($ids), $filename);
    }

    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        return redirect()->back()->with('success', 'Data pembayaran berhasil dihapus.');
    }
}

