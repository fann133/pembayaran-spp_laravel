<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Print</title>
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

        table.invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            /* table-layout: auto default */
        }

        table.invoice-table th, table.invoice-table td {
            border: 1px solid #000;
            padding: 8px 10px;
            word-wrap: break-word;
            vertical-align: middle;
        }

        table.invoice-table th {
            background-color: #f2f2f2;
            font-weight: 600;
            text-align: center;
        }

        table.invoice-table td {
            text-align: center;
        }

        table.invoice-table td.left-align {
            text-align: left;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Number formatting alignment */
        table.invoice-table td.number {
            text-align: left;
            padding-right: 15px;
        }

        @media print {
            p.print-footer {
                position: fixed;
                bottom: 5px;
                right: 5px;
                font-style: italic;
                font-size: 11px;
                margin: 0;
            }

            /* Kurangi margin kertas supaya elemen bisa mendekati tepi */
            @page {
                margin: 10mm 10mm 10mm 10mm;
            }
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
    <div class="title">INVOICE PEMBAYARAN</div>

    <table class="invoice-table">
        <thead>
            <tr>
                <th >No</th>
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
                <td class="left-align">{{ $t->nama }}</td>
                <td>{{ $t->nis }}</td>
                <td>{{ $t->kelas }}</td>
                <td class="left-align">{{ $t->nama_pembayaran }}</td>
                <td>{{ $t->jenis }}</td>
                <td class="number">Rp {{ number_format($t->jumlah_tagihan, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p class="print-footer">
        Dicetak pada: {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }} oleh {{ auth()->user()->name }}
    </p>

</body>
</html>
