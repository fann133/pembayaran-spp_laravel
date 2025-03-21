@extends('layouts.master')

@section('title', 'Pembayaran SPP | Data Siswa')
@section('content')
<div class="container-fluid">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif


    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Siswa</h1>
    </div>


        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
                <a href="{{ route('siswa.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"> Tambah Data</i>
                </a>
            </div>
            
            <div class="card-body">
                <div class="table-responsive pt-2">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIS</th>
                                <th>Tempat, Tanggal Lahir</th>
                                <th>Kelas</th>
                                <th>Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $key => $siswa)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $siswa->nama }} [{{ $siswa->status }}]</td>
                                <td class="text-gray-900">{{ $siswa->nis }}</td>
                                <td>{{ $siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                                <td>{{ $siswa->kelas }}</td>
                                <td>{{ ucfirst($siswa->category) }}</td>
                                <td>
                                    <a href="{{ route('siswa.edit', $siswa->id_siswa) }}" class="btn btn-warning btn-circle btn-sm">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    
                                        <a href="#" class="btn btn-danger btn-circle btn-sm delete-btn"
                                           data-bs-toggle="modal"
                                           data-bs-target="#deleteModal"
                                           data-id="{{ $siswa->id_siswa }}"
                                           data-nama="{{ $siswa->nama }}"
                                           data-nis="{{ $siswa->nis }}">
                                            <i class="fas fa-trash"></i>
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

        <!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button class="close" type="button"  data-bs-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
                <div class="modal-body">Apakah Anda yakin ingin menghapus siswa <strong id="siswaNama"></strong> | <strong id="siswaNIS"></strong> ini?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
