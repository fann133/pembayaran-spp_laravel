@extends('layouts.master')

@section('title', 'Data Guru')
@section('content')
<div class="container-fluid">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Guru</h1>
    </div>


        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Guru</h6>
                <a href="{{ route('kepsek.guru.create') }}" class="btn btn-primary btn-sm">
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
                                <th>NIP</th>
                                <th>Tempat, Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Agama</th>
                                <th>Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($guru as $key => $guru)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $guru->nama }} [{{ $guru->status }}]</td>
                                <td class="text-gray-900">{{ $guru->nip }}</td>
                                <td>{{ $guru->tempat_lahir }}, {{ \Carbon\Carbon::parse($guru->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                                <td> {{ $guru->jenis_kelamin }}</td>
                                <td>{{ $guru->agama }}</td>
                                @php
                                    $roles = [
                                        3 => 'Guru',
                                        4 => 'Bendahara',
                                        5 => 'Kepala Sekolah'
                                    ];
                                @endphp
                                <td>{{ $roles[$guru->role_id] }}</td>

                                <td>
                                    <a href="{{ route('kepsek.guru.createAccount', $guru->id_guru) }}" class="btn btn-primary btn-circle btn-sm">
                                        <i class="fas fa-plus"></i>
                                    </a>                                    

                                    <a href="{{ route('kepsek.guru.edit', $guru->id_guru) }}" class="btn btn-warning btn-circle btn-sm">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    
                                    <a href="#" class="btn btn-danger btn-circle btn-sm delete-btn-guru"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModalGuru"
                                    data-id="{{ $guru->id_guru }}"
                                    data-nama="{{ $guru->nama }}"
                                    data-nip="{{ $guru->nip }}">
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

        <!-- Modal Konfirmasi Hapus Pertama (Guru) -->
        <div class="modal fade" id="deleteModalGuru" tabindex="-1" role="dialog" aria-labelledby="deleteModalGuruLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalGuruLabel">Konfirmasi Hapus</h5>
                        <button class="close" type="button" data-bs-dismiss="modal">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus guru <strong id="guruNama"></strong> | <strong id="guruNIP"></strong> ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-danger" id="nextConfirmationGuru">Hapus</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Konfirmasi Hapus Kedua (Guru) -->
        <div class="modal fade" id="secondDeleteModalGuru" tabindex="-1" role="dialog" aria-labelledby="secondDeleteModalGuruLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="secondDeleteModalGuruLabel">Konfirmasi Akhir</h5>
                        <button class="close" type="button" data-bs-dismiss="modal">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Ini adalah peringatan terakhir! Apakah Anda benar-benar yakin ingin menghapus guru <strong id="finalGuruNama"></strong> | <strong id="finalGuruNIP"></strong> ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <form id="deleteFormGuru" method="POST" action="">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // JS Modal Hapus Guru
            document.addEventListener("DOMContentLoaded", function() {
                const deleteModalGuru = document.getElementById("deleteModalGuru");
                const secondDeleteModalGuru = document.getElementById("secondDeleteModalGuru");
                const deleteFormGuru = document.getElementById("deleteFormGuru");
                
                const guruNama = document.getElementById("guruNama");
                const guruNIP = document.getElementById("guruNIP");
                const finalGuruNama = document.getElementById("finalGuruNama");
                const finalGuruNIP = document.getElementById("finalGuruNIP");

                const nextConfirmationGuru = document.getElementById("nextConfirmationGuru");

                deleteModalGuru.addEventListener("show.bs.modal", function(event) {
                    let button = event.relatedTarget;
                    let guruId = button.getAttribute("data-id");
                    let nama = button.getAttribute("data-nama");
                    let nip = button.getAttribute("data-nip");

                    // Set nama & NIP di modal pertama
                    guruNama.textContent = nama;
                    guruNIP.textContent = nip;

                    // Set action form
                    deleteFormGuru.action = "guru/" + guruId;

                    // Ketika tombol "Hapus" ditekan, tutup modal pertama dan buka modal kedua
                    nextConfirmationGuru.onclick = function() {
                        let modal1 = bootstrap.Modal.getInstance(deleteModalGuru);
                        modal1.hide();

                        // Set nama & NIP di modal kedua
                        finalGuruNama.textContent = nama;
                        finalGuruNIP.textContent = nip;

                        let modal2 = new bootstrap.Modal(secondDeleteModalGuru);
                        modal2.show();
                    };
                });
            });
        </script>

@endsection
