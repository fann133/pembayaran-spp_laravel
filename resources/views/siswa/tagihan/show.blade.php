@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail</h1>
    </div>

    <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-center">
                <h6 class="m-0 font-weight-bold text-primary">Data Tagihan</h6>
            </div>

            <div class="card-body border-bottom-primary">
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
                <!-- <div class="text-start mt-4">
                    <a href="{{ route('siswa.tagihan.index') }}" class="btn btn-secondary">Kembali</a>
                </div> -->
            </div>
    </div>
</div>
@endsection
