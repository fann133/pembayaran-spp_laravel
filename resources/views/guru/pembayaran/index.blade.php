@extends('layouts.master')

@section('title', 'Data Pembayaran Siswa')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4">Data Pembayaran Siswa yang Anda Ampu</h4>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Siswa</th>
                    <th>NIS</th>
                    <th>Kelas</th>
                    <th>Pembayaran</th>
                    <th>Jenis</th>
                    <th>Bulan</th>
                    <th>Jumlah</th>
                    <th>Dibayar</th>
                    <th>Sisa</th>
                    <th>Status</th>
                    <th>Tanggal Bayar</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pembayarans as $i => $pembayaran)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $pembayaran->nama }}</td>
                        <td>{{ $pembayaran->nis }}</td>
                        <td>{{ $pembayaran->kelas }}</td>
                        <td>{{ $pembayaran->nama_pembayaran }}</td>
                        <td>{{ $pembayaran->jenis }}</td>
                        <td>{{ $pembayaran->bulan ?? '-' }}</td>
                        <td>Rp{{ number_format($pembayaran->jumlah_tagihan, 0, ',', '.') }}</td>
                        <td>Rp{{ number_format($pembayaran->dibayar, 0, ',', '.') }}</td>
                        <td>Rp{{ number_format($pembayaran->piutang, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge {{ $pembayaran->status == 'LUNAS' ? 'bg-success' : 'bg-warning text-dark' }}">
                                {{ $pembayaran->status }}
                            </span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($pembayaran->tanggal_bayar)->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" class="text-center">Tidak ada pembayaran ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
