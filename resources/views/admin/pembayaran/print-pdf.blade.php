<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/png" href="{{ asset($pengaturan->logo ?? 'assets/img/logo-login/logo.png') }}?v={{ time() }}">
    <title>Data pembayaran</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h3>Data Tagihan Terpilih</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIS</th>
                <th>Kelas</th>
                <th>Nama Pembayaran</th>
                <th>Jenis</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pembayaran as $i => $t)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $t->nama }}</td>
                <td>{{ $t->nis }}</td>
                <td>{{ $t->kelas }}</td>
                <td>{{ $t->nama_pembayaran }}</td>
                <td>{{ $t->jenis }}</td>
                <td>{{ number_format($t->jumlah) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
