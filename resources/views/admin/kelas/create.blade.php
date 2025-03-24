@extends('admin.layouts.master')

@section('title', 'Tambah Kelas')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header">
            <h4>Tambah Kelas</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.kelas.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama Kelas</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="kode_kelas">Kode Kelas</label>
                    <input type="text" name="kode_kelas" class="form-control" required>
                </div>

                <select name="pengampu_kelas" class="form-control" required>
                    <option value="">-- Pilih Guru Pengampu --</option>
                    @foreach ($gurus as $guru)
                        <option value="{{ $guru->id_guru }}" 
                            {{ \App\Models\Kelas::where('pengampu_kelas', $guru->id_guru)->exists() ? 'disabled' : '' }}>
                            {{ $guru->nama }}
                        </option>
                    @endforeach
                </select>
                

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.kelas.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
