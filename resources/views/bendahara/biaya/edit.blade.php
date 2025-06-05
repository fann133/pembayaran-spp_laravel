@extends('layouts.master')

@section('title', 'Ubah Biaya')

@section('content')
<div class="container-fluid">

    <!-- Breadcrumb Navigation -->
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('bendahara.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('bendahara.biaya.index') }}">Biaya</a></li>
        <li class="breadcrumb-item active" aria-current="page">Ubah Biaya</li>
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
        <h1 class="h3 mb-0 text-gray-800">Ubah Data</h1>
    </div>

    <div class="card shadow mb-4 border-bottom-primary">
        <div class="card-header py-3 d-flex justify-content-center">
            <h6 class="m-0 font-weight-bold text-primary">Data Biaya</h6>
        </div>
            <form action="{{ route('bendahara.biaya.update', $biaya->id_biaya) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="container d-flex flex-column col-12 col-md-5 justify-content-center">
                    <div class="mt-2">
                        <label class="form-label">Nama Biaya</label>
                        <input type="text" name="nama" class="form-control" value="{{ $biaya->nama }}" required>
                    </div>

                    <div class="mt-2">
                        <label class="form-label">Jenis Biaya</label>
                        <select name="jenis" class="form-control" required>
                            <option value="SPP" {{ $biaya->jenis == 'SPP' ? 'selected' : '' }}>SPP</option>
                            <option value="NON-SPP" {{ $biaya->jenis == 'NON-SPP' ? 'selected' : '' }}>Non-SPP</option>
                        </select>
                    </div>

                    <div class="mt-2">
                        <label class="form-label">Kode Biaya</label>
                        <input type="text" name="kode" class="form-control" value="{{ $biaya->kode }}" required>
                    </div>

                    <div class="mt-2">
                        <label class="form-label">Jumlah</label>
                        <input type="text" name="jumlah" class="form-control" value="{{  number_format($biaya->jumlah, 0, ',', '.') }}" required>
                    </div>

                    <div class="mt-2">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="AKTIF" {{ $biaya->status == 'AKTIF' ? 'selected' : '' }}>AKTIF</option>
                            <option value="NON AKTIF" {{ $biaya->status == 'NON AKTIF' ? 'selected' : '' }}>NON AKTIF</option>
                        </select>
                    </div>

                    <div class="mt-2">
                        <label class="form-label">Kategori</label>
                        <select name="kategori" class="form-control" required>
                            <option value="Atas" {{ $biaya->kategori == 'Atas' ? 'selected' : '' }}>Atas</option>
                            <option value="Menengah" {{ $biaya->kategori == 'Menengah' ? 'selected' : '' }}>Menengah</option>
                            <option value="Bawah" {{ $biaya->kategori == 'Bawah' ? 'selected' : '' }}>Bawah</option>
                        </select>
                    </div>

                    <div class="mt-2 pb-4">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control">{{ $biaya->deskripsi }}</textarea>
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
