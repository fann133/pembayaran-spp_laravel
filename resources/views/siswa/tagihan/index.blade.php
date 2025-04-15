@extends('layouts.master')

@section('title', 'Data Tagihan')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tagihan Siswa</h1>
    </div>

    <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Tagihan Siswa</h6>
            </div>

            <div class="card-body border-bottom-primary">
                <div class="table-responsive pt-2">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama Pembayaran</th>
                                <th>Kode</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tagihan as $item => $i)
                                <tr>
                                    <td>{{ $item + 1 }}</td>
                                    <td>{{ $i->tanggal_tagihan}}</td>
                                    <td>{{ $i->nama_pembayaran }} [<span class="font-weight-bold">{{ $i->bulan ?? '-' }}</span>]</td>
                                    <td>Rp{{ ($i->kode) }}</td>
                                    <td>Rp{{ number_format($i->jumlah, 0, ',', '.') }}</td>
                                    <td>
                                        @if($i->status == 'BELUM DIBAYAR')
                                            <span class="badge bg-danger text-light">Belum Dibayar</span>
                                        @else
                                            <span class="badge bg-success text-light">Sudah Dibayar</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('siswa.tagihan.show', $i->id_tagihan) }}" class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-search"></i>
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
