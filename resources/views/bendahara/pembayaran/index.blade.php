@extends('layouts.master')

@section('title', 'Data Pembayaran')
@section('content')
<div class="container-fluid">

  <!-- Breadcrumb Navigation -->
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('bendahara.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Riwayat Pembayaran</li>
    </ol>
    </nav>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-times-circle"></i> {{ session('error') }}
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pembayaran</h1>
    </div>


        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Pembayaran</h6>
                <!-- Dropdown Menu -->
                <div class="dropdown no-arrow">
                  <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuTools" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bars fa-sm fa-fw text-gray-400"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuTools">
                    <div class="dropdown-header">Export Options:</div>

                    <!-- Tombol Print PDF -->
                    <button type="submit" form="printForm" class="dropdown-item">
                      <i class="fas fa-print text-gray-600"></i> Print PDF
                    </button>

                    <!-- Tombol Ekstrak Excel -->
                    <button type="button" class="dropdown-item" id="excelBtn">
                      <i class="fas fa-file-excel text-success"></i> Ekstrak Excel
                    </button>
                  </div>
                </div>
            </div>
            
            <div class="card-body border-bottom-primary">
              <form id="excelForm" method="POST" action="{{ route('bendahara.pembayaran.exportExcel') }}" style="display: none;">
                @csrf
                  @foreach ($pembayaran as $p)
                      <input type="checkbox" name="pembayaran_id[]" class="pembayaran-checkbox" value="{{ $p->id_pembayaran }}">
                  @endforeach
              </form>
              <form id="printForm" method="POST" action="{{ route('bendahara.pembayaran.printAll') }}" target="_blank">
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
                                <th>Tanggal</th>
                                <th>Nama</th>
                                <th>Pembayaran</th>
                                <th>Jenis</th>
                                <th>Tagihan</th>
                                <th>Dibayar</th>
                                <th>Piutang</th>
                                <th>Status</th>
                                <th>Dibayar Oleh</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pembayaran as $key => $item)
                            <tr>
                                <td class="text-center align-middle">
                                  <div class="form-check d-flex align-items-center justify-content-center">
                                      <input class="form-check-input tagihan-checkbox" style="width: 20px; height: 20px;" type="checkbox" name="pembayaran_id[]" value="{{ $item->id_pembayaran }}" id="pembayaran_{{ $key }}">
                                      <label class="form-check-label" for="pembayaran_{{ $key }}" style="margin-left: 30px;">{{ $key + 1 }}</label>
                                  </div>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_bayar)->translatedFormat('d F Y') }}</td>
                                <td>{{ $item->nama }} <br><span class="font-weight-bold">{{ $item->nis }}</span> [{{ $item->kelas }}]</td>
                                <td>{{ $item->nama_pembayaran }} [<span class="font-weight-bold">{{ $item->kode }}</span>] <br><span class="font-weight-bold">{{ $item->bulan }}</span></td>
                                <td>{{ $item->jenis }}</td>
                                <td>Rp{{ number_format($item->jumlah_tagihan, 0, ',', '.') }}</td>
                                <td>Rp{{ number_format($item->dibayar, 0, ',', '.') }}</td>
                                <td>Rp{{ number_format($item->piutang, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge {{ $item->status == 'LUNAS' ? 'bg-success' : 'bg-danger' }} text-light">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td>{{ $item->user->name }}</td>
                                <td>
                                  <div class="d-flex justify-content-center align-items-center">
                                    <a href="{{ route('bendahara.pembayaran.print', $item->id_pembayaran) }}" target="_blank" class="btn btn-secondary btn-circle btn-sm mr-1">
                                        <i class="fas fa-print"></i>
                                    </a> 
                                    
                                    <a href="#" class="btn btn-danger btn-circle btn-sm delete-btn"
                                      data-bs-toggle="modal"
                                      data-bs-target="#deleteModal"
                                      data-id="{{ $item->id_pembayaran }}"
                                      data-nama="{{ $item->nama_pembayaran }}"
                                      data-kode="{{ $item->kode }}"
                                      data-siswa="{{ $item->nama }}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                  </div>
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

<!-- Modal Konfirmasi Hapus Pembayaran -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
        <button class="close" type="button" data-bs-dismiss="modal"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin menghapus pembayaran <strong id="pembayaranNama"></strong> | 
        <strong id="pembayaranKode"></strong> milik siswa <strong id="pembayaranSiswa"></strong>?
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
        Ini peringatan terakhir! Yakin ingin menghapus pembayaran <strong id="finalPembayaranNama"></strong> | 
        <strong id="finalPembayaranKode"></strong> milik siswa <strong id="finalPembayaranSiswa"></strong>?
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
            const checkboxes = document.querySelectorAll('.pembayaran-checkbox');

            checkAll.addEventListener('change', function () {
                checkboxes.forEach(cb => cb.checked = this.checked);
            });
        });

        document.getElementById('checkAll').addEventListener('change', function () {
            let checkboxes = document.querySelectorAll('input[name="pembayaran_id[]"]');
            checkboxes.forEach(cb => cb.checked = this.checked);
        });


    // Modal Hapus Pembayaran
    document.addEventListener("DOMContentLoaded", function () {
        const deleteModal = document.getElementById("deleteModal");
        const secondDeleteModal = document.getElementById("secondDeleteModal");
        const deleteForm = document.getElementById("deleteForm");

        const pembayaranNama = document.getElementById("pembayaranNama");
        const pembayaranKode = document.getElementById("pembayaranKode");
        const pembayaranSiswa = document.getElementById("pembayaranSiswa");

        const finalNama = document.getElementById("finalPembayaranNama");
        const finalKode = document.getElementById("finalPembayaranKode");
        const finalSiswa = document.getElementById("finalPembayaranSiswa");

        const nextBtn = document.getElementById("nextConfirmation");

        let pembayaranId = "";

        deleteModal.addEventListener("show.bs.modal", function (event) {
            const button = event.relatedTarget;
            pembayaranId = button.getAttribute("data-id");
            const nama = button.getAttribute("data-nama");
            const kode = button.getAttribute("data-kode");
            const siswa = button.getAttribute("data-siswa");

            pembayaranNama.textContent = nama;
            pembayaranKode.textContent = kode;
            pembayaranSiswa.textContent = siswa;
        });

        nextBtn.addEventListener("click", function () {
            const firstModal = bootstrap.Modal.getInstance(deleteModal);
            firstModal.hide();

            finalNama.textContent = pembayaranNama.textContent;
            finalKode.textContent = pembayaranKode.textContent;
            finalSiswa.textContent = pembayaranSiswa.textContent;

            deleteForm.action = "/bendahara/pembayaran/" + pembayaranId;

            const secondModal = new bootstrap.Modal(secondDeleteModal);
            secondModal.show();
        });
    });


    document.addEventListener("DOMContentLoaded", function () {
        const checkAll = document.getElementById('checkAll');
        const checkboxes = document.querySelectorAll('input[name="pembayaran_id[]"]');

        document.querySelector('#excelBtn')?.addEventListener('click', function (e) {
            e.preventDefault();

            const excelForm = document.querySelector('#excelForm');

            // Hapus input tersembunyi sebelumnya
            excelForm.querySelectorAll('input[name="pembayaran_id[]"]').forEach(el => el.remove());

            const checked = document.querySelectorAll('#printForm input[name="pembayaran_id[]"]:checked');

            // Jika "checkAll" dicentang → kirim semua data
            if (checkAll.checked) {
                checkboxes.forEach(input => {
                    const hidden = document.createElement('input');
                    hidden.type = 'hidden';
                    hidden.name = 'pembayaran_id[]';
                    hidden.value = input.value;
                    excelForm.appendChild(hidden);
                });
            } else {
                // Kirim hanya yang dicentang
                checked.forEach(input => {
                    const hidden = document.createElement('input');
                    hidden.type = 'hidden';
                    hidden.name = 'pembayaran_id[]';
                    hidden.value = input.value;
                    excelForm.appendChild(hidden);
                });
            }

            // Submit
            excelForm.submit();
        });
    });

  </script>
  

@endsection