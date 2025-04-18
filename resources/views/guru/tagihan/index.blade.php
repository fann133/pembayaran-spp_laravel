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
                            <th>Tanggal</th>
                            <th>Nama Siswa</th>
                            <th>Jenis</th>
                            <th>Nama Pembayaran</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tagihans as $tagihan => $t)
                            <tr>
                                <td>{{ $tagihan + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($t->tanggal_tagihan)->translatedFormat('d F Y') }}</td>
                                <td>{{ $t->siswa->nama ?? $t->nama }} <br><span class="font-weight-bold">{{ $t->nis }}</span></td>
                                <td>{{ $t->jenis }}</td>
                                <td>{{ $t->nama_pembayaran }} <span>{{ $t->bulan ?? ' ' }}</span> <br><span class="font-weight-bold">{{ $t->kode }}</span></td>
                                <td>{{ $t->jumlah, 0, ',', '.' }}</td>
                                <td>
                                    @if($t->status == 'BELUM DIBAYAR')
                                        <span class="badge bg-danger text-light">Belum Dibayar</span>
                                    @else
                                        <span class="badge bg-success text-light">Sudah Dibayar</span>
                                    @endif
                                </td>
                                <td>
                                <a href="{{ route('guru.tagihan.payment', $t->id_tagihan) }}" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-shopping-cart"></i>
                                        </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
