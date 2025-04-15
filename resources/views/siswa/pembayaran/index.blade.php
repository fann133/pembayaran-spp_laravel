@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pembayaran</h1>
    </div>

    <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-center">
                <h6 class="m-0 font-weight-bold text-primary">Data Pembayaran</h6>
            </div>

            <div class="card-body border-bottom-primary">
                <div class="table-responsive pt-2">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Bayar</th>
                                <th>Nama Pembayaran</th>
                                <th>Kode</th>
                                <th>Jumlah Dibayar</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pembayaran as $i => $item)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_bayar)->format('d-m-Y') }}</td>
                                    <td>{{ $item->nama_pembayaran }}<br><span class="font-weight-bold">{{ $item->bulan }}</span></td>
                                    <td>{{ $item->kode }}</td>
                                    <td>Rp{{ number_format($item->dibayar, 0, ',', '.') }}</td>
                                    <td><span class="badge {{ $item->status == 'LUNAS' ? 'badge-success' : 'badge-warning' }}">{{ $item->status }}</span></td>
                                    <td>
                                        <a href="{{ route('siswa.pembayaran.show', $item->id_pembayaran) }}" class="btn btn-sm btn-circle btn-info">
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
