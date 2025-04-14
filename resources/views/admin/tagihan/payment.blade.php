@extends('layouts.master')

@section('title', 'Bayar Tagihan')
@section('content')
<div class="container">
    <h2>Pembayaran Tagihan</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Nama Siswa:</strong> {{ $tagihan->nama }}</p>
            <p><strong>NIS:</strong> {{ $tagihan->nis }}</p>
            <p><strong>Kelas:</strong> {{ $tagihan->kelas }}</p>
            <p><strong>Jenis Pembayaran:</strong> {{ $tagihan->jenis }}</p>
            <p><strong>Jumlah Tagihan:</strong> Rp{{ number_format($tagihan->jumlah, 0, ',', '.') }}</p>
            <p><strong>Status:</strong> 
                <span class="badge {{ $tagihan->status == 'SUDAH DIBAYAR' ? 'bg-success' : 'bg-danger' }}">
                    {{ $tagihan->status }}
                </span>
            </p>

            @if($tagihan->status == 'BELUM DIBAYAR')
            <form action="{{ route('admin.tagihan.processPayment', $tagihan->id_tagihan) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="dibayar" class="form-label">Jumlah yang Dibayar</label>
                    <input type="text" class="form-control" id="dibayar" name="dibayar" required>
                </div>
                <button type="submit" class="btn btn-success">Konfirmasi Pembayaran</button>
            </form>
            @else
            <p class="text-success">Tagihan ini sudah dibayar.</p>
            @endif

            <a href="{{ route('admin.tagihan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>
</div>

<script>
    const input = document.getElementById('dibayar');
    const max = {{ $tagihan->jumlah }};
  
    input.addEventListener('input', function(e) {
      let value = input.value.replace(/[^\d]/g, ''); // Hanya angka
      if (parseInt(value) > max) value = max; // Maksimal sesuai jumlah tagihan
  
      input.value = formatRupiah(value, 'Rp ');
    });
  
    function formatRupiah(angka, prefix) {
      let number_string = angka.toString().replace(/[^,\d]/g, ''),
          split   	 = number_string.split(','),
          sisa     	 = split[0].length % 3,
          rupiah     	 = split[0].substr(0, sisa),
          ribuan     	 = split[0].substr(sisa).match(/\d{3}/gi);
  
      if (ribuan) {
        let separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }
  
      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? prefix + rupiah : '');
    }
  </script>
@endsection
