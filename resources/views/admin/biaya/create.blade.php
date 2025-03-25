@extends('admin.layouts.master')

@section('title', 'Tambah Biaya')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Biaya</h6>
        </div>
        <div class="card-body border-bottom-primary">
            <form action="{{ route('admin.biaya.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Biaya</label> <!-- ✅ Tambah Nama -->
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jenis Biaya</label>
                    <select name="jenis" class="form-control" required> <!-- ✅ Ubah ke Select -->
                        <option value="SPP">SPP</option>
                        <option value="NON-SPP">NON-SPP</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kode Biaya</label>
                    <input type="text" name="kode" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jumlah</label>
                    <input type="text" name="jumlah" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="AKTIF">AKTIF</option>
                        <option value="NON AKTIF">NON AKTIF</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="kategori" class="form-control" required>
                        <option value="Atas">Atas</option>
                        <option value="Menengah">Menengah</option>
                        <option value="Bawah">Bawah</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.biaya.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
