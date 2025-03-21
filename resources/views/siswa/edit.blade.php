@extends('layouts.master')

@section('title', 'Ubah Siswa')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ubah Data</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-center">
            <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
        </div>

        <form action="{{ route('siswa.update', $siswa->id_siswa) }}" method="POST">
            @csrf
            <div class="container d-flex flex-column col-5 justify-content-start">
                <div class="mt-2">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control form-control-sm" value="{{ $siswa->nama }}" required>
                </div>
                
                <div class="mt-2">
                    <label class="form-label">NIS</label>
                    <input type="text" name="nis" class="form-control form-control-sm w-75" value="{{ $siswa->nis }}" required>
                </div>
            
                <div class="mt-2">
                    <label class="form-label">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control form-control-sm w-50" value="{{ $siswa->tempat_lahir }}" required>
                </div>
            
                <div class="mt-2">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control form-control-sm w-25" value="{{ $siswa->tanggal_lahir }}" required>
                </div>
            
                <div class="mt-2">
                    <label class="form-label">Kelas</label>
                    <input type="text" name="kelas" class="form-control form-control-sm w-50" value="{{ $siswa->kelas }}" required>
                </div>
            
                <div class="mt-2">
                    <label class="form-label">Kategori</label>
                    <select name="category" class="form-control form-control-sm w-50">
                        <option value="atas" {{ $siswa->category == 'atas' ? 'selected' : '' }}>Atas</option>
                        <option value="menengah" {{ $siswa->category == 'menengah' ? 'selected' : '' }}>Menengah</option>
                        <option value="bawah" {{ $siswa->category == 'bawah' ? 'selected' : '' }}>Bawah</option>
                    </select>
                </div>
            
                <div class="mt-2 pb-4">
                    <label class="form-label">Status</label>
                    <select name="status" id="status" class="form-control form-control-sm w-50">
                        <option value="AKTIF" {{ $siswa->status == 'AKTIF' ? 'selected' : '' }}>AKTIF</option>
                        <option value="LULUS" {{ $siswa->status == 'LULUS' ? 'selected' : '' }}>LULUS</option>
                        <option value="PINDAHAN" {{ $siswa->status == 'PINDAHAN' ? 'selected' : '' }}>PINDAHAN</option>
                        <option value="KELUAR" {{ $siswa->status == 'KELUAR' ? 'selected' : '' }}>KELUAR</option>
                    </select>
                </div>
            </div>
            <div class="container d-flex flex-column col-12 justify-content-start">
                <div class="d-flex mb-5 bg-gray-200">
                    <div class="mb-4 mt-4 text-center w-75">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
