@extends('layouts.master')

@section('title', 'Pembayaran Tagihan')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap');

    * {
        font-family: 'Montserrat', sans-serif;
    }

    body {
        background-color: #f8f9fc;
    }

    .container-payment {
        margin: 20px auto;
        padding: 30px;
        max-width: 900px;
    }

    .box1, .box2 {
        height: 100%;
    }

    .card.box1 {
        background-color: #4e73df;
        color: #dbe2fc;
        border-radius: 0.5rem 0 0 0.5rem;
    }

    .card.box2 {
        background-color: #ffffff;
        border-radius: 0 0.5rem 0.5rem 0;
    }

    .nominal {
        font-size: 14px;
    }

    .badge {
        font-size: 14px;
    }

    .form-control {
        border: none;
        border-bottom: 2px solid #ccc;
        border-radius: 0;
        font-size: 14px;
        padding: 10px 0px;
        font-weight: 600;
        color: #495057;
    }

    .form-control:focus {
        box-shadow: none;
        border-bottom: 2px solid #4e73df;
    }

    .btn-primary {
        background-color: #4e73df;
        border: 1px solid #4e73df;
    }

    .btn-primary:hover {
        background-color: #2e59d9;
    }

    .inputWithIcon {
        position: relative;
    }

    .inputWithIcon span {
        position: absolute;
        right: 0px;
        bottom: 10px;
        color: #4e73df;
    }

    @media (max-width: 750px) {
        .card.box1, .card.box2 {
            border-radius: 0 !important;
        }
    }
</style>

<div class="container-payment bg-white rounded shadow-sm border-bottom-primary">
    <div class="mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h3 text-primary font-weight-bold mb-0">
                <i class="fas fa-money-check-alt"></i> Pembayaran Tagihan
            </h1>
        </div>
        <p class="text-muted mt-1">Halaman ini menampilkan detail tagihan dan form konfirmasi pembayaran.</p>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white py-3 d-flex justify-content-between align-items-center rounded-top">
            <h6 class="m-0 font-weight-bold">
                <i class="fas fa-info-circle"></i> Informasi Pembayaran
            </h6>
        </div>
    </div>

    <div class="row no-gutters">
        <!-- Informasi Tagihan -->
        <div class="col-md-5">
            <div class="card box1 p-4">
                <h5><i class="fas fa-file-invoice"></i> Informasi Tagihan</h5>
                <hr class="border-light">
                <p><strong>Nama:</strong> {{ $tagihan->nama }}</p>
                <p><strong>NIS:</strong> {{ $tagihan->nis }}</p>
                <p><strong>Kelas:</strong> {{ $tagihan->kelas }}</p>
                <p><strong>Jenis:</strong> {{ $tagihan->jenis }}</p>
                <p><strong>Jumlah Tagihan:</strong><span class="nominal"> Rp{{ number_format($tagihan->jumlah, 0, ',', '.') }}</span></p>
                <p><strong>Status:</strong> 
                    <span class="badge {{ $tagihan->status == 'SUDAH DIBAYAR' ? 'badge-success' : 'badge-danger' }}">
                        {{ $tagihan->status }}
                    </span>
                </p>
                <hr class="border-light">
                <small class="text-light"><i class="fas fa-info-circle"></i> Harap bayar sesuai jumlah tagihan.</small>
            </div>
        </div>

        <!-- Form Pembayaran -->
        <div class="col-md-7">
            <div class="card box2 p-4">
                <h5 class="mb-4 text-primary"><i class="fas fa-wallet"></i> Form Pembayaran</h5>

                @if($tagihan->status == 'BELUM DIBAYAR')
                <form action="{{ route('guru.tagihan.processPayment', $tagihan->id_tagihan) }}" method="POST">
                    @csrf
                    <div class="mb-3 inputWithIcon">
                        <label for="dibayar" class="form-label">Jumlah yang Dibayar</label>
                        <input type="text" class="form-control" id="dibayar" name="dibayar" placeholder="Rp 0" required>
                        <span class="fas fa-money-bill-wave"></span>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-2">
                        <i class="fas fa-check-circle"></i> Konfirmasi Pembayaran
                    </button>
                </form>
                @else
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> Tagihan ini sudah dibayar.
                </div>
                @endif

                <a href="{{ route('guru.tagihan.index') }}" class="btn btn-secondary w-100 mt-3">
                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar Tagihan
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    const input = document.getElementById('dibayar');
    const max = {{ $tagihan->jumlah }};

    input?.addEventListener('input', function(e) {
        let value = input.value.replace(/[^\d]/g, '');
        if (parseInt(value) > max) value = max;
        input.value = formatRupiah(value, 'Rp ');
    });

    function formatRupiah(angka, prefix) {
        let number_string = angka.toString().replace(/[^,\d]/g, ''),
            split   	 = number_string.split(','),
            sisa     	 = split[0].length % 3,
            rupiah     	 = split[0].substr(0, sisa),
            ribuan     	 = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? prefix + rupiah : '');
    }
</script>
@endsection
