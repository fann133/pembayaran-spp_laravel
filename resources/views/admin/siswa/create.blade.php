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
            <div class="container d-flex flex-column col-12 col-md-5 justify-content-center">
                <div class="mt-2">
                    <label class="form-label" for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukan Nama Lengkap" required oninput="this.value = this.value.toUpperCase();">
                </div>
                
                <div class="mt-2">
                    <label class="form-label" for="nis">NIS</label>
                    <input type="text" name="nis" id="nis" class="form-control" placeholder="Masukan NIS" required>
                </div>
            
                <div class="mt-2">
                    <label class="form-label" for="tempat_lahir">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" placeholder="Masukan Tempat Lahir" required>
                </div>
            
                <div class="mt-2">
                    <label class="form-label" for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required>
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

                <div class="mt-2">
                    <label class="form-label">Kelas</label>
                    <select name="id_kelas" class="form-control select2" required>
                        <option value="">Pilih Kelas</option>
                        @foreach ($kelas as $k)
                            <option value="{{ $k->id_kelas }}">{{ $k->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-2">
                    <label class="form-label">Kategori</label>
                    <select name="category" class="form-control select2">
                            <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->kategori }}">{{ ucfirst($category->kategori) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-2 pb-4">
                    <label class="form-label">Status</label>
                    <select name="status" id="status" class="form-control select2">
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
