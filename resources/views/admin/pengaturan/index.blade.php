@extends('layouts.master')
@section('title', 'Pengaturan')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Info Aplikasi</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card shadow mb-4 border-bottom-primary">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Data Aplikasi</h6>
        </div>

            <form action="{{ route('admin.pengaturan.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="container d-flex flex-column col-12 col-md-5">
                <div class="mt-2">
                    <label>Nama Aplikasi</label>
                    <input type="text" name="nama_aplikasi" class="form-control" value="{{ $pengaturan->nama_aplikasi }}">
                </div>

                <div class="mt-2">
                    <label>Ikon Sidebar</label>
                    <input type="text" name="ikon_sidebar" class="form-control" value="{{ $pengaturan->ikon_sidebar }}">
                </div>

                <div class="mt-2">
                    <label>Warna Sidebar</label>
                    <input type="text" name="tema" class="form-control" value="{{ $pengaturan->tema }}">
                </div>

                <div class="mt-2">
                    <label>Footer</label>
                    <input type="text" name="footer" class="form-control" value="{{ $pengaturan->footer }}">
                </div>

                <div class="mt-2 pb-4">
                    <label>Logo (opsional)</label><br>
                    <img src="{{ asset($pengaturan->logo ?? 'assets/img/logo-login/logo.png') }}" height="100" alt="Logo Sekarang"><br><br>
                    <input type="file" name="logo" class="form-control-file">
                </div>
            </div>

            <div class="container d-flex flex-column col-12 justify-content-start">
                <div class="d-flex mb-5 bg-gray-200">
                    <div class="mb-4 mt-4 text-center w-75">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
            </form>
    </div>
</div>
@endsection
