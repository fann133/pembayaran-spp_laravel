@extends('layouts.master')

@section('title', 'Tambah Biaya')

@section('content')
<div class="container-fluid">

    <!-- Breadcrumb Navigation -->
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('bendahara.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('bendahara.biaya.index') }}">Biaya</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Biaya</li>
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
        <h1 class="h3 mb-0 text-gray-800">Tambah Data</h1>
    </div>

    <div class="card shadow mb-4 border-bottom-primary">
        <div class="card-header py-3 d-flex justify-content-center">
            <h6 class="m-0 font-weight-bold text-primary">Data Biaya</h6>
        </div>
            <form action="{{ route('bendahara.biaya.store') }}" method="POST">
                @csrf
                <div class="container d-flex flex-column col-12 col-md-5 justify-content-center">
                    <div class="mt-2">
                        <label for="nama" class="form-label">Nama Biaya</label> <!-- ✅ Tambah Nama -->
                        <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukan Nama Biaya" required>
                    </div>

                    <div class="mt-2">
                        <label for="jenis" class="form-label">Jenis Biaya</label>
                        <select id="jenis" name="jenis" class="form-control" required> <!-- ✅ Ubah ke Select -->
                            <option value="SPP">SPP</option>
                            <option value="NON-SPP">NON-SPP</option>
                        </select>
                    </div>

                    <div class="mt-2">
                        <label class="form-label">Kode Biaya</label>
                        <input type="text" name="kode" class="form-control" placeholder="Masukan Kode Biaya" required>
                    </div>

                    <div class="mt-2">
                        <label class="form-label">Jumlah</label>
                        <input type="text" name="jumlah" id="rupiah" class="form-control" placeholder="Masukan Jumlah Biaya" required>
                    </div>

                    <div class="mt-2">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="AKTIF">AKTIF</option>
                            <option value="NON AKTIF">NON AKTIF</option>
                        </select>
                    </div>

                    <div class="mt-2">
                        <label class="form-label">Kategori</label>
                        <select name="kategori" class="form-control" required>
                            <option value="Atas">Atas</option>
                            <option value="Menengah">Menengah</option>
                            <option value="Bawah">Bawah</option>
                        </select>
                    </div>

                    
                    <div class="mt-2  pb-4">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control"></textarea>
                    </div>
                </div>

                <div class="container d-flex flex-column col-12 justify-content-start">
                    <div class="d-flex mb-5 bg-gray-200">
                        <div class="mb-4 mt-4 text-center w-75">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('bendahara.biaya.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </div>
            </form>
    </div>
</div>
@endsection
