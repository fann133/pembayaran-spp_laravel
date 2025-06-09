@extends('layouts.master')

@section('title', $pengaturan->nama_aplikasi . ' | Ubah Guru')

@section('content')
<div class="container-fluid">
    <!-- Breadcrumb Navigation -->
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.guru.index') }}">Guru</a></li>
        <li class="breadcrumb-item active" aria-current="page">Ubah Guru</li>
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
        <h1 class="h3 mb-0 text-gray-800">Ubah Data</h1>
    </div>


    <div class="card shadow mb-4 border-bottom-{{ $pengaturan->tema }}">
        <div class="card-header py-3 d-flex justify-content-center">
            <h6 class="m-0 font-weight-bold text-primary">Data Guru</h6>
        </div>
        
            <form action="{{ route('admin.guru.update', $guru->id_guru) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="container d-flex flex-column col-12 col-md-5 justify-content-center">
                    <div class="mt-3">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $guru->nama) }}">
                    </div>


                    <div class="mt-3">
                        <label for="nip">NIP</label>
                        <input type="text" name="nip" id="nip" class="form-control" value="{{ old('nip', $guru->nip) }}">
                    </div>


                    <div class="mt-3">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="{{ old('tempat_lahir', $guru->tempat_lahir) }}">
                    </div>

                    <div class="mt-3">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $guru->tanggal_lahir) }}">
                    </div>


                    <div class="mt-2">
                        <label class="form-label d-block">Jenis Kelamin</label>
                        
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki-laki" value="Laki-laki" {{ $guru->jenis_kelamin == 'Laki-laki' ? 'checked' : '' }}>
                            <label class="form-check-label" for="laki-laki">Laki-laki</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan" {{ $guru->jenis_kelamin == 'Perempuan' ? 'checked' : '' }}>
                            <label class="form-check-label" for="perempuan">Perempuan</label>
                        </div>
                    </div>

                    <div class="mt-3">
                        <label for="agama" class="form-label">Agama</label>
                        <select name="agama" id="agama" class="form-control">
                            <option value="Islam" {{ $guru->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                            <option value="Kristen" {{ $guru->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                            <option value="Katolik" {{ $guru->agama == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                            <option value="Hindu" {{ $guru->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="Buddha" {{ $guru->agama == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                            <option value="Konghucu" {{ $guru->agama == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                        </select>
                    </div>

                    <div class="mt-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="TETAP" {{ $guru->status == 'TETAP' ? 'selected' : '' }}>TETAP</option>
                            <option value="HONOR" {{ $guru->status == 'HONOR' ? 'selected' : '' }}>HONOR</option>
                            <option value="MAGANG" {{ $guru->status == 'MAGANG' ? 'selected' : '' }}>MAGANG</option>
                        </select>
                    </div>

                    <div class="mt-3 pb-4">
                        <label for="role_id">Role</label>
                        <select name="role_id" id="role_id" class="form-control">
                            <option value="3" {{ $guru->role_id == '3' ? 'selected' : '' }}>Guru</option>
                            <option value="4" {{ $guru->role_id == '4' ? 'selected' : '' }}>Bendahara</option>
                            <option value="5" {{ $guru->role_id == '5' ? 'selected' : '' }}>Kepala Sekolah</option>
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
