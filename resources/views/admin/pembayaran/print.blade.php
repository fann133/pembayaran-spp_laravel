<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/png" href="{{ asset($pengaturan->logo ?? 'assets/img/logo-login/logo.png') }}?v={{ time() }}">
    <title>Print Pembayaran</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #000; padding: 8px; text-align: left; }
        .title { text-align: center; font-size: 16px; font-weight: bold; margin-bottom: 10px; }
    </style>
</head>
<body>

    <div class="title">Bukti Pembayaran</div>

    <table class="table">
        <tr>
            <th>Nama Siswa</th>
            <td>{{ $pembayaran->nama }}</td>
        </tr>
        <tr>
            <th>NIS</th>
            <td>{{ $pembayaran->nis }}</td>
        </tr>
        <tr>
            <th>Kelas</th>
            <td>{{ $pembayaran->kelas }}</td>
        </tr>
        <tr>
            <th>Pembayaran</th>
            <td>{{ $pembayaran->nama_pembayaran }}</td>
        </tr>
        <tr>
            <th>Bulan</th>
            <td>{{ $pembayaran->bulan ?? '-' }}</td>
        </tr>
        <tr>
            <th>Jumlah</th>
            <td>Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Tanggal</th>
            <td>{{ \Carbon\Carbon::parse($pembayaran->created_at)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <th>dibayar</th>
            <td>{{ $pembayaran->user->name }}</td>
        </tr>
    </table>

</body>
</html>
