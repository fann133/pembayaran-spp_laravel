@extends('layouts.master')

@section('title', 'Tambah Guru')

@section('content')
<div class="container-fluid">
    <!-- Breadcrumb Navigation -->
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.guru.index') }}">Guru</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Guru</li>
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

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Data</h1>
    </div>

    <div class="card shadow mb-4 border-bottom-{{ $pengaturan->tema }}">
        <div class="card-header py-3 d-flex justify-content-center">
            <h6 class="m-0 font-weight-bold text-primary">Data Guru</h6>
        </div>

        
            <form action="{{ route('admin.guru.store') }}" method="POST">
                @csrf
                <div class="container d-flex flex-column col-12 col-md-5 justify-content-center">
                    <div class="mt-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukan Nama Lengkap" oninput="this.value = this.value.toUpperCase();">
                    </div>

                    <div class="mt-3">
                        <label for="nip" class="form-label">NIP</label>
                        <input type="text" name="nip" id="nip" class="form-control" placeholder="Masukan NIP">
                    </div>

                    <div class="mt-3">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" placeholder="Masukan Tempat Lahir">
                    </div>

                    <div class="mt-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control">
                    </div>

                    
                    <div class="mt-2">
                        <label class="form-label d-block">Jenis Kelamin</label>
                        
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki-laki" value="Laki-laki">
                            <label class="form-check-label" for="laki-laki">Laki-laki</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan">
                            <label class="form-check-label" for="perempuan">Perempuan</label>
                        </div>
                    </div>


                    <div class="mt-3">
                        <label for="agama" class="form-label">Agama</label>
                        <select name="agama" id="agama" class="form-control">
                            <option value="">Pilih Agama</option>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Konghucu">Konghucu</option>
                        </select>
                    </div>


                    <div class="mt-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">-- Pilih Status --</option>
                            <option value="TETAP">TETAP</option>
                            <option value="HONOR">HONOR</option>
                            <option value="MAGANG">MAGANG</option>
                        </select>
                    </div>

                    <div class="pb-4 mt-3">
                        <label for="role_id" class="form-label">Jabatan</label>
                        <select name="role_id" id="role_id" class="form-control">
                            <option value="">-- Pilih Jabatan --</option>
                            <option value="3">Guru</option>
                            <option value="4">Bendahara</option>
                            <option value="5">Kepala Sekolah</option>
                        </select>
                    </div>
                </div>
                
                    <div class="container d-flex flex-column col-12 justify-content-start">
                        <div class="d-flex mb-5 bg-gray-200">
                            <div class="mb-4 mt-4 text-center w-75">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('admin.guru.index') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </div>
                    </div>
            </form>

    </div>
</div>
@endsection
