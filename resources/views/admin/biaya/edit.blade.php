@extends('admin.layouts.master')

@section('title', 'Edit Biaya')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Biaya</h6>
        </div>
        <div class="card-body border-bottom-primary">
            <form action="{{ route('admin.biaya.update', $biaya->id_biaya) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Biaya</label>
                    <input type="text" name="nama" class="form-control" value="{{ $biaya->nama }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jenis Biaya</label>
                    <select name="jenis" class="form-control" required>
                        <option value="SPP" {{ $biaya->jenis == 'SPP' ? 'selected' : '' }}>SPP</option>
                        <option value="NON-SPP" {{ $biaya->jenis == 'NON-SPP' ? 'selected' : '' }}>Non-SPP</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kode Biaya</label>
                    <input type="text" name="kode" class="form-control" value="{{ $biaya->kode }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control">{{ $biaya->deskripsi }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jumlah</label>
                    <input type="text" name="jumlah" class="form-control" value="{{ $biaya->jumlah }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="AKTIF" {{ $biaya->status == 'AKTIF' ? 'selected' : '' }}>AKTIF</option>
                        <option value="NON AKTIF" {{ $biaya->status == 'NON AKTIF' ? 'selected' : '' }}>NON AKTIF</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="kategori" class="form-control" required>
                        <option value="Atas" {{ $biaya->kategori == 'Atas' ? 'selected' : '' }}>Atas</option>
                        <option value="Menengah" {{ $biaya->kategori == 'Menengah' ? 'selected' : '' }}>Menengah</option>
                        <option value="Bawah" {{ $biaya->kategori == 'Bawah' ? 'selected' : '' }}>Bawah</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.biaya.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
