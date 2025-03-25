@extends('admin.layouts.master')

@section('title', 'Data Kelas')

@section('content')
<div class="container-fluid">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
        </div>
    @endif


    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">kelas</h1>
    </div>


        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data kelas</h6>
                <a href="{{ route('admin.kelas.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"> Tambah Data</i>
                </a>
            </div>
            
            <div class="card-body border-bottom-primary">
                <div class="table-responsive pt-2">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kelas</th>
                                <th>Kode Kelas</th>
                                <th>Pengampu Kelas</th>
                                <th>Jumlah Siswa</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelas as $key => $k)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $k->nama }}</td>
                                <td>{{ $k->kode_kelas }}</td>
                                <td>{{ $k->guruPengampu->nama ?? 'Tidak ada' }}</td>
                                <td>{{ optional($k->siswas)->count() }} Siswa</td>

                                <td>{{ $k->deskripsi }}</td>
                                <td>
                                    <a href="{{ route('admin.kelas.show', $k->id_kelas) }}" class="btn btn-info btn-circle btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.kelas.edit', $k->id_kelas) }}" class="btn btn-warning btn-circle btn-sm">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <!-- Tombol Hapus Kelas -->
                                    <a href="#" class="btn btn-danger btn-circle btn-sm delete-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModalKelas"
                                    data-id="{{ $k->id_kelas }}"
                                    data-nama="{{ $k->nama }}"
                                    data-kode="{{ $k->kode_kelas }}">
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

            <!-- Modal Konfirmasi Hapus Pertama (Kelas) -->
            <div class="modal fade" id="deleteModalKelas" tabindex="-1" role="dialog" aria-labelledby="deleteModalKelasLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalKelasLabel">Konfirmasi Hapus Kelas</h5>
                            <button class="close" type="button" data-bs-dismiss="modal">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin menghapus kelas <strong id="kelasNama"></strong> | <strong id="kelasKode"></strong> ini?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-danger" id="nextConfirmationKelas">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Konfirmasi Hapus Kedua (Kelas) -->
            <div class="modal fade" id="secondDeleteModalKelas" tabindex="-1" role="dialog" aria-labelledby="secondDeleteModalKelasLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="secondDeleteModalKelasLabel">Konfirmasi Akhir</h5>
                            <button class="close" type="button" data-bs-dismiss="modal">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Ini adalah peringatan terakhir! Apakah Anda benar-benar yakin ingin menghapus kelas <strong id="finalKelasNama"></strong> | <strong id="finalKelasKode"></strong> ini?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <form id="deleteFormKelas" method="POST" action="">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


@endsection
