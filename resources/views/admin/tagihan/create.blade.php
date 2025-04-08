@extends('admin.layouts.master')

@section('title', 'Tambah Tagihan')

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
        <h1 class="h3 mb-0 text-gray-800">Tambah Data</h1>
    </div>

    <div class="card shadow mb-4 border-bottom-primary">
        <div class="card-header py-3 d-flex justify-content-center">
            <h6 class="m-0 font-weight-bold text-primary">Data Tagihan</h6>
        </div>

            <form action="{{ route('admin.tagihan.store') }}" method="POST">
                @csrf

                <div class="container d-flex flex-column col-12 col-md-5 justify-content-center">
                    <!-- Nama Siswa -->
                    <div class="mt-2">
                        <label for="id_siswa">Nama Siswa</label>
                        <select class="form-control" name="id_siswa" id="id_siswa" required>
                            <option value="">-- Pilih Siswa --</option>
                            @foreach ($siswas as $siswa)
                                <option value="{{ $siswa->id_siswa }}" data-nama="{{ $siswa->nama }}" data-kelas="{{ $siswa->kelas }}" data-nis="{{ $siswa->nis }}">
                                    {{ $siswa->nama }} - {{ $siswa->nis }} [{{ $siswa->kelas }}]
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Nama, Kelas, NIS -->
                    <input type="hidden" id="nama" name="nama">
                    <input type="hidden" id="kelas" name="kelas">
                    <input type="hidden" id="nis" name="nis">

                    <!-- Jenis Pembayaran -->
                    <div class="mt-2">
                        <label for="jenis_pembayaran">Jenis Pembayaran</label>
                        <select class="form-control" name="jenis_pembayaran" id="jenis_pembayaran" required>
                            <option value="">-- Pilih Jenis Pembayaran --</option>
                            <option value="SPP">SPP</option>
                            <option value="NON-SPP">Non-SPP</option>
                        </select>
                    </div>

                    <!-- Input Hidden untuk id_biaya jika SPP -->
                    <input type="hidden" id="id_biaya" name="id_biaya">

                    <!-- Pilihan Biaya (hanya tampil jika Non-SPP dipilih) -->
                    <div class="mt-2" id="id_biaya_group" style="display: none;">
                        <label for="id_biaya">Nama Pembayaran</label>
                        <select class="form-control" name="id_biaya" id="id_biaya">
                            <option value="">-- Pilih Pembayaran --</option>
                            @foreach ($biayas->where('jenis', 'NON-SPP') as $biaya)
                                <option value="{{ $biaya->id_biaya }}">{{ $biaya->nama }} - Rp{{ number_format($biaya->jumlah, 0, ',', '.') }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Bulan (hanya tampil jika SPP) -->
                    <div class="mt-2" id="bulan-group" style="display: none;">
                        <label for="bulan">Bulan</label>
                        <select class="form-control" name="bulan" id="bulan">
                            <option value="">-- Pilih Bulan --</option>
                            @foreach (["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"] as $bulan)
                                <option value="{{ $bulan }}">{{ $bulan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Status -->
                    <div class="mt-2 pb-4">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" required>
                            <option value="BELUM DIBAYAR">Belum Dibayar</option>
                            <option value="SUDAH DIBAYAR">Sudah Dibayar</option>
                        </select>
                    </div>
                </div>

                <div class="container d-flex flex-column col-12 justify-content-start">
                    <div class="d-flex mb-5 bg-gray-200">
                        <div class="mb-4 mt-4 text-center w-75">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('admin.tagihan.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </div>
            </form>
    </div>
</div>

<script>
document.getElementById('id_siswa').addEventListener('change', function() {
    let selectedOption = this.options[this.selectedIndex];
    let kategori = selectedOption.getAttribute('data-kategori');
    let nama = selectedOption.getAttribute('data-nama');
    let nis = selectedOption.getAttribute('data-nis');
    let kelas = selectedOption.getAttribute('data-kelas');
    
    document.getElementById('nama').value = nama;
    document.getElementById('nis').value = nis;
    document.getElementById('kelas').value = kelas;

    let jenisPembayaran = document.getElementById('jenis_pembayaran').value;
    let idBiayaInput = document.getElementById('id_biaya');

    if (jenisPembayaran === 'SPP') {
        fetch(`/get-biaya?spp=1&kategori=${kategori}`)
            .then(response => response.json())
            .then(data => {
                if (data.id_biaya) {
                    idBiayaInput.value = data.id_biaya;
                }
            });
    } else {
        fetch(`/get-biaya?spp=0&kategori=${kategori}`)
            .then(response => response.json())
            .then(data => {
                let selectPembayaran = document.getElementById('id_biaya_select');
                selectPembayaran.innerHTML = "";
                data.forEach(biaya => {
                    let option = document.createElement("option");
                    option.value = biaya.id_biaya;
                    option.textContent = biaya.nama;
                    selectPembayaran.appendChild(option);
                });
                idBiayaInput.value = selectPembayaran.value;
            });
    }
});

document.getElementById('jenis_pembayaran').addEventListener('change', function() {
    let kategori = document.getElementById('id_siswa').options[document.getElementById('id_siswa').selectedIndex].getAttribute('data-kategori');
    let idBiayaInput = document.getElementById('id_biaya');

    if (this.value === 'SPP') {
        document.getElementById('bulan-group').style.display = 'block';
        document.getElementById('id_biaya_group').style.display = 'none';
        
        fetch(`/get-biaya?spp=1&kategori=${kategori}`)
            .then(response => response.json())
            .then(data => {
                idBiayaInput.value = data.id_biaya;
            });

    } else {
        document.getElementById('bulan-group').style.display = 'none';
        document.getElementById('id_biaya_group').style.display = 'block';

        fetch(`/get-biaya?spp=0&kategori=${kategori}`)
            .then(response => response.json())
            .then(data => {
                let selectPembayaran = document.getElementById('id_biaya_select');
                selectPembayaran.innerHTML = "";
                data.forEach(biaya => {
                    let option = document.createElement("option");
                    option.value = biaya.id_biaya;
                    option.textContent = biaya.nama;
                    selectPembayaran.appendChild(option);
                });
                idBiayaInput.value = selectPembayaran.value;
            });
    }
});
</script>




@endsection