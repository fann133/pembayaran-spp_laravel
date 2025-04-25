@extends('layouts.master')
@section('title', 'Profil Sekolah')

@section('content')
<div class="container-fluid">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
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
                <div class="card shadow mb-4 border-bottom-primary">
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
                                <label for="kepala_sekolah">Kepala Sekolah</label>
                                <input type="text" name="kepala_sekolah" id="kepala_sekolah" class="form-control" value="{{ old('kepala_sekolah', $profil->kepala_sekolah ?? '') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="npsn">NPSN</label>
                                <input type="text" name="npsn" id="npsn" class="form-control" value="{{ old('npsn', $profil->npsn ?? '') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="tahun_pelajaran">Tahun Pelajaran</label>
                                <input type="text" name="tahun_pelajaran" id="tahun_pelajaran" class="form-control" value="{{ old('tahun_pelajaran', $profil->tahun_pelajaran ?? '') }}">
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
                    <div class="text-center mb-5">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>

            <!-- Form Logo -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4 border-bottom-primary">
                    <div class="card-header py-3 d-flex justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Logo Sekolah</h6>
                    </div>
                    <div class="card-body text-center">
                        @if(!empty($profil->logo))
                            <img src="{{ asset('assets/img/profil-sekolah/' . $profil->logo) }}" alt="Logo Sekolah" class="img-fluid mb-3" width="150">
                        @endif

                        <div class="form-group text-center">
                            <label for="logo" class="d-block">Upload Logo Baru</label>
                            <input type="file" name="logo" id="logo" class="form-control-file mt-2 d-block mx-auto" style="max-width: 250px;">
                        </div>
                                               
                    </div>
                </div>
            </div>

        </div>

    </form>
</div>
@endsection
