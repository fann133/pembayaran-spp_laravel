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



<!-- <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice Tagihan</title>
    <link rel="icon" type="image/png" href="{{ asset($pengaturan->logo ?? 'assets/img/logo-login/logo.png') }}?v={{ time() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            font-family: 'sans-serif';
            font-size: 12pt;
        }

        .invoice-container {
            padding: 30px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        .header {
            background-color: #4e73df;
            color: white;
            padding: 15px;
            border-radius: 10px 10px 0 0;
            text-align: center;
        }

        .section-title {
            color: #4e73df;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .total-amount {
            background-color: #f8f9fc;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            font-size: 16px;
            font-weight: bold;
            color: #4e73df;
        }

        .footer {
            margin-top: 30px;
            font-size: 10pt;
            text-align: center;
            color: #888;
        }

        .logo {
            width: 60px;
            height: auto;
        }

        .badge-success {
            background-color: #28a745;
            color: white;
        }

        .badge-danger {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<body>

<div class="invoice-container">
    <div class="header">
        <img src="{{ asset($pengaturan->logo ?? 'assets/img/logo-login/logo.png') }}" alt="Logo" class="logo mb-2">
        <h4 class="mb-0">INVOICE PEMBAYARAN</h4>
        <small>INFAQKU - Sistem Pembayaran</small>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <p class="section-title">Data Siswa</p>
            <p>
                <strong>Nama:</strong> {{ $tagihan->nama }}<br>
                <strong>NIS:</strong> {{ $tagihan->nis }}<br>
                <strong>Kelas:</strong> {{ $tagihan->kelas }}
            </p>
        </div>
        <div class="col-md-6 text-right">
            <p class="section-title">Info Tagihan</p>
            <p>
                <strong>Tanggal Cetak:</strong> {{ date('d M Y') }}<br>
                <strong>Status:</strong>
                <span class="badge badge-{{ $tagihan->status == 'SUDAH DIBAYAR' ? 'success' : 'danger' }}">
                    {{ $tagihan->status }}
                </span>
            </p>
        </div>
    </div>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Nama Pembayaran</th>
                <th>Jenis</th>
                <th>Bulan</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $tagihan->nama_pembayaran }}</td>
                <td>{{ $tagihan->jenis }}</td>
                <td>{{ $tagihan->bulan ?? '-' }}</td>
                <td>Rp {{ number_format($tagihan->jumlah, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="total-amount">
        Total Dibayar: Rp {{ number_format($tagihan->jumlah, 0, ',', '.') }}
    </div>

    <div class="footer">
        Invoice ini dihasilkan oleh sistem. Harap simpan sebagai bukti pembayaran.
    </div>
</div>

</body>
</html> -->