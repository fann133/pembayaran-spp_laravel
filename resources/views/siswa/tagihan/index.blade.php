@extends('layouts.master')

@section('content')
<div class="container">
    <h4 class="mb-4">Daftar Tagihan</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Pembayaran</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Bulan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tagihan as $item)
                <tr>
                    <td>{{ $item->nama_pembayaran }}</td>
                    <td>Rp{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->bulan ?? '-' }}</td>
                    <td>
                        <a href="{{ route('siswa.tagihan.show', $item->id_tagihan) }}" class="btn btn-info btn-sm">Detail</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Tidak ada data tagihan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
