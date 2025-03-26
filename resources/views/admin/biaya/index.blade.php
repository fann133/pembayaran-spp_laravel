@extends('admin.layouts.master')

@section('title', 'Data Biaya')

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
        <h1 class="h3 mb-0 text-gray-800">Biaya</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Data Biaya</h6>
            <a href="{{ route('admin.biaya.create') }}" class="btn btn-primary">Tambah Biaya</a>
        </div>


        <div class="card-body border-bottom-primary">
            <div class="mb-5 row justify-content-center d-flex align-items-center">
                <div class="col-auto">
                    <label class="form-label">Filter Kategori</label>
                </div>
                <div class="col-auto">
                    <select id="filterKategori" class="form-control form-control-sm">
                        <option value="">Semua Kategori</option>
                        <option value="Atas" {{ $kategoriTerpilih == 'Atas' ? 'selected' : '' }}>Atas</option>
                        <option value="Menengah" {{ $kategoriTerpilih == 'Menengah' ? 'selected' : '' }}>Menengah</option>
                        <option value="Bawah" {{ $kategoriTerpilih == 'Bawah' ? 'selected' : '' }}>Bawah</option>
                    </select>
                </div>
            </div>
            

            <!-- 🔹 Tabel Data Biaya -->
            <div class="table-responsive mt-5 pt-2">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kode</th>
                            <th>Jenis</th>
                            <th>Jumlah</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($biayaList as $biaya => $b)
                            <tr>
                                <td>{{ $biaya + 1 }}</td>
                                <td>{{ $b->nama }} <span class="badge {{ $b->status == 'AKTIF' ? 'badge-success' : 'badge-danger' }}">
                                        {{ $b->status }}
                                    </span>
                                </td>
                                <td>{{ $b->kode }}</td>
                                <td>{{ $b->jenis }}</td>
                                <td>{{ number_format((float) $b->jumlah, 0, ',', '.') }}</td>

                                <td>{{ $b->kategori }}</td>
                                <td>
                                    <a href="{{ route('admin.biaya.edit', $b->id_biaya) }}" class="btn btn-warning btn-circle btn-sm">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    
                                    <a href="#" class="btn btn-danger btn-circle btn-sm delete-btn"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModalBiaya"
                                        data-id="{{ $b->id_biaya }}"
                                        data-nama="{{ $b->nama }}"
                                        data-kode="{{ $b->kode }}">
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
            <!-- Modal Konfirmasi Hapus Pertama (Biaya) -->
            <div class="modal fade" id="deleteModalBiaya" tabindex="-1" role="dialog" aria-labelledby="deleteModalBiayaLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalBiayaLabel">Konfirmasi Hapus</h5>
                            <button class="close" type="button" data-bs-dismiss="modal">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin menghapus biaya <strong id="biayaNama"></strong> | <strong id="biayaKode"></strong> ini?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-danger" id="nextConfirmationBiaya">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal Konfirmasi Hapus Kedua (Biaya) -->
            <div class="modal fade" id="secondDeleteModalBiaya" tabindex="-1" role="dialog" aria-labelledby="secondDeleteModalBiayaLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="secondDeleteModalBiayaLabel">Konfirmasi Akhir</h5>
                            <button class="close" type="button" data-bs-dismiss="modal">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Ini adalah peringatan terakhir! Apakah Anda benar-benar yakin ingin menghapus biaya <strong id="finalBiayaNama"></strong> | <strong id="finalBiayaKode"></strong> ini?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <form id="deleteFormBiaya" method="POST" action="">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                // Filter Data Kategori Biaya
                document.getElementById('filterKategori').addEventListener('change', function () {
                    let selectedKategori = this.value;
                    let url = new URL(window.location.href);
                    if (selectedKategori) {
                        url.searchParams.set('kategori', selectedKategori);
                    } else {
                        url.searchParams.delete('kategori');
                    }
                    window.location.href = url.toString();
                });

                // JS Modal Hapus Biaya
                document.addEventListener("DOMContentLoaded", function() {
                    const deleteModalBiaya = document.getElementById("deleteModalBiaya");
                    const secondDeleteModalBiaya = document.getElementById("secondDeleteModalBiaya");
                    const deleteFormBiaya = document.getElementById("deleteFormBiaya");

                    const biayaNama = document.getElementById("biayaNama");
                    const biayaKode = document.getElementById("biayaKode");
                    const finalBiayaNama = document.getElementById("finalBiayaNama");
                    const finalBiayaKode = document.getElementById("finalBiayaKode");

                    const nextConfirmationBiaya = document.getElementById("nextConfirmationBiaya");

                    deleteModalBiaya.addEventListener("show.bs.modal", function(event) {
                        let button = event.relatedTarget;
                        let biayaId = button.getAttribute("data-id");
                        let nama = button.getAttribute("data-nama");
                        let kode = button.getAttribute("data-kode");

                        // Set nama & kode di modal pertama
                        biayaNama.textContent = nama;
                        biayaKode.textContent = kode;

                        // Set action form ke route yang sesuai
                        deleteFormBiaya.action = "/admin/biaya/" + biayaId;

                        // Ketika tombol "Hapus" ditekan, tutup modal pertama dan buka modal kedua
                        nextConfirmationBiaya.onclick = function() {
                            let modal1 = bootstrap.Modal.getInstance(deleteModalBiaya);
                            modal1.hide();

                            // Set nama & kode di modal kedua
                            finalBiayaNama.textContent = nama;
                            finalBiayaKode.textContent = kode;

                            let modal2 = new bootstrap.Modal(secondDeleteModalBiaya);
                            modal2.show();
                        };
                    });
                });
            </script>
@endsection
