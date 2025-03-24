@extends('admin.layouts.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4>Tambah Data Guru</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.guru.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nip" class="form-label">NIP</label>
                    <input type="text" name="nip" id="nip" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" id="nama" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="agama" class="form-label">Agama</label>
                    <input type="text" name="agama" id="agama" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        <option value="TETAP">TETAP</option>
                        <option value="HONOR">HONOR</option>
                        <option value="MAGANG">MAGANG</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="role_id" class="form-label">Jabatan</label>
                    <select name="role_id" id="role_id" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        <option value="3">Guru</option>
                        <option value="4">Bendahara</option>
                        <option value="5">Kepala Sekolah</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.guru.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
