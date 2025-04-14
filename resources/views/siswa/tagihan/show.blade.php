@extends('layouts.master')

@section('content')
<div class="container">
    <h4>Detail Tagihan</h4>
    <table class="table table-striped">
        <tr>
            <th>Nama Pembayaran</th>
            <td>{{ $tagihan->nama_pembayaran }}</td>
        </tr>
        <tr>
            <th>Jumlah</th>
            <td>Rp{{ number_format($tagihan->jumlah, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $tagihan->status }}</td>
        </tr>
        <tr>
            <th>Bulan</th>
            <td>{{ $tagihan->bulan ?? '-' }}</td>
        </tr>
    </table>
    <a href="{{ route('siswa.tagihan.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
