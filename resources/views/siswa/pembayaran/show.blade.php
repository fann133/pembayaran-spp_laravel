@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Pembayaran</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Informasi Pembayaran</h6>
        </div>

        <div class="card-body border-bottom-primary">
            <table class="table table-bordered">
                <tr>
                    <th>Kode</th>
                    <td>{{ $pembayaran->kode }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
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
                    <th>Nama Pembayaran</th>
                    <td>{{ $pembayaran->nama_pembayaran }}</td>
                </tr>
                <tr>
                    <th>Jenis</th>
                    <td>{{ $pembayaran->jenis }}</td>
                </tr>
                <tr>
                    <th>Bulan</th>
                    <td>{{ $pembayaran->bulan ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Jumlah Tagihan</th>
                    <td>Rp{{ number_format($pembayaran->jumlah_tagihan, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Dibayar</th>
                    <td>Rp{{ number_format($pembayaran->dibayar, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Piutang</th>
                    <td>Rp{{ number_format($pembayaran->piutang, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge {{ $pembayaran->status == 'LUNAS' ? 'badge-success' : 'badge-warning' }}">
                            {{ $pembayaran->status }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Tanggal Bayar</th>
                    <td>{{ \Carbon\Carbon::parse($pembayaran->tanggal_bayar)->format('d-m-Y') }}</td>
                </tr>
            </table>

            <div class="d-flex justify-content-center mt-4">
                <a href="{{ route('siswa.pembayaran.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
