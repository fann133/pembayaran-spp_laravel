<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Tagihan;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\Log;

class TagihanController extends Controller
{

    public function index()
    {
        $guru = auth()->user()->guru;
    
        if (!$guru) {
            return back()->with('error', 'Data guru tidak ditemukan.');
        }
    
        // Cari kelas yang dia ampu
        $kelasIds = Kelas::where('pengampu_kelas', $guru->id_guru)->pluck('id_kelas');
    
        // Ambil siswa dari kelas tersebut
        $siswaIds = Siswa::whereIn('id_kelas', $kelasIds)->pluck('id_siswa');
    
        // Ambil tagihan berdasarkan siswa tersebut
        $tagihans = Tagihan::whereIn('id_siswa', $siswaIds)->get();
    
        return view('guru.tagihan.index', compact('tagihans'));
    }

    public function payment($id)
    {
        $tagihan = Tagihan::with('siswa', 'biaya')->findOrFail($id);
        return view('guru.tagihan.payment', compact('tagihan'));
    }

    public function processPayment(Request $request, $id)
    {
        $tagihan = Tagihan::findOrFail($id);

        // Ambil ID user dari Auth atau session
        $id_users = Auth::check() ? Auth::user()->id_users : session('id_users');

        // Ambil input dibayar dan bersihkan formatnya
        $dibayarSekarang = str_replace(['Rp', '.', ' '], '', $request->dibayar);

        // Konversi ke integer
        $dibayarSekarang = (int) $dibayarSekarang;

        // Validasi jumlah pembayaran
        if ($dibayarSekarang > $tagihan->jumlah) {
            return redirect()->route('guru.tagihan.index')->with('error', 'Jumlah pembayaran melebihi sisa tagihan.');
        }

        // Hitung sisa hutang setelah pembayaran terbaru
        $piutang = $tagihan->jumlah - $dibayarSekarang;
        $status = $piutang == 0 ? 'LUNAS' : 'BELUM LUNAS';

        // Simpan transaksi pembayaran tanpa menghapus riwayat sebelumnya
        Pembayaran::create([
            'id_pembayaran' => Str::uuid(),
            'id_users' => $id_users,
            'id_tagihan' => $tagihan->id_tagihan,
            'id_siswa' => $tagihan->id_siswa,
            'nama' => $tagihan->nama,
            'nis' => $tagihan->nis,
            'kelas' => $tagihan->kelas,
            'kode' => $tagihan->kode,
            'nama_pembayaran' => $tagihan->nama_pembayaran,
            'jenis' => $tagihan->jenis,
            'bulan' => $tagihan->bulan,
            'jumlah_tagihan' => $tagihan->jumlah, // Menyimpan jumlah tagihan awal
            'dibayar' => $dibayarSekarang,
            'piutang' => $piutang,
            'status' => $status,
            'tanggal_bayar' => now()->toDateString(),
        ]);

        if ($status == 'LUNAS') {
            // Ambil jumlah awal dari relasi biaya
            $jumlah_awal = $tagihan->biaya->jumlah ?? $tagihan->jumlah; // fallback jika relasi tidak ada
        
            $tagihan->update([
                'status' => 'SUDAH DIBAYAR',
                'jumlah' => $jumlah_awal
            ]);
        
            return redirect()->route('guru.tagihan.index')->with('success', 'Pembayaran berhasil. Tagihan sudah lunas.');
        } else {
            // Jika masih ada sisa hutang, update jumlah agar menampilkan sisa tagihan
            $tagihan->update([
                'jumlah' => $piutang
            ]);
        
            return redirect()->route('guru.tagihan.index')->with('warning', 'Pembayaran berhasil. Tagihan belum lunas.');
        }                
    }

    public function print($id_tagihan)
    {
        $tagihan = DB::table('tagihan')->where('id_tagihan', $id_tagihan)->first();

        if (!$tagihan) {
            abort(404, 'Tagihan tidak ditemukan');
        }

        $html = view('guru.tagihan.print', compact('tagihan'))->render();

        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
        return $mpdf->Output('tagihan-' . $tagihan->nama . '.pdf', 'I');
    }

    public function printAll(Request $request)
    {
        $ids = $request->input('tagihan_id');

        if (empty($ids)) {
            return redirect()->back()->with('error', 'Centang dulu data tagihan siswa!');
        }

        $tagihan = Tagihan::whereIn('id_tagihan', $ids)->get();

        $html = view('guru.tagihan.print-pdf', compact('tagihan'))->render();

        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output('Data-Tagihan.pdf', 'I'); // I = inline di browser
    }

    public function destroy($id)
    {
            $tagihan = Tagihan::findOrFail($id);
            $tagihan->delete();

            return redirect()->back()->with('success', 'Tagihan berhasil dihapus.');
    }
    

}


