@extends('admin.layouts.master')
@section('title', 'Profil Sekolah')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Profil Sekolah</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <!-- Form Utama -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4 border-bottom-primary">
                    <div class="card-header py-3 d-flex justify-content-center">
                        <h6 class="m-0 font-weight-bold text-primary">Profil Sekolah</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Nama Sekolah</label>
                                <input type="text" name="nama_sekolah" class="form-control" value="{{ old('nama_sekolah', $profil->nama_sekolah ?? '') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Kepala Sekolah</label>
                                <input type="text" name="kepala_sekolah" class="form-control" value="{{ old('kepala_sekolah', $profil->kepala_sekolah ?? '') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>NPSN</label>
                                <input type="text" name="npsn" class="form-control" value="{{ old('npsn', $profil->npsn ?? '') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Tahun Pelajaran</label>
                                <input type="text" name="tahun_pelajaran" class="form-control" value="{{ old('tahun_pelajaran', $profil->tahun_pelajaran ?? '') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Telepon</label>
                                <input type="text" name="telepon" class="form-control" value="{{ old('telepon', $profil->telepon ?? '') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $profil->email ?? '') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Website</label>
                                <input type="text" name="website" class="form-control" value="{{ old('website', $profil->website ?? '') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Alamat Sekolah</label>
                                <input type="text" name="alamat_sekolah" class="form-control" value="{{ old('alamat_sekolah', $profil->alamat_sekolah ?? '') }}">
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
                    <div class="card-header py-3 d-flex justify-content-center">
                        <h6 class="m-0 font-weight-bold text-primary">Logo Sekolah</h6>
                    </div>
                    <div class="card-body text-center">
                        @if(!empty($profil->logo))
                            <img src="{{ asset('assets/img/profil-sekolah/' . $profil->logo) }}" alt="Logo Sekolah" class="img-fluid mb-3" width="150">
                        @endif

                        <div class="form-group">
                            <label for="logo" class="d-block">Upload Logo Baru</label>
                            <input type="file" name="logo" id="logo" class="form-control-file mt-2">
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </form>
</div>
@endsection
