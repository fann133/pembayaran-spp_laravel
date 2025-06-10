@extends('layouts.master')
@section('title', $pengaturan->nama_aplikasi . ' | Profil Sekolah')

@section('content')
<div class="container-fluid">

    <!-- Breadcrumb Navigation -->
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Profil</li>
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
        <h1 class="h3 mb-0 text-gray-800">Profil Sekolah</h1>
    </div>

    <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <!-- Form Utama -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4 border-bottom-{{ $pengaturan->tema }}">
                    <div class="card-header py-3 d-flex justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Profil Sekolah</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="nama_sekolah">Nama Sekolah</label>
                                <input type="text" name="nama_sekolah" id="nama_sekolah" class="form-control" value="{{ old('nama_sekolah', $profil->nama_sekolah ?? '') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="naungan">Naungan</label>
                                <input type="text" name="naungan" id="naungan" class="form-control" value="{{ old('naungan', $profil->naungan ?? '') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="kepala_sekolah">Kepala Sekolah</label>
                                <input type="text" name="kepala_sekolah" id="kepala_sekolah" class="form-control" value="{{ old('kepala_sekolah', $profil->kepala_sekolah ?? '') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="nip">NIP Kepala Sekolah</label>
                                <input type="text" name="nip" id="nip" class="form-control" value="{{ old('nip', $profil->nip ?? '') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="nsm">NSM</label>
                                <input type="text" name="nsm" id="nsm" class="form-control" value="{{ old('nsm', $profil->nsm ?? '') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="npsn">NPSN</label>
                                <input type="text" name="npsn" id="npsn" class="form-control" value="{{ old('npsn', $profil->npsn ?? '') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="akreditasi">Akreditasi</label>
                                <input type="text" name="akreditasi" id="akreditasi" class="form-control" value="{{ old('akreditasi', $profil->akreditasi ?? '') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="sk">SK</label>
                                <input type="text" name="sk" id="sk" class="form-control" value="{{ old('sk', $profil->sk ?? '') }}">
                            </div>
                        </div>

                        <div class="row">                            
                            <div class="form-group col-md-6">
                                <label for="tahun_pelajaran">Tahun Pelajaran</label>
                                <input type="text" name="tahun_pelajaran" id="tahun_pelajaran" class="form-control" value="{{ old('tahun_pelajaran', $profil->tahun_pelajaran ?? '') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="kode_pos">Kode Pos</label>
                                <input type="text" name="kode_pos" id="kode_pos" class="form-control" value="{{ old('kode_pos', $profil->kode_pos ?? '') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="telepon">Telepon</label>
                                <input type="text" name="telepon" id="telepon" class="form-control" value="{{ old('telepon', $profil->telepon ?? '') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $profil->email ?? '') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="website">Website</label>
                                <input type="text" name="website" id="website" class="form-control" value="{{ old('website', $profil->website ?? '') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="alamat_sekolah">Alamat Sekolah</label>
                                <input type="text" name="alamat_sekolah" id="alamat_sekolah" class="form-control" value="{{ old('alamat_sekolah', $profil->alamat_sekolah ?? '') }}">
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="text-left ml-4 mb-5">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>

            <!-- Form Logo -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4 border-bottom-{{ $pengaturan->tema }}">
                    <div class="card-header py-3 d-flex justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Logo Sekolah</h6>
                    </div>
                    <div class="card-body text-center">
                        @if(!empty($profil->logo))
                            <img src="{{ asset('assets/img/profil-sekolah/' . $profil->logo) }}" alt="Logo Sekolah" class="img-fluid mb-3" width="150">
                        @endif

                        <div class="form-group text-center">
                            <label for="logo" class="d-block mb-2">Upload Logo</label>
                            <div class="custom-file" style="max-width: 250px; margin: 0 auto;">
                                <input type="file" class="custom-file-input" id="logo" name="logo">
                                <label class="custom-file-label text-left" for="logo">Pilih file</label>
                            </div>
                        </div>
                                               
                    </div>
                </div>

                <div class="card shadow mb-4 border-bottom-{{ $pengaturan->tema }}">
                    <div class="card-header py-3 d-flex justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Logo Naungan</h6>
                    </div>
                    <div class="card-body text-center">
                        @if(!empty($profil->logo_naungan))
                            <img src="{{ asset('assets/img/profil-sekolah/' . $profil->logo_naungan) }}" alt="Logo Naungan" class="img-fluid mb-3" width="150">
                        @endif
                
                        <div class="form-group text-center">
                            <label for="logo_naungan" class="d-block mb-2">Upload Logo</label>
                            <div class="custom-file" style="max-width: 250px; margin: 0 auto;">
                                <input type="file" class="custom-file-input" id="logo_naungan" name="logo_naungan" aria-describedby="logo_naungan">
                                <label class="custom-file-label text-left" for="logo_naungan">Pilih file</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            

        </div>

    </form>
</div>
@endsection
