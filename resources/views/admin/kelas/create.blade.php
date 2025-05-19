@extends('layouts.master')

@section('title', 'Tambah Kelas')

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
        <h1 class="h3 mb-0 text-gray-800">Tambah Data</h1>
    </div>


        <div class="card shadow mb-4 border-bottom-{{ $pengaturan->tema }}">
            <div class="card-header py-3 d-flex justify-content-center">
                <h6 class="m-0 font-weight-bold text-primary">Data Kelas</h6>
            </div>

                    <form action="{{ route('admin.kelas.store') }}" method="POST">
                        @csrf
                        <div class="container d-flex flex-column col-12 col-md-5 justify-content-center">
                            <div class="mt-2">
                                <label for="nama" class="form-label">Nama Kelas</label>
                                <input type="text" id="nama" name="nama" class="form-control">
                            </div>


                            <div class="mt-2">
                                <label for="kode_kelas" class="form-label">Kode Kelas</label>
                                <input type="text" name="kode_kelas" class="form-control">
                            </div>


                            <div class="mt-2">
                                <label for="pengampu_kelas" class="form-label">Guru Pengampu</label>
                                <select name="pengampu_kelas" class="form-control">
                                    <option value="">-- Pilih Guru Pengampu --</option>
                                    @foreach ($gurus as $guru)
                                        <option value="{{ $guru->id_guru }}" 
                                            {{ \App\Models\Kelas::where('pengampu_kelas', $guru->id_guru)->exists() ? 'disabled' : '' }}>
                                            {{ $guru->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mt-2 pb-4">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="container d-flex flex-column col-12 justify-content-start">
                            <div class="d-flex mb-5 bg-gray-200">
                                <div class="mb-4 mt-4 text-center w-75">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="{{ route('admin.kelas.index') }}" class="btn btn-secondary">Batal</a>
                                </div>
                            </div>
                        </div>
                    </form>
        </div>
</div>
@endsection
