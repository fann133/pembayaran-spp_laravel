<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/png" href="{{ asset($pengaturan->logo ?? 'assets/img/logo-login/logo.png') }}?v={{ time() }}">
    <title>Print Tagihan</title>
    <style>
        body { font-family: sans-serif; font-size: 12pt; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #000; padding: 8px; }
        .title { text-align: center; font-size: 16pt; font-weight: bold; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="title">Data Tagihan Pembayaran</div>

    <table>
        <tr><td><strong>Nama</strong></td><td>{{ $tagihan->nama }}</td></tr>
        <tr><td><strong>NIS</strong></td><td>{{ $tagihan->nis }}</td></tr>
        <tr><td><strong>Kelas</strong></td><td>{{ $tagihan->kelas }}</td></tr>
        <tr><td><strong>Nama Pembayaran</strong></td><td>{{ $tagihan->nama_pembayaran }}</td></tr>
        <tr><td><strong>Jenis</strong></td><td>{{ $tagihan->jenis }}</td></tr>
        <tr><td><strong>Bulan</strong></td><td>{{ $tagihan->bulan ?? '-' }}</td></tr>
        <tr><td><strong>Jumlah</strong></td><td>Rp {{ number_format($tagihan->jumlah, 0, ',', '.') }}</td></tr>
        <tr><td><strong>Status</strong></td><td>{{ $tagihan->status }}</td></tr>
    </table>
</body>
</html>