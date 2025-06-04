<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $tagihan->nis }} | {{ $tagihan->nama }}</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo-login/logo.png') }}?v={{ time() }}">
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
        }

        .header-underline {
            position: absolute;
            bottom: -5px;
            left: 0;
            right: 0;
            border-top: 4px solid #000;
            width: 100%;
        }

        .title {
            margin-top: 10px;
            margin-bottom: 50px;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            text-decoration: underline;
        }

        .table-responsive {
            overflow-x: auto;
            width: 100%;
        }

        .table-invoice {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            table-layout: fixed;
        }

        .table-invoice td {
            border: 1px solid #000;
            padding: 8px 10px;
            vertical-align: top;
            word-wrap: break-word;
        }

        .table-invoice td.label {
            width: 50%;
            font-weight: bold;
            background-color: #f5f5f5;
        }

        .table-invoice td.value {
            width: 50%;
        }

        .nama-pembayaran {
            text-transform: uppercase;
        }

        .table-invoice td[colspan] {
            text-align: center;
        }

        .highlight {
            font-size: 16px;
            font-weight: bold;
            color: red;
            text-align: center;
            padding: 15px 0;
        }

        .small-text {
            font-size: 10px;
            color: #333;
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
                    <p>Kode Pos: {{ $profil->kode_pos }} Telp ({{ $profil->telepon }}) Email: <span style="font-style: italic;"><a href="mailto:{{ $profil->email }}">{{ $profil->email }}</a></span></p>
                </td>
                
                <!-- Logo kanan -->
                <td style="width: 12.5%; text-align: right; border: none;">
                    <img src="{{ public_path('assets/img/profil-sekolah/' . $profil->logo) }}" style="width: 80px;">
                </td>
            </tr>
        </table>
        <div class="header-underline"></div>
    </div>

    <br>
    <div class="title">INVOICE TAGIHAN</div>

    <!-- Data Diri -->
    <table style="width: 100%; margin-bottom: 20px;">
        <tr>
            <!-- Kolom Kiri -->
            <td style="width: 50%; vertical-align: top;">
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 18%;"><strong>Nama</strong></td>
                        <td style="width: 5%;">:</td>
                        <td>{{ $tagihan->nama }}</td>
                    </tr>
                    <tr>
                        <td><strong>NIS</strong></td>
                        <td>:</td>
                        <td>{{ $tagihan->nis }}</td>
                    </tr>
                </table>
            </td>

            <!-- Kolom Kanan --> 
            <td style="width: 50%; vertical-align: top; text-align: right;">
                <table style="display: inline-block; text-align: left;">
                    <tr>
                        <td style="width: 60%; padding-right: 20px;"><strong>Kelas</strong></td>
                        <td style="width: 5%;">:</td>
                        <td style="padding-left: 10px;">{{ $tagihan->kelas }}</td>
                    </tr>
                    <tr>
                        <td style="padding-right: 20px;"><strong>Tahun Pelajaran</strong></td>
                        <td>:</td>
                        <td style="padding-left: 10px;">{{ $tagihan->tahun_ajar ?? '-' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>



    <!-- Tabel Pembayaran -->
    <div class="table-responsive">
        <table class="table-invoice">
            <tr>
                <td class="label">Tagihan</td>
                <td class="value">
                    <strong class="nama-pembayaran">{{ $tagihan->nama_pembayaran }}</strong><br>
                    <span class="small-text">{{ \Carbon\Carbon::parse($tagihan->tanggal_tagihan)->translatedFormat('d F Y') }}</span>
                </td>
            </tr>
            <tr>
                <td class="label">Jenis</td>
                <td class="value">{{ $tagihan->jenis }} ({{ $tagihan->kode }})</td>
            </tr>
            <tr>
                <td class="label">Bulan</td>
                <td class="value"><strong>{{ !empty($tagihan->bulan) ? $tagihan->bulan : '-' }}</strong></td>
            </tr>
            <tr>
                <td class="label">Total Tagihan</td>
                <td class="value"><strong>Rp{{ number_format($tagihan->jumlah, 0, ',', '.') }}</strong></td>
            </tr>
            <tr>
                <td class="label">Status</td>
                <td class="value">{{ $tagihan->status }}</td>
            </tr>
            
            <tr>
                <td colspan="2" class="highlight">Rp{{ number_format($tagihan->jumlah, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>
</body>
</html>