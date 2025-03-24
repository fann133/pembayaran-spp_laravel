@extends('admin.layouts.master')

@section('title', 'Tambah Siswa')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Data</h1>
    </div>

    <div class="card shadow mb-4 border-bottom-primary">
        <div class="card-header py-3 d-flex justify-content-center">
            <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
        </div>

        <form action="{{ route('admin.siswa.store') }}" method="POST">
            @csrf
            <div class="container d-flex flex-column col-5 justify-content-start">
                <div class="mt-2">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control form-control-sm" placeholder="Masukan Nama" required>
                </div>
                
                <div class="mt-2">
                    <label class="form-label">NIS</label>
                    <input type="text" name="nis" class="form-control form-control-sm w-75" placeholder="Masukan NIS" required>
                </div>
            
                <div class="mt-2">
                    <label class="form-label">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control form-control-sm w-50" placeholder="Masukan Tempat Lahir" required>
                </div>
            
                <div class="mt-2">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control form-control-sm w-25" required>
                </div>
            
                <div class="mt-2">
                    <label class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control form-control-sm w-50">
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

                <div class="mt-2">
                    <label class="form-label">Kelas</label>
                    <select name="kelas" class="form-control form-control-sm w-50" required>
                        <option value="">Pilih Kelas</option>
                        @foreach ($kelas as $k)
                            <option value="{{ $k->id_kelas }}">{{ $k->nama }}</option>
                        @endforeach
                    </select>
                </div>
                
            
                <div class="mt-2">
                    <label class="form-label">Kategori</label>
                    <select name="category" class="form-control form-control-sm w-50">
                        <option value="atas">Atas</option>
                        <option value="menengah">Menengah</option>
                        <option value="bawah">Bawah</option>
                    </select>
                </div>
            
                <div class="mt-2 pb-4">
                    <label class="form-label">Status</label>
                    <select name="status" id="status" class="form-control form-control-sm w-50">
                        <option value="AKTIF">AKTIF</option>
                        <option value="LULUS">LULUS</option>
                        <option value="PINDAHAN">PINDAHAN</option>
                        <option value="KELUAR">KELUAR</option>
                    </select>
                </div>
            </div>
            
            <div class="container d-flex flex-column col-12 justify-content-start">
                <div class="d-flex mb-5 bg-gray-200">
                    <div class="mb-4 mt-4 text-center w-75">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection
