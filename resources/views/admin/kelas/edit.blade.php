@extends('admin.layouts.master')

@section('title', 'Edit Kelas')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Kelas</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.kelas.update', $kelas->id_kelas) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Kelas</label>
                    <input type="text" name="nama" class="form-control" value="{{ $kelas->nama }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kode Kelas</label>
                    <input type="text" name="kode_kelas" class="form-control" value="{{ $kelas->kode_kelas }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pengampu Kelas</label>
                    <select name="pengampu_kelas" class="form-control">
                        <option value="">Pilih Guru</option>
                        @foreach ($gurus as $guru)
                            <option value="{{ $guru->id_guru }}" {{ $kelas->pengampu_kelas == $guru->id_guru ? 'selected' : '' }}>
                                {{ $guru->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control">{{ $kelas->deskripsi }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.kelas.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
