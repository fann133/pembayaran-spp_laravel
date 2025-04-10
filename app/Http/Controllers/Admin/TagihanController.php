<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Biaya;
use App\Models\Tagihan;
use App\Models\Pembayaran;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class TagihanController extends Controller
{
    public function index()
    {
        Log::info('Session ID User saat masuk halaman pembayaran:', ['id_users' => session('id_users')]);
        $tagihan = Tagihan::with('siswa.kelasData', 'biaya')
                ->orderBy('created_at', 'desc') // Menampilkan data terbaru di atas
                ->get();
        return view('admin.tagihan.index', compact('tagihan'));
    }

    public function create()
    {
        $siswas = Siswa::whereIn('status', ['AKTIF', 'PINDAHAN'])->get();
        $biayas = Biaya::where('status', 'AKTIF')->get();
        return view('admin.tagihan.create', compact('siswas', 'biayas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_siswa' => 'required',
            'jenis_pembayaran' => 'required',
            'status' => 'required',
            'bulan' => $request->jenis_pembayaran === 'SPP' ? 'required' : 'nullable',
        ]);

        // Cek data siswa berdasarkan id_siswa
        $siswa = Siswa::where('id_siswa', $request->id_siswa)->first();
        if (!$siswa) {
            return redirect()->back()->with('error', 'Siswa tidak ditemukan.');
        }

        // Ambil data biaya
        if (!$request->id_biaya) {
            $biaya = Biaya::where([
                ['jenis', $request->jenis_pembayaran],
                ['kategori', $siswa->category],
                ['status', 'AKTIF']
            ])->first();
        } else {
            $biaya = Biaya::where('id_biaya', $request->id_biaya)->first();
        }

        if (!$biaya) {
            return redirect()->back()->with('error', 'Biaya tidak ditemukan untuk kategori ini.');
        }

        // Parameter pencarian untuk pengecekan
        $queryParams = [
            ['id_siswa', $request->id_siswa],
            ['nis', $siswa->nis],
            ['kelas', $siswa->kelas],
            ['kode', $biaya->kode], // Gunakan kode sebagai patokan
            ['jenis', $biaya->jenis],
            ['nama_pembayaran', $biaya->nama],
        ];

        if ($biaya->jenis === 'SPP') {
            $queryParams[] = ['bulan', $request->bulan]; // Tambahkan pengecekan bulan untuk SPP
        }

        // Cek apakah tagihan atau pembayaran sudah ada
        $cekTagihan = Tagihan::where($queryParams)->exists();
        $cekPembayaran = Pembayaran::where($queryParams)->exists();

        if ($cekTagihan) {
            return redirect()->back()->with('error', 'Tagihan ini sudah ada.');
        }

        if ($cekPembayaran) {
            return redirect()->back()->with('error', 'Pembayaran untuk tagihan ini sudah pernah dibuat.');
        }

        // Simpan data tagihan
        Tagihan::create([
            'id_tagihan' => Str::uuid(),
            'id_siswa' => $request->id_siswa,
            'nama' => $siswa->nama,
            'nis' => $siswa->nis,
            'kelas' => $siswa->kelas,
            'id_biaya' => $biaya->id_biaya,
            'nama_pembayaran' => $biaya->nama,
            'jenis' => $biaya->jenis,
            'kode' => $biaya->kode, // Menggunakan kode biaya dan menyimpannya di tagihan
            'jumlah' => $biaya->jumlah,
            'bulan' => $biaya->jenis === 'SPP' ? $request->bulan : '',
            'status' => $request->status,
            'tanggal_tagihan' => now()->toDateString(),
        ]);

        return redirect()->route('admin.tagihan.index')->with('success', 'Tagihan berhasil ditambahkan.');
    }


    public function payment($id)
    {
        $tagihan = Tagihan::with('siswa', 'biaya')->findOrFail($id);
        return view('admin.tagihan.payment', compact('tagihan'));
    }

    public function processPayment(Request $request, $id)
    {
        $tagihan = Tagihan::findOrFail($id);

        // Ambil ID user dari Auth atau session
        $id_users = Auth::check() ? Auth::user()->id_users : session('id_users');

        // Jumlah yang dibayar sekarang
        $dibayarSekarang = $request->dibayar;

        // Pastikan jumlah yang dibayar tidak lebih dari jumlah tagihan saat ini
        if ($dibayarSekarang > $tagihan->jumlah) {
            return redirect()->route('admin.tagihan.index')->with('error', 'Jumlah pembayaran melebihi sisa tagihan.');
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
            $tagihan->delete();
            return redirect()->route('admin.tagihan.index')->with('success', 'Pembayaran berhasil. Tagihan sudah lunas.');
        } else {
            // Jika masih ada sisa hutang, update tagihan dengan jumlah piutang yang tersisa
            $tagihan->update(['jumlah' => $piutang]);
            return redirect()->route('admin.tagihan.index')->with('warning', 'Pembayaran berhasil. Tagihan belum lunas.');
        }   
    }

    public function print($id_tagihan)
    {
        $tagihan = DB::table('tagihan')->where('id_tagihan', $id_tagihan)->first();

        if (!$tagihan) {
            abort(404, 'Tagihan tidak ditemukan');
        }

        $html = view('admin.tagihan.print', compact('tagihan'))->render();

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

        $html = view('admin.tagihan.print-pdf', compact('tagihan'))->render();

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


