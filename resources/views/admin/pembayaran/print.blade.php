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

        /* Container header jadi flex box */
        .header {
            margin-top: -50px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px; /* jarak antar logo dan teks */
        }

        /* Logo kiri dan kanan */
        .header-logo {
            max-height: 80px; /* sesuaikan tinggi logo */
            width: auto;
        }

        /* Container teks header di tengah */
        .header-text {
            line-height: 1.5;
            text-align: center;
            flex: 1; /* biar header-text mengambil ruang tengah */
        }

        /* Buat paragraf rapat dan font kecil */
        .header-text p {
            font-size: 12px;
            margin: 2px 0;
        }

        .header-text h2,
        .header-text h3,
        .header-text p {
            margin: 0;
        }

        /* Garis bawah tebal */
        .header-underline {
            border-bottom: 4px solid #000;
            margin: 3px 0 0 0;
            width: 100%;
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
        {{ $profil->logo_naungan }}
        <!-- Teks header tengah -->
        <div class="header-text">
            <h2>{{ $profil->naungan }}</h2>
            <h3>{{ $profil->nama_sekolah }}</h3>
            <p>NSM {{ $profil->nsm }} - NPSN {{ $profil->npsn }}</p>
            <p>Terakreditasi {{ $profil->akreditasi }}</p>
            <p>{{ $profil->sk }}</p>
            <p>{{ $profil->alamat_sekolah }}</p>
            <p>Kode Pos: {{ $profil->kode_pos }} Telp ({{ $profil->telepon }}) Email: <span class="email">{{ $profil->email }}</span></p>
            <div class="header-underline"></div>
        </div>
        {{ $profil->logo }}
    </div>

    <div class="judul-laporan">Bukti Pembayaran SPP</div>

    <table>
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
            <td>Rp {{ number_format($pembayaran->jumlah_tagihan, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Tanggal</th>
            <td>{{ \Carbon\Carbon::parse($pembayaran->created_at)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <th>Petugas</th>
            <td>{{ $pembayaran->user->name }}</td>
        </tr>
    </table>

</body>
</html>
