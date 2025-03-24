@extends('admin.layouts.master')

@section('title', 'Data Biaya')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Biaya</h6>
        </div>
        <div class="card-body">
            <a href="{{ route('admin.biaya.create') }}" class="btn btn-primary mb-3">Tambah Biaya</a>
            
            @foreach (['Atas' => $biayaAtas, 'Menengah' => $biayaMenengah, 'Bawah' => $biayaBawah] as $kategori => $biayaList)
                <h5 class="text-dark mt-4">Kategori: {{ $kategori }}</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Jenis</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($biayaList as $biaya)
                                <tr>
                                    <td>{{ $biaya->kode }}</td>
                                    <td>{{ $biaya->jenis }}</td>
                                    <td>{{ number_format($biaya->jumlah, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge {{ $biaya->status == 'AKTIF' ? 'badge-success' : 'badge-danger' }}">
                                            {{ $biaya->status }}
                                        </span>
                                    </td>                                    
                                    <td>
                                        <a href="" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data biaya untuk kategori ini</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
