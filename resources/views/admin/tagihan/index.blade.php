@extends('admin.layouts.master')

@section('title', 'Pembayaran SPP | Data Tagihan')
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
        <h1 class="h3 mb-0 text-gray-800">Tagihan</h1>
    </div>


        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Tagihan</h6>
                <div>
                    <a href="{{ route('admin.tagihan.create') }}" class="btn btn-primary btn-sm me-2">
                        <i class="fas fa-plus"> Tambah Data</i>
                    </a>
                    <button type="submit" form="printForm" class="btn btn-secondary btn-sm">
                        <i class="fas fa-print"> Print</i>
                    </button>
                </div>
            </div>
            
            <div class="card-body border-bottom-primary">
                <form id="printForm" method="POST" action="{{ route('tagihan.printAll') }}" target="_blank">
                    @csrf
                <div class="table-responsive pt-2">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th class="text-center align-middle" style="width: 50px;">
                                <div class="form-check d-flex align-items-center justify-content-center">
                                    <input class="form-check-input" style="width: 20px; height: 20px;" type="checkbox" id="checkAll">
                                    <label class="form-check-label" for="checkAll"></label>
                                </div>
                            </th>                                                        
                            <th>Nama</th>
                            <th>Pembayaran</th>
                            <th>Jenis</th>
                            <th>Kode</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($tagihan as $key => $item)
                            <tr>
                                <td class="text-center align-middle">
                                    <div class="form-check d-flex align-items-center justify-content-center">
                                        <input class="form-check-input tagihan-checkbox" style="width: 20px; height: 20px;" type="checkbox" name="tagihan_id[]" value="{{ $item->id_tagihan }}" id="tagihan_{{ $key }}">
                                        <label class="form-check-label" for="tagihan_{{ $key }}" style="margin-left: 30px;">{{ $key + 1 }}</label>
                                    </div>
                                </td>                                                 
                                <td>{{ $item->nama }} <br><span class="font-weight-bold">{{ $item->nis }}</span> [{{ $item->kelas }}]</td>
                                <td>{{ $item->nama_pembayaran }} <br><span class="font-weight-bold">{{ $item->bulan }}</span></td>
                                <td>{{ $item->jenis }}</td>
                                <td>{{ $item->kode }}</td>
                                <td>{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                <td>
                                    @if($item->status == 'BELUM DIBAYAR')
                                        <span class="badge bg-danger text-light">Belum Dibayar</span>
                                    @else
                                        <span class="badge bg-success text-light">Sudah Dibayar</span>
                                    @endif
                                </td>
                                <td>
                                        <a href="{{ route('admin.tagihan.payment', $item->id_tagihan) }}" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-shopping-cart"></i>
                                        </a>

                                        <a href="{{ route('tagihan.print', $item->id_tagihan) }}" target="_blank" class="btn btn-secondary btn-circle btn-sm">
                                            <i class="fas fa-print"></i>
                                        </a>

                                        <a href="#" class="btn btn-danger btn-circle btn-sm delete-btn"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal"
                                            data-id="{{ $item->id_tagihan }}"
                                            data-nama="{{ $item->nama_pembayaran }}"
                                            data-kode="{{ $item->kode }}"
                                            data-siswa="{{ $item->nama }}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </form>
            </div>
        </div>
</div>

<!-- Modal Konfirmasi Hapus Tagihan -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
          <button class="close" type="button" data-bs-dismiss="modal"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          Apakah Anda yakin ingin menghapus tagihan <strong id="tagihanNama"></strong> | 
          <strong id="tagihanKode"></strong> milik siswa <strong id="tagihanSiswa"></strong>?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-danger" id="nextConfirmation">Hapus</button>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Modal Konfirmasi Hapus Akhir -->
  <div class="modal fade" id="secondDeleteModal" tabindex="-1" role="dialog" aria-labelledby="secondDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="secondDeleteModalLabel">Konfirmasi Akhir</h5>
          <button class="close" type="button" data-bs-dismiss="modal"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          Ini peringatan terakhir! Yakin ingin menghapus tagihan <strong id="finalTagihanNama"></strong> | 
          <strong id="finalTagihanKode"></strong> milik siswa <strong id="finalTagihanSiswa"></strong>?
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
        // Checklist data
        document.addEventListener("DOMContentLoaded", function () {
            const checkAll = document.getElementById('checkAll');
            const checkboxes = document.querySelectorAll('.tagihan-checkbox');

            checkAll.addEventListener('change', function () {
                checkboxes.forEach(cb => cb.checked = this.checked);
            });
        });

        document.getElementById('checkAll').addEventListener('change', function () {
            let checkboxes = document.querySelectorAll('input[name="tagihan_id[]"]');
            checkboxes.forEach(cb => cb.checked = this.checked);
        });

        // Modal Hapus Tagihan
        document.addEventListener("DOMContentLoaded", function () {
            const deleteModal = document.getElementById("deleteModal");
            const secondDeleteModal = document.getElementById("secondDeleteModal");
            const deleteForm = document.getElementById("deleteForm");

            const tagihanNama = document.getElementById("tagihanNama");
            const tagihanKode = document.getElementById("tagihanKode");
            const tagihanSiswa = document.getElementById("tagihanSiswa");

            const finalNama = document.getElementById("finalTagihanNama");
            const finalKode = document.getElementById("finalTagihanKode");
            const finalSiswa = document.getElementById("finalTagihanSiswa");

            const nextBtn = document.getElementById("nextConfirmation");

            let tagihanId = "";

            deleteModal.addEventListener("show.bs.modal", function (event) {
                const button = event.relatedTarget;
                tagihanId = button.getAttribute("data-id");
                const nama = button.getAttribute("data-nama");
                const kode = button.getAttribute("data-kode");
                const siswa = button.getAttribute("data-siswa");

                tagihanNama.textContent = nama;
                tagihanKode.textContent = kode;
                tagihanSiswa.textContent = siswa;
            });

            nextBtn.addEventListener("click", function () {
                const firstModal = bootstrap.Modal.getInstance(deleteModal);
                firstModal.hide();

                finalNama.textContent = tagihanNama.textContent;
                finalKode.textContent = tagihanKode.textContent;
                finalSiswa.textContent = tagihanSiswa.textContent;

                deleteForm.action = "/admin/tagihan/" + tagihanId;

                const secondModal = new bootstrap.Modal(secondDeleteModal);
                secondModal.show();
            });
        });
    </script>
@endsection
