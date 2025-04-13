@extends('layouts.master')

@section('title', 'Data Siswa')
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
        <h1 class="h3 mb-0 text-gray-800">Siswa</h1>
    </div>


        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
                <a href="{{ route('admin.siswa.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"> Tambah Data</i>
                </a>
            </div>
            
            <div class="card-body border-bottom-primary">
                <div class="table-responsive pt-2">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIS</th>
                                <th>Tempat, Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
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
                                <td class="font-weight-bold">{{ $siswa->nis }}</td>
                                <td>{{ $siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                                <td>{{ $siswa->jenis_kelamin }}</td>
                                <td>{{ $siswa->kelas }}</td>
                                <td>{{ ucfirst($siswa->category) }}</td>
                                <td>
                                    <a href="{{ route('admin.siswa.createAccount', $siswa->id_siswa) }}" class="btn btn-primary btn-circle btn-sm">
                                        <i class="fas fa-plus"></i>
                                    </a>

                                    <a href="{{ route('admin.siswa.edit', $siswa->id_siswa) }}" class="btn btn-warning btn-circle btn-sm">
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

        <!-- Modal Konfirmasi Hapus Pertama -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                        <button class="close" type="button" data-bs-dismiss="modal">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus siswa <strong id="siswaNama"></strong> | <strong id="siswaNIS"></strong> ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-danger" id="nextConfirmation">Hapus</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Konfirmasi Hapus Kedua -->
        <div class="modal fade" id="secondDeleteModal" tabindex="-1" role="dialog" aria-labelledby="secondDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="secondDeleteModalLabel">Konfirmasi Akhir</h5>
                        <button class="close" type="button" data-bs-dismiss="modal">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Ini adalah peringatan terakhir! Apakah Anda benar-benar yakin ingin menghapus siswa <strong id="finalSiswaNama"></strong> | <strong id="finalSiswaNIS"></strong> ini?
                    </div>
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

        <script>
            // Modal Hapus Siswa
            document.addEventListener("DOMContentLoaded", function() {
                const deleteModal = document.getElementById("deleteModal");
                const secondDeleteModal = document.getElementById("secondDeleteModal");
                const deleteForm = document.getElementById("deleteForm");
                const siswaNama = document.getElementById("siswaNama");
                const siswaNIS = document.getElementById("siswaNIS");
                const finalSiswaNama = document.getElementById("finalSiswaNama");
                const finalSiswaNIS = document.getElementById("finalSiswaNIS");
                const nextConfirmation = document.getElementById("nextConfirmation");

                let siswaId = "";

                deleteModal.addEventListener("show.bs.modal", function(event) {
                    let button = event.relatedTarget;
                    siswaId = button.getAttribute("data-id");
                    let nama = button.getAttribute("data-nama");
                    let nis = button.getAttribute("data-nis");

                    // Tampilkan nama dan NIS siswa di modal pertama
                    siswaNama.textContent = nama;
                    siswaNIS.textContent = nis;
                });

                // Ketika tombol "Hapus" di modal pertama ditekan, modal kedua muncul
                nextConfirmation.addEventListener("click", function() {
                    // Tutup modal pertama
                    let firstModal = bootstrap.Modal.getInstance(deleteModal);
                    firstModal.hide();

                    // Tampilkan nama dan NIS siswa di modal kedua
                    finalSiswaNama.textContent = siswaNama.textContent;
                    finalSiswaNIS.textContent = siswaNIS.textContent;

                    // Perbarui action form sebelum modal kedua terbuka
                    deleteForm.action = "siswa/" + siswaId;

                    // Tampilkan modal kedua
                    let secondModal = new bootstrap.Modal(secondDeleteModal);
                    secondModal.show();
                });
            });
        </script>

@endsection
