<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Setting;
use App\Models\ProfilSekolah;
use Mpdf\Mpdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PembayaranExport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PembayaranController extends Controller
{
    // Menampilkan daftar pembayaran
    public function index()
    {
        $pembayaran = Pembayaran::with('tagihan')->orderBy('created_at', 'desc')->get();
        $pengaturan = Setting::first();
        return view('admin.pembayaran.index', compact('pembayaran', 'pengaturan'));
    }

    public function print($id)
    {
        $profil = ProfilSekolah::first();
        
        $logoNaunganPath = public_path('assets/img/profil-sekolah/' . $profil->logo_naungan);
        $logoSekolahPath = public_path('assets/img/profil-sekolah/' . $profil->logo);

        if (!file_exists($logoNaunganPath) || !file_exists($logoSekolahPath)) {
            dd('Gambar tidak ditemukan!');
        }

        $pembayaran = Pembayaran::with('siswa') // cukup siswa saja kalau memang ada relasinya
            ->findOrFail($id);

        $html = view('admin.pembayaran.print', compact('pembayaran', 'profil'))->render();

        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output('Pembayaran.pdf', 'I'); // I = tampil di browser
    }

    public function printAll(Request $request)
    {
        $ids = $request->input('pembayaran_id');

        if (empty($ids)) {
            return redirect()->back()->with('error', 'Centang dulu data pembayaran siswa!');
        }

        $pembayaran = Pembayaran::whereIn('id_pembayaran', $ids)->get();
        
        $html = view('admin.pembayaran.print-pdf', compact('pembayaran'))->render();

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
            return redirect()->back()->with('error', 'Centang dulu data pembayaran siswa!');
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

};