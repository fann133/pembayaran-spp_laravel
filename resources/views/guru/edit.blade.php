@extends('layouts.master')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Data Guru</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-header">Form Edit Guru</div>
        <div class="card-body">
            <form action="{{ route('guru.update', $guru->id_guru) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nip">NIP</label>
                    <input type="text" name="nip" id="nip" class="form-control" value="{{ old('nip', $guru->nip) }}" required>
                </div>

                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $guru->nama) }}" required>
                </div>

                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                        <option value="Laki-laki" {{ $guru->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ $guru->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="tempat_lahir">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="{{ old('tempat_lahir', $guru->tempat_lahir) }}" required>
                </div>

                <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $guru->tanggal_lahir) }}" required>
                </div>

                <div class="form-group">
                    <label for="agama">Agama</label>
                    <input type="text" name="agama" id="agama" class="form-control" value="{{ old('agama', $guru->agama) }}" required>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="TETAP" {{ $guru->status == 'TETAP' ? 'selected' : '' }}>TETAP</option>
                        <option value="HONOR" {{ $guru->status == 'HONOR' ? 'selected' : '' }}>HONOR</option>
                        <option value="MAGANG" {{ $guru->status == 'MAGANG' ? 'selected' : '' }}>MAGANG</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="role_id">Role</label>
                    <select name="role_id" id="role_id" class="form-control" required>
                        <option value="3" {{ $guru->role_id == '3' ? 'selected' : '' }}>Guru</option>
                        <option value="4" {{ $guru->role_id == '4' ? 'selected' : '' }}>Bendahara</option>
                        <option value="5" {{ $guru->role_id == '5' ? 'selected' : '' }}>Kepala Sekolah</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success mt-3">Simpan Perubahan</button>
                <a href="{{ route('guru.index') }}" class="btn btn-secondary mt-3">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
