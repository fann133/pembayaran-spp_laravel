<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Mpdf\Mpdf;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    // Menampilkan daftar pembayaran
    public function index()
    {
        $pembayaran = Pembayaran::with('tagihan')->orderBy('created_at', 'desc')->get();
        return view('admin.pembayaran.index', compact('pembayaran'));
    }

    public function print($id)
    {
        $pembayaran = Pembayaran::with('siswa') // cukup siswa saja kalau memang ada relasinya
            ->findOrFail($id);

        $html = view('admin.pembayaran.print', compact('pembayaran'))->render();

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

    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        return redirect()->back()->with('success', 'Data pembayaran berhasil dihapus.');
    }

};