@extends('layouts.master')

@section('title', 'Data Pembayaran Siswa')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4">Pembayaran Siswa di Kelas Anda</h4>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Nama Pembayaran</th>
                    <th>Jenis</th>
                    <th>Bulan</th>
                    <th>Jumlah Bayar</th>
                    <th>Tanggal Bayar</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pembayarans as $index => $pembayaran)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pembayaran->siswa->nama ?? '-' }}</td>
                    <td>{{ $pembayaran->siswa->kelasData->nama ?? '-' }}</td>
                    <td>{{ $pembayaran->nama_pembayaran }}</td>
                    <td>{{ $pembayaran->jenis }}</td>
                    <td>{{ $pembayaran->bulan ?? '-' }}</td>
                    <td>Rp{{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($pembayaran->created_at)->format('d M Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">Belum ada data pembayaran untuk siswa di kelas Anda.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
