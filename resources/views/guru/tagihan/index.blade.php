@extends('layouts.master')

@section('title', 'Data Tagihan Siswa')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tagihan</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Data Tagihan</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive pt-2">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Jenis</th>
                            <th>Nama Pembayaran</th>
                            <th>Bulan</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tagihans as $tagihan)
                            <tr>
                                <td>{{ $tagihan->nama }}</td>
                                <td>{{ $tagihan->nis }}</td>
                                <td>{{ $tagihan->kelas }}</td>
                                <td>{{ $tagihan->nama_pembayaran }}</td>
                                <td>{{ $tagihan->jumlah }}</td>
                                <td>{{ $tagihan->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</div>
@endsection
