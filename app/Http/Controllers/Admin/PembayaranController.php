<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Mpdf\Mpdf;

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

    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        return redirect()->back()->with('success', 'Data pembayaran berhasil dihapus.');
    }

};