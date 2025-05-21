<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bukti Pembayaran SPP</title>
    <link rel="icon" type="image/png" href="{{ asset($pengaturan->logo ?? 'assets/img/logo-login/logo.png') }}?v={{ time() }}">
    <style>
        body {
            font-family: 'Times New Roman', Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 12px;
        }

        h2, h3, p {
            margin: 0;
            padding: 0;
        }

        .header {
            position: relative;
            margin-top: -50px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header-logo-left,
        .header-logo-right {
            width: 80px;
            height: auto;
        }

        .header-text {
            flex-grow: 1;
            text-align: center;
            padding: 0 10px;
        }

        .header-text p {
            font-size: 12px;
            margin: 2px 0;
        }

        .header-underline {
            position: absolute;
            top: -40px; /* Naik 10px dari posisi awal -30px */
            left: 0;
            right: 0;
            border-top: 4px solid #000;
            width: 100%;
            background-color: rgba(255,0,0,0.2);
        }


        .email {
            font-style: italic;
            color: rgb(113, 188, 229);
        }

        .judul-laporan {
            margin-top: -10px;
            margin-bottom: 30px;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            width: 30%;
        }
    </style>
</head>
<body>
    <div class="header">
        <table style="width: 100%; margin-top: -40px; margin-bottom: 10px; border-collapse: collapse; border: none;">
            <tr>
                <!-- Logo kiri -->
                <td style="width: 12.5%; text-align: left; border: none;">
                    <img src="{{ public_path('assets/img/profil-sekolah/' . $profil->logo_naungan) }}" style="width: 80px;">
                </td>

                <!-- Teks tengah -->
                <td style="width: 75%; text-align: center; border: none;">
                    <h2>{{ $profil->naungan }}</h2>
                    <h3>{{ $profil->nama_sekolah }}</h3>
                    <p>NSM {{ $profil->nsm }} - NPSN {{ $profil->npsn }}</p>
                    <p>Terakreditasi {{ $profil->akreditasi }}</p>
                    <p>{{ $profil->sk }}</p>
                    <p>{{ $profil->alamat_sekolah }}</p>
                    <p>Kode Pos: {{ $profil->kode_pos }} Telp ({{ $profil->telepon }}) Email: <span style="color: rgb(113, 188, 229); font-style: italic;">{{ $profil->email }}</span></p>
                </td>
                <!-- Logo kanan -->
                <td style="width: 12.5%; text-align: right; border: none;">
                    <img src="{{ public_path('assets/img/profil-sekolah/' . $profil->logo) }}" style="width: 80px;">
                </td>
            </tr>
        </table>
        <div class="header-underline"></div>
    </div>

    <div class="judul-laporan">Invoice Pembayaran</div>

    <table>
        <tr><th>Nama Siswa</th><td>{{ $pembayaran->nama }}</td></tr>
        <tr><th>NIS</th><td>{{ $pembayaran->nis }}</td></tr>
        <tr><th>Kelas</th><td>{{ $pembayaran->kelas }}</td></tr>
        <tr><th>Pembayaran</th><td>{{ $pembayaran->nama_pembayaran }}</td></tr>
        <tr><th>Bulan</th><td>{{ $pembayaran->bulan ?? '-' }}</td></tr>
        <tr><th>Jumlah</th><td>Rp {{ number_format($pembayaran->jumlah_tagihan, 0, ',', '.') }}</td></tr>
        <tr><th>Tanggal</th><td>{{ \Carbon\Carbon::parse($pembayaran->created_at)->translatedFormat('d F Y') }}</td></tr>
        <tr><th>Petugas</th><td>{{ $pembayaran->user->name }}</td></tr>
    </table>
</body>
</html>
